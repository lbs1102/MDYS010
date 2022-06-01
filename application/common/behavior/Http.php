<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: yunwuxin <448901948@qq.com>
// +----------------------------------------------------------------------

namespace app\common\behavior;

use Exception;
use think\exception\Handle;
use think\exception\HttpException;
use think\Log;

class Http extends Handle
{

    /**
     * leo 2022/01/04 異常頁面覆寫
     */
    public function render(Exception $e)
    {
        // 参数验证错误
        if ($e instanceof ValidateException) {
            return json($e->getError(), 422);
        }

        // 请求异常
        if ($e instanceof HttpException && request()->isAjax()) {
            return response($e->getMessage(), $e->getStatusCode());
        }

        //TODO::开发者对异常的操作
        //可以在此交由系统处理
        $log = $e->getMessage();
        Log::record($log);
        Log::save();
        return header('Location: ' . url('/'));
    }
}
