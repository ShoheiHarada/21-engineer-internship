<?php

//このファイルの場所
namespace  App\Models\_common;

//このファイルのクラス名と役割
class UserData
{
    const TABLE = 'user';

    //ユーザーIDからユーザー情報を取得
    public function getUserInfo($user_id)
    {
        //実行したいSQL文を作成
        $sql = <<< End_of_sql
SELECT
    user_id,
    name,
    address,
    user_text1,
    user_text2,
    user_flag1,
    user_flag2
FROM user
WHERE
    user_id = :user_id
End_of_sql;

        //SQL内で使う変数を定義
        $bind_params = [
            'user_id' => $user_id,
        ];

        $result = stdClassToArray(\DB::selectOne($sql, $bind_params));

        return $result;
    }

    //アドレス、パスワードからユーザー情報を取得
    public function getUserAuthData($credentials)
    {
        //実行したいSQL文を作成
        $sql = <<< End_of_sql
SELECT
    user_id,
    name,
    address,
    password,
    user_text1,
    user_text2,
    user_flag1,
    user_flag2
FROM user
WHERE
    address = :address
AND
    password = :password
AND
    delete_flag = :delete_flag
End_of_sql;

        //SQL内で使う変数を定義
        $bind_params = [
            'address' => array_get($credentials, 'address'),
            'password' => array_get($credentials, 'password'),
            'delete_flag' => 0,
        ];

        $result = stdClassToArray(\DB::selectOne($sql, $bind_params));

        return $result;
    }

    //ユーザーIDからユーザー情報を取得（パスワード込み）
    public function getUserAuthDataById($user_id)
    {
        //実行したいSQL文を作成
        $sql = <<< End_of_sql
SELECT
    user_id,
    name,
    address,
    password,
    user_text1,
    user_text2,
    user_flag1,
    user_flag2
FROM user
WHERE
    user_id = :user_id

End_of_sql;

        //SQL内で使う変数を定義
        $bind_params = [
            'user_id' => $user_id
        ];

        $result = stdClassToArray(\DB::selectOne($sql, $bind_params));

        return $result;
    }


    //アカウント作成
    public function createNewAccount($param){
        //現在時刻
        $now = nowDateTime();

        //実行したいSQL文を作成
        $sql = <<< End_of_sql
INSERT INTO
    user
    (
        name,
        address,
        password,
        user_text1,
        user_text2,
        user_flag1,
        user_flag2,
        created_date,
        updated_date
    )
VALUES
    (
        :name,
        :address,
        :password,
        :user_text1,
        :user_text2,
        :user_flag1,
        :user_flag2,
        :created_date,
        :updated_date
    )
End_of_sql;

        //SQL内で使う変数を定義
        $bind_params = [
            'name' => mb_convert_kana($param['name'],"KVnr"),
            'password' => $param['password'],
            'address' => $param['address'],
            'user_text1' => '',
            'user_text2' => '',
            'user_flag1' => 0,
            'user_flag2' => 0,
            'created_date' => $now,
            'updated_date' => $now
        ];

        $result = \DB::insert($sql, $bind_params);

        return $result;
    }

    //ユーザー名を更新
    public function updateName($param){
        //現在時刻
        $now = nowDateTime();

        //実行したいSQL文を作成
        $sql = <<< End_of_sql
UPDATE
    user
SET
    name   = :name ,
    updated_date  = :updated_date
WHERE
    user_id = :user_id
End_of_sql;

        //SQL内で使う変数を定義
        $bind_params = [
            'name' => mb_convert_kana($param['name'],"KVnr"),
            'updated_date' => $now,
            'user_id' => $param['user_id']
        ];

        return \DB::update($sql, $bind_params);
    }

    //メールアドレスを更新
    public function updateAddress($param){
        //現在時刻
        $now = nowDateTime();

        //実行したいSQL文を作成
        $sql = <<< End_of_sql
UPDATE
    user
SET
    address   = :address,
    updated_date  = :updated_date
WHERE
    user_id = :user_id
End_of_sql;

        //SQL内で使う変数を定義
        $bind_params = [
            'address' => $param['address'],
            'updated_date' => $now,
            'user_id' => $param['user_id']
        ];

        return \DB::update($sql, $bind_params);
    }

    //パスワードを更新
    public function updatePassword($param){
        //現在時刻
        $now = nowDateTime();

        //実行したいSQL文を作成
        $sql = <<< End_of_sql
UPDATE
    user
SET
    password   = :password ,
    updated_date  = :updated_date
WHERE
    user_id = :user_id
End_of_sql;

        //SQL内で使う変数を定義
        $bind_params = [
            'password' => $param['password'],
            'updated_date' => $now,
            'user_id' => $param['user_id']
        ];

        return \DB::update($sql, $bind_params);
    }

    //アカウントの削除フラグをたてる
    public function deleteUser($user_id){
        //現在時刻
        $now = nowDateTime();

        //実行したいSQL文を作成
        $sql = <<< End_of_sql
UPDATE
    user
SET
    delete_flag   = :delete_flag ,
    updated_date  = :updated_date
WHERE
    user_id = :user_id
End_of_sql;

        //SQL内で使う変数を定義
        $bind_params = [
            'delete_flag' => 1,
            'updated_date' => $now,
            'user_id' => $user_id
        ];

        return \DB::update($sql, $bind_params);
    }
}
