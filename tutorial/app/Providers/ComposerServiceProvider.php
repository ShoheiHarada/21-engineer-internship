<?php namespace app\Providers;

//使うファイルのディレクトリ
use Illuminate\Support\Facades\View; // Illuminate\Contracts\View\Factory
use Illuminate\Support\ServiceProvider;

//このファイルのクラス名と役割
class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * return void
     */
    public function boot()
    {
        // サイドバーのビューを読み込む時にViewComposerを呼び出す
        View::composer('_common.sidebar', 'App\Http\Controllers\ViewComposer');
        View::composer('Mypage.index', 'App\Http\Controllers\ViewComposer');
        View::composer('Room.index', 'App\Http\Controllers\ViewComposer');

    }

    /**
     * Register
     */
    public function register()
    {
    }
}
