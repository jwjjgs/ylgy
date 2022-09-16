<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use app\middleware\LoginMiddleware;
use think\facade\Route;

Route::get('think', function () {
    return 'hello,ThinkPHP6!';
});



Route::post('login', 'user/login');
Route::get('user/info', 'user/info')->middleware([LoginMiddleware::class]);
Route::get('game/run', 'game/run')->middleware([LoginMiddleware::class]);
