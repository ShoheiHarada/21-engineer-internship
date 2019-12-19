<?php

//このファイルの場所
namespace  App\Http\Middleware;

//使うファイルのディレクトリ
use Closure;

//このファイルのクラス名と役割
class UserAuthed
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
         * 未ログインなら、ログインフォームにリダイレクト
         */
        if (!\Auth::guard('user')->check()) {
            return redirect('/login/');
        }

        return $next($request);
    }
}
