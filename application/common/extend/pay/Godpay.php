<?php

namespace app\common\extend\pay;

use think\Log;
use app\common\util\Qrcode;
//QRcode 產生 leo 2022/02/21

header('Content-Type: text/html; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers:X-API-ClientID, X-API-Signature, X-API-Timestamp');

class Godpay
{

    public $name = 'godpay支付';
    public $ver = '1.0';
    public $pay_type = [
        1 =>    "VUSDT_ERC20",
        2 =>    "VUSDT_TRON",
    ];
    public function submit($user, $order, $param)
    {
        //流程.1 創建訂單取得訂單數據
        $data_order = array();
        $data_order['pay_memberid']     =   (string) trim($GLOBALS['config']['pay']['godpay']['appacc']); //商户编号
        $data_order['pay_orderid']      =   (string) $order['order_code']; //商户订单号
        $data_order['pay_amount']       =   (string) $order['order_price']; //金额
        $data_order['pay_applydate']    =   date('YmdHis', $order['order_time']); //訂單日期
        $data_order['pay_channelCode']  =   (string) trim($this->pay_type[(int)$param['paytype']]); //商户订单支付渠道 Zalopay,Momopay
        $data_order['currency_type']    =   'USDT'; //订单貨幣類型
        $data_order['pay_notifyurl']    =   (string) trim($GLOBALS['http_type'] . $_SERVER['HTTP_HOST'] . '/index.php/payment/notify/pay_type/godpay'); //订单信息通知地址
        $data_order['isMobile']         =   'false'; //移動端判斷
        $data_order['format']           =   'json'; //订单响应格式
        $data_order['pay_md5sign']      =   (string) $this->MakeCheckSign($data_order); //签名
        $s_datajson = json_encode($data_order);
        Log::record($s_datajson);
        //流程.2 判斷訂單是否建立完成，若已建單完成則跳過建單送出流程
        $res_create = mac_curl_post('https://www.godpay.shop/load/query', $data_order, array(
            'Content-Type: multipart/form-data'
        ));
        $res_create = json_decode($res_create, true);
        Log::record($res_create);
        if (!isset($res_create['orderid'])) {
            $data_order['pay_md5sign']  =   (string) $this->MakePaySign($data_order); //签名
            $res_create = mac_curl_post('https://www.godpay.shop/load/pay', $data_order, array(
                'Content-Type: multipart/form-data'
            ));
            Log::record($res_create);
            $res_create = json_decode($res_create, true);
            //流程.2 判斷訂單是否建立完成，若失敗則記錄並轉跳
            if (isset($res_create['bankAccount'])) {
                //流程.3 取得付款連結QRcode 
                $s_qrcode_name = $data_order['pay_orderid'] . ".jpg";
                $s_qrcode_file =  RUNTIME_PATH . "temp/" . $s_qrcode_name;
                $s_qrcode_url = "/runtime/temp/" . $s_qrcode_name;
                Qrcode::png($res_create['bankAccount'], $s_qrcode_file, QR_ECLEVEL_L, 10);
                $data_order['qrurl']        =  $s_qrcode_url; //订单qrcode
                //流程.4 紀錄godpay訂單編號，並返回付款信息
                $where = [];
                $where['order_code'] = $data_order['pay_orderid'];
                model('Order')->fieldData($where, "order_pay_id", trim($res_create['bankAccount']));
                //返回付款信息
                $res = [
                    'user_id' => $order['user_id'],
                    'pay_url' => $res_create['bankAccount'], //帳戶資訊
                    'code_url' => $data_order['qrurl'] //使用qrcode
                ];
                return $res;
            } else {
                $s_log = "Godpay 創建訂單失敗:";
                Log::record($s_log);
                Log::record($res_create);
                return false;
            }
        } else {
            $where = [];
            $where['order_code'] = $data_order['pay_orderid'];
            $pay_url = model('Order')->infoData($where, "order_pay_id");
            //取得付款連結QRcode 
            $s_qrcode_name = $data_order['pay_orderid'] . ".jpg";
            $s_qrcode_file =  RUNTIME_PATH . "temp/" . $s_qrcode_name;
            $s_qrcode_url = "/runtime/temp/" . $s_qrcode_name;
            Qrcode::png($pay_url["info"]["order_pay_id"], $s_qrcode_file, QR_ECLEVEL_L, 10);
            $data_order['qrurl']        =  $s_qrcode_url; //订单qrcode
            $res = [
                'user_id' => $order['user_id'],
                'pay_url' => $pay_url["info"]["order_pay_id"], //帳戶資訊
                'code_url' => $data_order['qrurl'] //使用qrcode
            ];
            return $res;
        }
    }

    public function notify()
    {
        //取得返回資料(godpay在create訂單與支付完成會在20分鐘內不斷呼叫notify,無論接取資料是什麼，一定要回傳"success")
        $data = file_get_contents('php://input');
        if ($data == "" || empty($data)) {
            $s_log = "Godpay 訂單支付異常資訊: 回調空值";
            Log::record($s_log);
        } else {
            $data_str_arr = explode("&", $data);
            $a_data = [];
            foreach ($data_str_arr as $k => $v) {
                $val = explode("=", $v);
                $a_data[$val[0]] =  $val[1];
            }
            $check_return_key = $this->MakeReturnSign($a_data);
            if ($check_return_key != $a_data['sign']) {
                $s_log = "Godpay 訂單支付異常資訊: 密鑰錯誤 \n\r回調資料 : $data";
                Log::record($s_log);
            } else {
                //returncode == 2 為支付成功
                if (
                    $a_data["returncode"] == "2" &&
                    isset($a_data['orderid']) &&
                    $check_return_key == $a_data['sign']
                ) {
                    model('Order')->notify($a_data['orderid'], 'godpay');
                    Log::record($a_data);
                }
                //returncode == 88 表示容许差额上分
                else {
                    $s_log = "Godpay 訂單支付異常資訊: 差额上分 \r回調資料 : $data";
                    Log::record($s_log);
                }
            }
        }

        $res = "success";
        echo $res;
    }
    //產生建單密鑰
    public function MakePaySign($data)
    {
        //获取godpay支付秘钥
        // 去空
        $data = array_filter($data);
        //签名步骤一：獲取商户订单号與金额字串
        $a_sing_arr = [];
        $a_sing_arr[] = $s_pay_memberid = "pay_memberid^" . (string)trim($GLOBALS['config']['pay']['godpay']['appacc']);
        $a_sing_arr[] = $s_pay_orderid = "pay_orderid^" . (string)$data['pay_orderid'];
        $a_sing_arr[] = $s_pay_amount = "pay_amount^" . (string)$data['pay_amount'];
        $a_sing_arr[] = $s_pay_applydate = "pay_applydate^" . (string)$data['pay_applydate'];
        $a_sing_arr[] = $s_pay_channelCode = "pay_channelCode^" . (string)$data['pay_channelCode'];
        $a_sing_arr[] = $s_pay_notifyurl = "pay_notifyurl^" . (string)$data['pay_notifyurl'];
        $a_sing_arr[] = $s_key = "key=" . (string)trim($GLOBALS['config']['pay']['godpay']['appkey']);
        //签名步骤二：MD5加密組合字串並转为大寫
        $result = strtoupper(md5(implode("&", $a_sing_arr)));
        return $result;
    }
    //產生查詢密鑰
    public function MakeCheckSign($data)
    {
        //获取godpay查詢秘钥
        // 去空
        $data = array_filter($data);
        //签名步骤一：獲取商戶號與订单号
        $a_sing_arr = [];
        $a_sing_arr[] = $s_pay_memberid = "pay_memberid^" . (string)trim($GLOBALS['config']['pay']['godpay']['appacc']);
        $a_sing_arr[] = $s_pay_orderid = "pay_orderid^" . (string)$data['pay_orderid'];
        $a_sing_arr[] = $s_key = "key=" . (string)trim($GLOBALS['config']['pay']['godpay']['appkey']);
        //签名步骤二：MD5加密組合字串並转为大寫
        $result = strtoupper(md5(implode("&", $a_sing_arr)));
        return $result;
    }
    //產生結果密鑰
    public function MakeReturnSign($data)
    {
        //获取godpay支付秘钥
        // 去空
        $data = array_filter($data);
        //签名步骤一：獲取商户订单号與金额字串
        $a_sing_arr = [];
        $a_sing_arr[] = $s_pay_amount = "amount^" . (string)$data['amount'];
        $a_sing_arr[] = $s_pay_datetime = "datetime^" . (string)$data['datetime'];
        $a_sing_arr[] = $s_pay_memberid = "memberid^" . (string)trim($GLOBALS['config']['pay']['godpay']['appacc']);
        $a_sing_arr[] = $s_pay_orderid = "orderid^" . (string)$data['orderid'];
        $a_sing_arr[] = $s_pay_returncode = "returncode^" . (string)$data['returncode'];
        $a_sing_arr[] = $s_key = "key=" . (string)trim($GLOBALS['config']['pay']['godpay']['appkey']);
        //签名步骤二：MD5加密組合字串並转为大寫
        $test = implode("&", $a_sing_arr);
        $result = strtoupper(md5(implode("&", $a_sing_arr)));
        return $result;
    }
    public function checkPay($data)
    {
        // 檢查返回的签名sign
        $data_sign = $data['sign'];
        // sign不参与签名算法
        unset($data['sign']);
        // 生成签名
        $sign = $this->MakePaySign($data);
        if ($data['ispay'] != 1) {
            return false;
        }
        if ($sign != $data_sign) {
            return false;
        }
        return true;
    }
}
