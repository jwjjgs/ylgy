<?php

declare(strict_types=1);

namespace app\utils;

use app\exception\WarningException;
use Exception;
use WpOrg\Requests\Requests;

class Request
{
    private static $url = 'https://cat-match.easygame2021.com/sheep/v1/';

    private static function getHeaders()
    {
        $headers = [
            'User-Agent' => 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.138 Safari/537.36 MicroMessenger/6.5.2.501 NetType/WIFI MiniGame WindowsWechat',
            'Referer' => 'https://servicewechat.com/wx141bfb9b73c970a9/17/page-frame.html',
        ];
        if (session('?token'))
            $headers['t'] = session('token');
        return $headers;
    }


    public static function post($url, $data = [], $headers = [])
    {
        $response = Requests::post(
            self::$url . $url,
            [...self::getHeaders(), ...$headers],
            $data,
            [
                'timeout' => 30,
                'connect_timeout' => 30,
                'useragent' => 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.138 Safari/537.36 MicroMessenger/6.5.2.501 NetType/WIFI MiniGame WindowsWechat'
            ]
        );
        if ($response->status_code != 200)
            throw new WarningException('请求失败');
        $json = json_decode($response->body, true);
        try {
            $json = json_decode($response->body, true);
            return $json;
        } catch (Exception $e) {
            return [];
        }
    }

    public static function get($url, $data = [], $headers = [])
    {
        $response = Requests::get(
            self::$url . $url . '?' . http_build_query($data),
            [...self::getHeaders(), ...$headers],
            [
                'timeout' => 30,
                'connect_timeout' => 30,
                'useragent' => 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.138 Safari/537.36 MicroMessenger/6.5.2.501 NetType/WIFI MiniGame WindowsWechat'
            ]
        );
        if ($response->status_code != 200)
            throw new WarningException('请求失败');
        try {
            $json = json_decode($response->body, true);
            return $json;
        } catch (Exception $e) {
            return [];
        }
    }
}
