<?php

declare(strict_types=1);

namespace app\exception;

use Exception;

class InfoException extends Exception
{
    private $msg;
    function __construct($msg = '请求成功')
    {
        $this->msg = $msg;
    }
    public function getMsg()
    {
        return $this->msg;
    }
}
