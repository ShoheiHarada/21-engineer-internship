<?php

//このファイルの場所
namespace  App\Models\_common;

//このファイルのクラス名と役割
class CommentData
{
    const TABLE = 'comment';

    //ルームIDからコメントリストを取得
    public function getCommentIdList($room_id)
    {
        //ページネーションにはLaravelのクエリビルダが便利なので使用
        //参考：https://readouble.com/laravel/5.5/ja/queries.html
        $result = \DB::table(self::TABLE)
            ->select('comment_id')
            ->where('room_id',$room_id)
            ->where('delete_flag',0)
            ->orderBy('created_date', 'asc')
            ->paginate(50);

        return stdClassToArray($result);
    }

    //コメントIDからコメントの情報を取得
    public function getCommentData($comment_id)
    {
        //実行したいSQL文を作成
        $sql = <<< End_of_sql
SELECT
    comment_id,
    destination_id,
    comment.user_id,
    user.name as user_name,
    user.delete_flag as user_unsub,
    destination.name as destination_name,
    destination.delete_flag as destination_unsub,
    comment_body,
    comment_text1,
    comment_text2,
    comment_flag1,
    comment_flag2,
    comment.created_date
FROM comment
LEFT JOIN user
    ON user.user_id = comment.user_id
LEFT JOIN user as destination
    ON destination.user_id = comment.destination_id
WHERE
    comment_id = :comment_id
AND
    comment.delete_flag = 0
End_of_sql;

        //SQL内で使う変数を定義
        $bind_params = [
            'comment_id' => $comment_id,
        ];

        $result = stdClassToArray(\DB::selectOne($sql, $bind_params));

        return $result;
    }

    //新しいコメントを登録
    public function postNewComment($param)
    {
        //現在時刻
        $now = nowDateTime();

        //実行したいSQL文を作成
        $sql = <<< End_of_sql
INSERT INTO
    comment
    (
        room_id,
        user_id,
        destination_id,
        comment_body,
        comment_text1,
        comment_text2,
        comment_flag1,
        comment_flag2,
        created_date,
        updated_date
    )
VALUES
    (
        :room_id,
        :user_id,
        :destination_id,
        :comment_body,
        :comment_text1,
        :comment_text2,
        :comment_flag1,
        :comment_flag2,
        :created_date,
        :updated_date
    )
End_of_sql;

        //SQL内で使う変数を定義
        $bind_params = [
            'room_id' => $param['room_id'],
            'user_id' => $param['user_id'],
            'destination_id' =>array_get($param,'destination_id',0),
            'comment_body' => mb_convert_kana($param['comment_body'],"KVnr"),
            'comment_text1' =>array_get($param,'comment_text1',''),
            'comment_text2' =>array_get($param,'comment_text2',''),
            'comment_flag1' =>array_get($param,'comment_flag1',0),
            'comment_flag2' =>array_get($param,'comment_flag2',0),
            'created_date' => $now,
            'updated_date' => $now
        ];

        $result = \DB::insert($sql, $bind_params);

        return $result;
    }

    //コメントの内容を更新
    public function updateComment($param)
    {
        //現在時刻
        $now = nowDateTime();

        //実行したいSQL文を作成
        $sql = <<< End_of_sql
UPDATE
    comment
SET
    comment_body    = :comment_body,
    comment_text1   = :comment_text1,
    comment_text2   = :comment_text2,
    comment_flag1   = :comment_flag1,
    comment_flag2   = :comment_flag2,
    updated_date    = :updated_date
WHERE
    comment_id = :comment_id
AND 
    user_id = :user_id
AND 
    room_id = :room_id
End_of_sql;

        //SQL内で使う変数を定義
        $bind_params = [
            'comment_body' => mb_convert_kana($param['comment_body'],"KVnr"),
            'comment_text1' =>array_get($param,'comment_text1',''),
            'comment_text2' =>array_get($param,'comment_text2',''),
            'comment_flag1' =>array_get($param,'comment_flag1',0),
            'comment_flag2' =>array_get($param,'comment_flag2',0),
            'updated_date' => $now,
            'comment_id' => $param['comment_id'],
            'user_id' => $param['user_id'],
            'room_id' => $param['room_id']
        ];

        $result = \DB::update($sql, $bind_params);

        return $result;
    }

    //コメントの削除フラグをたてる
    public function deleteComment($param)
    {
        //現在時刻
        $now = nowDateTime();

        //実行したいSQL文を作成
        $sql = <<< End_of_sql
UPDATE
    comment
SET
    delete_flag   = :delete_flag ,
    updated_date  = :updated_date
WHERE
    comment_id = :comment_id
AND 
    user_id = :user_id
AND 
    room_id = :room_id
End_of_sql;

        //SQL内で使う変数を定義
        $bind_params = [
            'delete_flag' => 1,
            'updated_date' => $now,
            'comment_id' => $param['comment_id'],
            'user_id' => $param['user_id'],
            'room_id' => $param['room_id']
        ];

        $result = \DB::update($sql, $bind_params);

        return $result;
    }
}
