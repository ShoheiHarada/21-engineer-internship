<?php

//このファイルの場所
namespace  App\Providers;

//使うファイルのディレクトリ
use Illuminate\Support\ServiceProvider;

use App\Services\Auth\UserAuthGuard;
use App\Services\Auth\UserInfoProvider;

//このファイルのクラス名と役割
class UserAuthServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Auth::extend('user_auth_guard', function($app, $name, $config) {
            $userProvider = \Auth::createUserProvider($config['provider']);
            return new UserAuthGuard($userProvider);
        });

        \Auth::provider('user_provider', function($app, $config) {
            return \App::make(UserInfoProvider::class);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
