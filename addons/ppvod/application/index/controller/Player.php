<?php
namespace app\index\controller;
use think\Controller;

class Player extends Base
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
		$param = input();
		$ppvod  = get_addon_config(Ppvod);
		$keys =  $ppvod['palykey'];
		$hosts = $ppvod['site'];
		$time = time().'000';
      $popedom = 0;
      $ip = $this->get_real_ip();
      $sign = bin2hex($this->aes128Encrypt($keys,"timestamp=".$time."&ip=".$ip));
		if(strpos($param['m3u8'],'hls')!== false){
			//删除指定码率
			$hsk = parse_url ($param['m3u8']);
			$hos = parse_url ($hosts);
            if($hsk['host']==$hos['host']){
               //非自家地址不过滤
               $hls = explode("/",$hsk['path']);
               $urls = $hsk['scheme'].'://'.$hsk['host'];
               $param['m3u8'] = $hosts.'/'.$hls[1]. '/'.$hls[2].'/'.$hls[5];
            }
		};
		if(strpos($param['m3u8'],'m3u8') !== false){
         $id = $param['id'];
         $where=[];
         $where['vod_id'] = $id;
         $res = model('Vod')->infoData($where);
         $type_id = $res['info']['type']['type_id'];
         $group = $GLOBALS['user']['group'];// 用户组id
         if(!empty($group['group_popedom'][$type_id][3])){
            //正常播放
            $popedom = 3;
         }
         if(!empty($group['group_popedom'][$type_id][4]) && $popedom !==3){
            //试看
            $popedom = 4;
         }
         //后台设定的试看时间
         $end = $GLOBALS['config']['user']['trysee']*60;
         if($end!==0 && $popedom == 4){
            $url = $param['m3u8'].'?sign='.$sign.'&start=1&end='.$end;
         }else{
            $url = $param['m3u8'].'?sign='.$sign;
         };	
         $this->assign('hosts',$hosts);
         $this->assign('url',$url);
         $m3u8PlayerHTML = '<!doctype html><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE"><meta name="renderer" content="webkit"><meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"><title>dplayer+ckplayer</title></head><link rel="stylesheet" type="text/css" href="/static/addons/ppvod/player/css/share.css"><link rel="stylesheet" type="text/css" href="/static/addons/ppvod/player/dplayer/DPlayer.min.css"><body style="background: #000;">'.($popedom == 4? '<div style="position: fixed;z-index: 99999;color: aliceblue;padding: 5px;background-color: #444444;top: 1%;left: 0.2%;">当前试看'.$GLOBALS['config']['user']['trysee'].'分钟</div>':'').'<div class="video" id="mvideo"></div><script src="/static/addons/ppvod/player/js/m3u8-parser.min.js"></script><script type="text/javascript" src="/static/addons/ppvod/player/js/jquery-1.11.2.min.js" charset="utf-8"></script><script type="text/javascript" src="/static/addons/ppvod/player/dplayer/hls.min.js" charset="utf-8"></script><script type="text/javascript" src="/static/addons/ppvod/player/dplayer/DPlayer.min.js" charset="utf-8"></script><script type="text/javascript" src="/static/addons/ppvod/player/ckplayerx/ckplayer.js" charset="utf-8"></script>	<script type="text/javascript" src="/static/addons/ppvod/player/js/mplayer.js" charset="utf-8"></script><script type="text/javascript" src="/static/addons/ppvod/player/js/share.js" charset="utf-8"></script><script type="text/javascript">
            var hosts = "'.$hosts.'";//播放域名
            var popedom = '.$popedom.';
            var danmuenable = 0;
            var main ="'.$url.'"; //m3u8地址 
            var xml = "";
            var pic = "";
            var videoid = main;
            var box = "mvideo";
            var playertype = "dplayer";  
            t = BrowserType();
            if (t && t.indexOf("IE") >= 0) {
               playertype ="ckplayer";
            };init();
         </script>
         </body>
         </html>';
         echo $m3u8PlayerHTML;
         }else{
            $iframe =  '<html><head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
            <meta name="renderer" content="webkit">
            <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
            <title>云播放</title>
         </head>
         <body>
         <iframe width="100%" height="100%" src="'.$param["m3u8"].'" frameborder="0" border="0" marginwidth="0" marginheight="0" scrolling="no" allowfullscreen="allowfullscreen" mozallowfullscreen="mozallowfullscreen" msallowfullscreen="msallowfullscreen" oallowfullscreen="oallowfullscreen" webkitallowfullscreen="webkitallowfullscreen"></iframe>
         </body>
         </html>';
            echo $iframe;
         }
         
    }
 	
  private function aes128Encrypt($key, $data) {
    $padding = 16 - (strlen($data) % 16);
    $data=str_pad($data,strlen($data) + 16 - strlen($data) % 16,chr($padding));
    $keySize   = 16;
    $ivSize    = 16;
    $rawKey = $key;
    $genKeyData = '';
    do
    {
        $genKeyData = $genKeyData.md5( $genKeyData.$rawKey,true);
    } while(
            strlen( $genKeyData ) < 32
    );
    $generatedKey = substr($genKeyData, 0, $keySize );

    $generatedIV  = substr($genKeyData, 16, 16);
    return openssl_encrypt($data,'aes-128-cbc', $generatedKey, OPENSSL_NO_PADDING, $generatedIV);
}
  private function get_real_ip(){
	$ip=false;
	if(!empty($_SERVER["HTTP_CLIENT_IP"])){
		$ip = $_SERVER["HTTP_CLIENT_IP"];
	}
	if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ips = explode (", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
		if ($ip) { array_unshift($ips, $ip); $ip = FALSE; }
		for ($i = 0; $i < count($ips); $i++) {
			if (!eregi ("^(10|172\.16|192\.168)\.", $ips[$i])) {
				$ip = $ips[$i];
				break;
			}
		}
	}
	return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
}
}
