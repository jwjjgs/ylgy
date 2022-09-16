<?php

declare(strict_types=1);

namespace app\middleware;

use app\exception\ErrorException;

class LoginMiddleware
{
    /**
     * 处理请求
     *
     * @param \think\Request $request
     * @param \Closure       $next
     * @return Response
     */
    public function handle($request, \Closure $next)
    {
        if (!session('?token'))
            throw new ErrorException('未登录');
        return $next($request);
    }
}
