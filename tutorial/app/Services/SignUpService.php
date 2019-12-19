<?php

//このファイルの場所
namespace  App\Services;

use App\Models\_common\UserData;

//このファイルのクラス名と役割
class SignUpService
{
    protected $_model;

    //全体で使う変数等を定義
    public function __construct(UserData $model)
    {
        $this->_model = $model;
    }

    //アカウントを新規作成
    public function createNewAccount($param)
    {
        //アカウントを新規作成
        $this->_model->createNewAccount($param);

        return true;
    }
}
