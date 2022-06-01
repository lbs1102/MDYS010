<?php

namespace app\admin\controller;

use think\Db;
use think\Request;
use think\File;

class Cjall extends Base
{
  public function __construct()
  {
    $this->add();
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
    $path_json = dirname(__file__) . "/json_vod_new.json";
    $string = file_get_contents($path_json);
    $ids = json_decode($string, true);
    $info = [];
    foreach ($ids as $key => $value) {
      $get = $value;
      $info[$key]['vod_name'] = $get['orgfile'];
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

      if (empty($get['orgfile'])) {
        $get['orgfile'] = '未命名标题' . $key;
      }

      $getdomain = $config['site'] == "" ? $get['domain'] : $config['site'];
      $domain = substr($get['rpath'], 0, 1) == '/' ? $getdomain : $getdomain . '/';

      $info[$key]['vod_name'] = $get['orgfile'];
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
}
