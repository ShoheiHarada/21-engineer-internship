<?php

//このファイルの場所
namespace  App\Http\Middleware;

//使うファイルのディレクトリ
use Closure;

//このファイルのクラス名と役割
class UserUnAuthed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /*
         * ログイン中なら、トップにリダイレクト
         */
        if (\Auth::guard('user')->check()) {
            return redirect('/');
        }

        return $next($request);
    }
}
