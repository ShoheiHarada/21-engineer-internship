<?php

//このファイルの場所
namespace  App\Services\Mypage;

//使うファイルのディレクトリ
use App\Models\_common\UserData;

//このファイルのクラス名と役割
class IndexService
{
    protected $_user;

    //全体で使う変数を定義
    public function __construct(UserData $user)
    {
        $this->_user = $user;
    }

    //ユーザー名を更新
    public function updateName($param)
    {
        //ユーザーIDを取得
        $param['user_id'] = \Auth::guard('user')->Id();

        //ユーザー名を更新
        return $this->_user->updateName($param);
    }

    public function updateAddress($param)
    {
        //ユーザーIDを取得
        $param['user_id'] = \Auth::guard('user')->Id();

        //メールアドレスを更新
        return $this->_user->updateAddress($param);
    }

    public function updatePassword($param)
    {
        //ユーザーIDを取得
        $param['user_id'] = \Auth::guard('user')->Id();
        //キーを変更
        $param['password'] = $param['new_password1'];

        //パスワードを更新
        return $this->_user->updatePassword($param);
    }

    public function deleteUser()
    {
        //ユーザーIDを取得
        $param['user_id'] = \Auth::guard('user')->Id();

        //アカウントを削除
        if ($this->_user->deleteUser($param['user_id'])) {
            //成功したらログアウト処理
            return \Auth::guard('user')->logout();
        }

        return false;
    }
}
