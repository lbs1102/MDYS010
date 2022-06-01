<?php
namespace addons\Ppvod;	// 注意命名空间规范

use think\Addons;
//use app\admin\controller\System;
//use think\Controller;
//use app\common\controller\All;
/**
 * 插件测试
 * @author byron sampson
 */
class Ppvod extends Addons	// 需继承think\addons\Addons类
{
    /**
     * 插件安装方法
     * @return bool
     */
    public function install()
    {
        return true;
    }
	/**
     * 插件启用方法 
     */
    public function enable()
    {
		
	   $menus = @include MAC_ADMIN_COMM . 'auth.php';
	   $player = config('vodplayer');
	  
	   $player['ppvod'] = array(
	        'status' => '1',
            'sort' => '999',
            'from' => 'ppvod',
            'show' => 'ppvod官方播放器',
            'des' => 'http://www.ppvod.com',
            'parse' => '',
            'ps' => 0,
            'tip' => '无需安装任何插件',
            'id' => 'ppvod',
	   );
		
		
		
	   $menus['11']['sub']['ppvod'] = array("show"=>1,'name' => 'PPVOD', 'controller' => 'ppvod', 'action' => 'index', 'param'=>'');
	   $res = mac_arr2file( APP_PATH . 'admin/common/auth.php', $menus);
	   $player = mac_arr2file( APP_PATH . 'extra/vodplayer.php', $player);
       return true;
    }
	/**
     * 插件禁用方法
     */
    public function disable()
    {
		$player = config('vodplayer');
		$menus = @include MAC_ADMIN_COMM . 'auth.php';
		unset($menus['11']['sub']['ppvod']);
		unset($player['ppvod']);
	    $res = mac_arr2file( APP_PATH . 'admin/common/auth.php', $menus);
		$player = mac_arr2file( APP_PATH . 'extra/vodplayer.php', $player);
        return true;
    }

    /**
     * 插件卸载方法
     *  
     */
    public function uninstall()
    {
        return true;
    }
	//视频信息钩子函数VodInfo()
	 /**
     * 实现钩子方法
     * @return mixed
     */
    public function testhook($param)
    {
        // 调用钩子时候的参数信息
        print_r($param);
        // 当前插件的配置信息，配置信息存在当前目录的config.php文件中，见下方
        print_r($this->getConfig());
        // 可以返回模板，模板文件默认读取的为插件目录中的文件。模板名不能为空！
        //return $this->fetch('view/info');
    }

}