<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//==============================================================
// ユーザー画面
//==============================================================
//Example
//Route::{get or post}('URL','コントローラーの場所＠コントローラー内の動かしたいメソッド名')
// ログイン不要で見れる画面
Route::get('/', 'Top\IndexController@index');
Route::get('/room', 'Room\IndexController@index');
Route::get('/user', 'User\IndexController@index');
Route::get('/category', 'Category\IndexController@index');
Route::get('/category/detail', 'Category\IndexController@detail');

// ログアウト状態ならアクセス出来る画面
Route::group(['middleware' => ['user.unauthed']], function () {
    //ログイン画面
    Route::get('/login', [
        'uses' => 'LoginController@login',
        'as' => 'user.login'
    ]);
    //ログイン処理
    Route::post('/login', [
        'uses' => 'LoginController@postLogin',
        'as' => 'user.login'
    ]);
    //アカウント作成画面
    Route::get('/sign-up', 'SignUpController@index');
    //アカウント作成
    Route::post('/sign-up', 'SignUpController@action');
});
// ログイン状態ならアクセス出来る画面
Route::group(['middleware' => ['user.authed']], function () {
    //ログアウト
    Route::get('/logout', 'LoginController@logout');
    //ルーム作成画面
    Route::get('/room/create', 'Room\IndexController@create');
    //ルーム作成
    Route::post('/room/create', 'Room\IndexController@actionCreate');
    //ルーム編集
    Route::post('/room/edit', 'Room\IndexController@actionEdit');
    //ルーム削除
    Route::post('/room/delete', 'Room\IndexController@actionDelete');
    //コメント投稿
    Route::post('/room/comment', 'Room\CommentController@actionPost');
    //コメント編集
    Route::post('/room/comment/edit', 'Room\CommentController@actionEdit');
    //コメント削除
    Route::post('/room/comment/delete', 'Room\CommentController@actionDelete');

    //マイページ画面
    Route::get('/mypage', 'Mypage\IndexController@index');
    //プロフィール画像変更
    Route::post('/mypage/image', 'Mypage\IndexController@image');
    //ユーザー名変更
    Route::get('/mypage/name', 'Mypage\IndexController@name');
    //アドレス変更
    Route::get('/mypage/address', 'Mypage\IndexController@address');
    //パスワード変更
    Route::get('/mypage/password', 'Mypage\IndexController@password');
    //退会
    Route::get('/mypage/unsub', 'Mypage\IndexController@unsub');
});
