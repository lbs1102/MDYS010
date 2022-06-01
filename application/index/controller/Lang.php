<?php

namespace app\index\controller;

use think\Cookie;

class Lang extends Base
{

    /* leo 2021/12/10 前台語系設定-Cookie*/
    public function set_platform_lang($lang = "")
    {
        $a_lang_file = scandir(APP_PATH . 'lang');
        $s_cookies = isset($GLOBALS['config']['site']['lang']) ? $GLOBALS['config']['site']['lang'] : '';
        foreach ($a_lang_file as $k => $v) {
            if (strpos($v, EXT)) {
                if ($lang == explode(".", $v)[0]) {
                    $s_cookies = $lang;
                }
            }
        }
        Cookie::set('platform_lang', $s_cookies);
        // return $this->success('');
    }
}
