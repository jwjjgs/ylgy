<?php

declare(strict_types=1);

namespace app\exception;

use Exception;

class WarningException extends Exception
{
    private $msg;
    function __construct($msg = '请求失败')
    {
        $this->msg = $msg;
    }
    public function getMsg()
    {
        return $this->msg;
    }
}
