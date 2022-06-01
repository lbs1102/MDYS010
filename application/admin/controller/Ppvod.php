<?php

namespace app\admin\controller;

use think\Db;
use think\Request;
use think\File;

class Ppvod extends Base
{
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $ppvod = get_addon_config(Ppvod);
    $config = config('ppvod');
    $this->assign('config', $config);
    $this->assign('ppvod', $ppvod);
    $domain = input('server.REQUEST_SCHEME') . '://' . input('server.SERVER_NAME');

    $push_url = $domain . '/api.php/yzmauto/yzmapi.html?ac=yzm&pass=' . $ppvod['async'];

    $this->assign('push_url', $push_url);
    return $this->fetch('admin@ppvod/index');
  }

  public function config()
  {
    $ppvod = config('ppvod');
    $addon_config = get_addon_config(Ppvod);
    if (Request()->isPost()) {
      $param = input('post.');
      $config = [];

      $config['class'] = implode(",", $param['type']);
      $config['errorid'] = $param['errorid'];
      $config['player'] = $param['player'];
      $config['addr'] = $param['addr'];
      $config['playname'] = $param['playname'];


      $res = mac_arr2file(APP_PATH . 'extra/ppvod.php', $config);
      return ['code' => 1, 'msg' => '保存成功'];
    };

    $get = file_get_contents($addon_config['api'] . '/api/category');
    $type = json_decode($get, true);
    $type_tree = model('Type')->getCache('type_tree');
    $player_list = config('vodplayer');
    $config_type = explode(",", $ppvod['class']);

    $type_data = [];
    foreach ($config_type as $k => $v) {
      $tid = explode("|", $v);
      $type_data[$k] = $tid[1];
    }
    //  print_r($type_data);

    $this->assign('player_list', $player_list);
    $this->assign('ppvod', $ppvod);
    $this->assign('config_type', $config_type);
    $this->assign('type_tree', $type_tree);
    $this->assign('type', $type);
    return $this->fetch('admin@ppvod/config');
  }
  public function info()
  {
    if (Request()->isPost()) {
      $param = input('post.');
      $param['vod_content'] = str_replace($GLOBALS['config']['upload']['protocol'] . ':', 'mac:', $param['vod_content']);
      $res = model('Vod')->saveData($param);
      if ($res['code'] > 1) {
        return $this->error($res['msg']);
      }
      return $this->success($res['msg']);
    }
    $ppvod = get_addon_config(Ppvod);
    $config_pp = config('ppvod');


    $id = input('id');
    $where = [];
    $where['vod_id'] = $id;
    $res = model('Vod')->infoData($where);


    $info = $res['info'];
    $this->assign('info', $info);

    //分类
    $type_tree = model('Type')->getCache('type_tree');
    $this->assign('type_tree', $type_tree);

    //地区、语言
    $config = config('maccms.app');
    $area_list = explode(',', $config['vod_area']);
    $lang_list = explode(',', $config['vod_lang']);
    $this->assign('area_list', $area_list);
    $this->assign('lang_list', $lang_list);

    //用户组
    $group_list = model('Group')->getCache('group_list');
    $this->assign('group_list', $group_list);

    //播放器
    $player_list = config('vodplayer');
    $downer_list = config('voddowner');
    $server_list = config('vodserver');

    $player_list = mac_multisort($player_list, 'sort', SORT_DESC, 'status', '1');
    $downer_list = mac_multisort($downer_list, 'sort', SORT_DESC, 'status', '1');
    $server_list = mac_multisort($server_list, 'sort', SORT_DESC, 'status', '1');

    $this->assign('player_list', $player_list);
    $this->assign('downer_list', $downer_list);
    $this->assign('server_list', $server_list);

    //播放组、下载租
    $this->assign('vod_play_list', $info['vod_play_list']);
    $this->assign('vod_down_list', $info['vod_down_list']);
    $this->assign('vod_plot_list', $info['vod_plot_list']);

    $this->assign('ppvod', $ppvod);
    $this->assign('pp', $config_pp);
    //print_r ($ppvod);
    $this->assign('title', '视频信息');
    return $this->fetch('admin@ppvod/info');
  }
  public function add()
  {
    $config = get_addon_config(Ppvod);
    $ppvod = config('ppvod');
    $errorid = $ppvod['errorid'];
    $player = $ppvod['player'];
    $playname = $ppvod['playname'];
    $param = input();
    $apikey = $config['apikey'];
    $ids = $param['ids'];

    $info = [];
    foreach ($ids as $key => $value) {
      $get = json_decode($value, true);
      $vod_name = $this->title_format($get['orgfile']);
      $info[$key]['vod_name'] = $vod_name;
      $info[$key]['vod_pic'] = $get['domain'] . $get['rpath'] . "/1.jpg";
      //分类绑定
      $category = $get['category'];
      if (empty($category)) {
        $classid = $errorid;
      } else {
        $arrone = explode(',', $ppvod['class']);
        foreach ($arrone as $k => $v) {
          $arrtwo = explode('|', $v);
          $arrthree[$arrtwo[0]] = $arrtwo[1];
        }

        $classreset = array_keys($arrthree, $category);
        if (is_array($classreset) && !empty($classreset)) {
          foreach ($classreset as $v) {
            $classid = $v;
          }
        } else {
          $classid = $errorid;
        }
      }

      if (empty($vod_name)) {
        $vod_name = '未命名标题' . $key;
      }

      $getdomain = $config['site'] == "" ? $get['domain'] : $config['site'];
      $domain = substr($get['rpath'], 0, 1) == '/' ? $getdomain : $getdomain . '/';

      $info[$key]['vod_name'] = $vod_name;
      $info[$key]['vod_pic'] = $domain . $get['rpath'] . "/1.jpg";
      $info[$key]['vod_pic_thumb'] = $info[$key]['vod_pic'];
      $info[$key]['vod_time'] = time();
      $info[$key]['vod_duration'] = $this->secondsToHour($get['metadata']['time']);
      $info[$key]['type_id'] = $classid;
      $info[$key]['vod_play_from'] = $player;
      $info[$key]['vod_play_url'] = $playname . "$" . $domain . $get['rpath'] . "/index.m3u8";
      $info[$key]['vod_blurb'] = $info[$key]['vod_name'];
      $info[$key]['vod_content'] = $info[$key]['vod_name'];
      $info[$key]['vod_total'] = "1";
      $info[$key]['vod_serial'] = "1";
      $info[$key]['vod_isend'] = "1";
      $info[$key]['vod_pubdate'] = date("Y-m-d");
      $info[$key]['vod_year'] = date("Y");
    };
    $data['data'] = $info;


    $res = model('Collect')->vod_data(['ac' => 'cjsel'], $data, 1);
  }
  public function del()
  {


    $addon_config = get_addon_config(Ppvod);
    $apikey = $addon_config['apikey'];
    if (empty($apikey)) {
      return $this->error($res['读写密钥不能为空']);
    }
    $param = input();
    $ids = $param['ids'];
    $cloud = [];
    $error = '';
    $videourl = $addon_config['api'];
    foreach ($ids as $key => $value) {
      $get = json_decode($value, true);
      $url = $videourl . '/api/removetask?id=' . $get['_id'] . '&key=' . $apikey;
      $get = file_get_contents($url);
      $error = json_decode($get, true);
    }

    return $this->success('删除成功');
  }
  public function wd()
  {
    $param = input();


    $where = [];
    $param['wd'] = htmlspecialchars(urldecode($param['wd']));
    $where['vod_name'] = $param['wd'];
    $order = 'vod_id desc';
    $res = model('Vod')->listData($where, $order, 1, 1);

    return json($res);
  }
  public function log()
  {
    header('Content-type:text/html;charset=utf-8');

    $log = "/log/";
    $webpath = $_SERVER["DOCUMENT_ROOT"] . $log;
    $i = 1;
    $txtData = [];
    foreach (glob($webpath . '*.txt') as $txt) {
      //			$txtData[$i]['name'] = basename($txt);
      $content = file_get_contents($txt);

      $txtData[$i] = explode("\n", substr($content, 0, strlen($content) - 1));
      $i++;
    }

    $this->assign('list', $this->multi2array($txtData));
    return $this->fetch('admin@ppvod/log');
  }
  public function download()
  {
    $ppvod = config('ppvod');
    $addon_config = get_addon_config(Ppvod);
    $apikey = $addon_config['apikey'];
    $api = $addon_config['site'];

    $get = file_get_contents($addon_config['api'] . '/api/category');
    $type = json_decode($get, true);
    $this->assign('apikey', $apikey);
    $this->assign('api', $api);
    $this->assign('type', $type);
    return $this->fetch('admin@ppvod/download');
  }
  private function secondsToHour($seconds)
  {
    if (intval($seconds) < 60) {
      $tt = "00:00:" . sprintf("%02d", intval($seconds % 60));
      return $tt;
    }
    if (intval($seconds) >= 60) {
      $h = sprintf("%02d", intval($seconds / 60));
      $s = sprintf("%02d", intval($seconds % 60));
      if ($s == 60) {
        $s = sprintf("%02d", 0);
        ++$h;
      }
      $t = "00";
      if ($h == 60) {
        $h = sprintf("%02d", 0);
        ++$t;
      }
      if ($t) {
        $t = sprintf("%02d", $t);
      }
      $tt = $t . ":" . $h . ":" . $s;
    }
    if (intval($seconds) >= 60 * 60) {
      $t = sprintf("%02d", intval($seconds / 3600));
      $h = sprintf("%02d", intval($seconds / 60) - $t * 60);
      $s = sprintf("%02d", intval($seconds % 60));
      if ($s == 60) {
        $s = sprintf("%02d", 0);
        ++$h;
      }
      if ($h == 60) {
        $h = sprintf("%02d", 0);
        ++$t;
      }
      if ($t) {
        $t = sprintf("%02d", $t);
      }
      $tt = $t . ":" . $h . ":" . $s;
    }
    if (!(int)$t) {
      $tt = $h . ":" . $s;
    }
    return $seconds > 0 ? $tt : '00:00:00';
  }
  private function multi2array($array)
  {
    static $result_array = array();
    foreach ($array as $key => $value) {
      if (is_array($value)) {
        $this->multi2array($value);
      } else {
        $result_array[] = $value;
      }
    }
    return $result_array;
  }
  /*LEO 2022/04/20 影片標題重整*/
  private function title_format($name)
  {
    $name = trim($name);
    if (substr_count($name, ".")) {
      if (substr_count($name, ".mp4")) {
        $name = str_replace(".mp4", "", $name);
      }
    } else {
      if (substr_count($name, "mp4")) {
        $name = str_replace("mp4", "", $name);
      } else {
      }
    }
    return $name;
  }
}
