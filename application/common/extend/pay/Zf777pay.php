<?php

namespace app\common\extend\pay;

use think\Log;

header('Content-Type: text/html; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers:X-API-ClientID, X-API-Signature, X-API-Timestamp');

class Zf777pay
{

    public $name = '777支付';
    public $ver = '1.0';
    public $pay_type = [
        1 =>    "zalo",
        2 =>    "momo",
        3 =>    "vietcombank",
        4 =>    "vietinbankipay",
        5 =>    "vtpay", //no mobile ready
        6 =>    "tpbank", //no mobile ready
        7 =>    "acbbank"
    ];
    public function submit($user, $order, $param)
    {
        //流程.1 創建訂單取得訂單數據        
        if ($order['order_pay_id'] != "") {
            $res_create = mac_curl_get('https://jsue13qsoi.77777.org/api/getpayinfo?ticket=' . $order['order_pay_id']);
        } else {
            $data_order = array();
            $data_order['userid']         =   (string) trim($GLOBALS['config']['pay']['zf777pay']['appacc']); //商户编号
            $data_order['orderid']        =   (string) $order['order_code']; //商户订单号
            $data_order['type']           =   (string) trim($this->pay_type[(int)$param['paytype']]); //商户订单类型 Zalopay,Momopay
            $data_order['amount']         =   (string) number_format($order['order_price'], 4, ".", ""); //金额(元)
            $data_order['notifyurl']      =   (string) trim($GLOBALS['http_type'] . $_SERVER['HTTP_HOST'] . '/index.php/payment/notify/pay_type/zf777pay'); //订单信息通知地址
            $data_order['returnurl']      =   (string) trim($GLOBALS['http_type'] . $_SERVER['HTTP_HOST']) . '/user'; //前端跳转地址
            $data_order['sign']           =   (string) $this->makeSign($data_order); //签名
            $data_order['note']           =   '积分充值（UID：' . $order['user_id'] . '）'; // 商户备注
            $data_order['payload']        =   ''; //订单其他数据
            $data_order['qrurl']          =   ''; //订单qrcode
            $data_order['success']        =   ''; //订单條件判斷
            $s_datajson = json_encode($data_order);
            $res_create = mac_curl_post('https://jsue13qsoi.77777.org/api/create', $s_datajson, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($s_datajson)
            ));
        }
        $res_create = json_decode($res_create, true);
        //流程.2 判斷訂單是否建立完成，若失敗則記錄並轉跳
        if ($res_create['code'] == 1) {
            $res_data = json_decode($res_create['data'], true);
            //流程.4 紀錄777pay訂單編號，並返回付款信息
            $where = [];
            $where['order_code'] = $order['order_code'];
            model('Order')->fieldData($where, "order_pay_id", trim($res_data['ticket']));
            //返回付款信息
            $res = [
                'user_id' => $order['user_id'],
                'code_url' => $data_order['qrurl'], //使用qrcode
                'pay_channel' => $res_data['type'], //使用qrcode
                'page_url' => $res_data['pageurl'], //使用777支付頁面
                'verify_code' => $res_data['serialno'] //777驗證支付碼
            ];
            return $res;
        } else {
            $s_log = "777pay 創建訂單失敗:";
            Log::record($s_log);
            Log::record($res_create);
            return false;
        }
    }

    public function notify()
    {
        //取得返回資料(777pay在create訂單與支付完成會各呼叫5次notify,無論接取資料是什麼，一定要回傳"success")
        $data = file_get_contents('php://input');
        Log::record($data);
        $msg_data = json_decode($data, true);
        $a_data = json_decode($msg_data['data'], true);

        // 判断回傳動作是否為支付成功資料(需有ispay欄位 isset($data['ispay']))、签名是否正确、支付状态是否正確
        if (isset($a_data['ispay'])) {
            if ($this->checkPay($a_data)) {
                model('Order')->notify($a_data['orderid'], 'zf777pay');
                Log::record($a_data);
            } else {
                //若支付有問題則記錄回傳的message到order資料表內的order_remarks欄位
                $where = [];
                $s_errmsg = $a_data['message'];
                $where['order_code'] = $a_data['orderid'];
                $s_log = "zf777pay 訂單支付異常資訊: " . $data;
                Log::record($s_log);
                model('Order')->fieldData($where, "order_remarks", $s_errmsg);
            }
        } else {
            $s_log = "zf777pay 建立訂單回傳資訊: " . $data;
            Log::record($s_log);
        }
        $res = "success";
        echo $res;
    }
    public function makeSign($data)
    {
        //获取777支付秘钥
        $s_key = (string)trim($GLOBALS['config']['pay']['zf777pay']['appkey']);
        // 去空
        $data = array_filter($data);
        //签名步骤一：獲取商户订单号與金额字串
        $s_oid = (string)$data['orderid'];
        // $s_oid = (string) "20201017092600";
        $s_amount = (string)$data['amount'];
        //签名步骤二：組合字串转为小写
        $s_sign_temp = strtolower($s_key . $s_oid . $s_amount);
        //签名步骤三：MD5加密
        $result = md5($s_sign_temp);
        return $result;
    }
    public function checkPay($data)
    {
        // 檢查返回的签名sign
        $data_sign = $data['sign'];
        // sign不参与签名算法
        unset($data['sign']);
        // 生成签名
        $sign = $this->makeSign($data);
        if ($data['ispay'] != 1) {
            return false;
        }
        if ($sign != $data_sign) {
            return false;
        }
        return true;
    }
}
