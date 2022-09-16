<?php

declare(strict_types=1);

namespace app\controller;

use app\exception\InfoException;
use app\exception\WarningException;
use app\utils\Request;
use Exception;

class User
{

    public function login()
    {
        $uid = input('post.uid/d');
        if (!$uid)
            throw new WarningException('UID不存在');
        try {
            $res = Request::get(
                'game/user_info',
                [
                    'uid' => $uid,
                ],
                [
                    't' => env('YYY.token')

                ]
            );
            if ($res['err_code'] != 0)
                throw new WarningException('获取用户信息失败');

            ['wx_open_id' => $wx_open_id] = $res['data'];

            $res = Request::post('user/login_tourist', [
                'uuid' => $wx_open_id,
            ]);

            if ($res['err_code'] != 0)
                throw new WarningException('登录失败');
            ['uid' => $_uid, 'token' => $token] = $res['data'];

            if ($_uid != $uid)
                throw new WarningException('账号不匹配');

            if (!$token)
                throw new WarningException('获取凭证失败');

            session('token', $token);
            throw new InfoException('登录成功');
        } catch (WarningException $e) {
            throw new WarningException($e->getMsg());
        }
    }

    public function info()
    {
        try {
            $res = Request::get('game/personal_info');
            if ($res['err_code'] != 0)
                throw new WarningException('请求失败');
            throw new InfoException($res['data']);
        } catch (WarningException $e) {
            throw new WarningException($e->getMsg());
        }
    }
}
