<?php

namespace app\common\model;

use think\Model;
use think\Db;
use think\Cache;

class Base extends Model
{

    //自定义初始化
    protected function initialize()
    {
        //需要调用`Model`的`initialize`方法
        parent::initialize();
        //TODO:自定义的初始化
    }
    public function check_special_str($str)
    {
        /** leo 2021/12/21 偵測特殊字元 **/
        //$前要加反斜槓
        $specialChars = "~·`!！@#\$￥^…&*()（）—-_=+[]{}、|\\;:；：'\"“‘,./<>《》?？，。";
        //特殊符號數組
        $specialArr = array();
        $len = mb_strlen($specialChars, 'UTF-8');
        for ($i = 0; $i < $len; $i++) {
            $specialArr[] = mb_substr($specialChars, $i, 1, 'UTF-8');
        }
        //待比較字符串數組
        $arr = array();
        $len = mb_strlen($str, 'UTF-8');
        for ($i = 0; $i < $len; $i++) {
            $arr[] = mb_substr($str, $i, 1, 'UTF-8');
        }
        foreach ($arr as $v) {
            if (in_array($v, $specialArr)) {
                return true;
            }
        }
        return false;
    }
}
