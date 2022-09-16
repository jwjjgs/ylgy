<?php

declare(strict_types=1);

namespace app\controller;

use app\exception\InfoException;
use app\exception\WarningException;
use app\utils\Request;

class Game
{
    public function run()
    {
        try {
            $res = Request::get('game/game_over',  [
                'rank_score' => 1,
                'rank_state' => 1,
                'rank_time' => mt_rand(600, 1800),
                'rank_role' => 1,
                'skin' => 1,
            ]);
            if ($res['err_code'] != 0)
                throw new WarningException('请求失败');
            throw new InfoException();
        } catch (WarningException $e) {
            throw new WarningException($e->getMsg());
        }
    }
}
