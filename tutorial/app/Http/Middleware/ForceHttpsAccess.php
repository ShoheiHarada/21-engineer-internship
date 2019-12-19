<?php

//このファイルの場所
namespace  app\Http\Middleware;

//使うファイルのディレクトリ
use Closure;
use Illuminate\Http\Request;

/**
 * HTTPS強制
 * Class ForceHttpsAccess
 * @package MyCommon\Http\Middleware
 *
 * 参考：Laravel5.3でSSL通信を強制する - Qiita http://qiita.com/sawadashota/items/2f1c7b1e2905519c4e6a
 */
//このファイルのクラス名と役割
class ForceHttpsAccess
{
    public function handle(Request $request, Closure $next)
    {
        if (!$this->_isHttpsAccess($request)) {
            return redirect()->secure($request->getRequestUri());
        }

        return $next($request);
    }

    /**
     * HTTPアクセスか判定
     * @param Request $request
     * @return bool
     */
    protected function _isHttpsAccess(Request $request)
    {
        if (
                $request->getScheme() == 'https'
                || $request->server('HTTP_X_FORWARDED_PROTO') == 'https'
                || $request->server('SERVER_PORT') == '88'
        ) {
            return true;
        } else {
            return false;
        }
    }
}