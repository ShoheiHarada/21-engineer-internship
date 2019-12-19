<?php

//このファイルの場所
namespace  App\Services\User;

//使うファイルのディレクトリ
use App\Models\_common\UserData;

//このファイルのクラス名と役割
class IndexService
{
    protected $_user;

    //全体で使う変数等を定義
    public function __construct(UserData $user)
    {
        $this->_user = $user;
    }

    public function getUserData($param)
    {
        //対象ユーザーのデータを取得
        $data['user_data'] = $this->_user->getUserInfo($param['user_id']);
        $data['user_data']['img_exists'] = file_exists("storage/user_image/user_{$data['user_data']['user_id']}.jpg");

        return $data;
    }
}
