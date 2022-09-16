<?php

declare(strict_types=1);

namespace app\exception;

use Exception;

class ErrorException extends Exception
{
    private $msg;
    function __construct($msg = '发生错误')
    {
        $this->msg = $msg;
    }
    public function getMsg()
    {
        return $this->msg;
    }
}
