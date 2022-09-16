<?php

namespace app;

use app\exception\InfoException;
use app\exception\WarningException;
use app\exception\ErrorException;
use think\db\exception\DataNotFoundException;
use think\db\exception\ModelNotFoundException;
use think\exception\Handle;
use think\exception\HttpException;
use think\exception\HttpResponseException;
use think\exception\ValidateException;
use think\facade\Log;
use think\Response;
use Throwable;

/**
 * 应用异常处理类
 */
class ExceptionHandle extends Handle
{
    /**
     * 不需要记录信息（日志）的异常类列表
     * @var array
     */
    protected $ignoreReport = [
        HttpException::class,
        HttpResponseException::class,
        ModelNotFoundException::class,
        DataNotFoundException::class,
        ValidateException::class,
    ];

    /**
     * 记录异常信息（包括日志或者其它方式记录）
     *
     * @access public
     * @param  Throwable $exception
     * @return void
     */
    public function report(Throwable $exception): void
    {
        // 使用内置的方式记录异常日志
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @access public
     * @param \think\Request   $request
     * @param Throwable $e
     * @return Response
     */
    public function render($request, Throwable $e): Response
    {
        // 添加自定义异常处理机制
        if ($e instanceof InfoException)
            return json(['code' => 200, 'msg' => $e->getMsg()]);
        if ($e instanceof WarningException)
            return json(['code' => 101, 'msg' => $e->getMsg()]);
        if ($e instanceof ErrorException)
            return json(['code' => 100, 'msg' => $e->getMsg()]);
        // 其他错误交给系统处理
        Log::error($e->getMessage());
        return json(['code' => 101, 'msg' => '前方道路拥挤', 'test' => $e->getMessage()]);
        return parent::render($request, $e);
    }
}
