<?php

//このファイルの場所
namespace  App\Models\_common;

//このファイルのクラス名と役割
class CommonData
{
    //ユーザーIDからそのユーザーが作成したルーム数を取得
    public function getCreatedRoom($user_id)
    {
        //実行したいSQL文を作成
        $sql = <<< End_of_sql
SELECT
    COUNT(room_id) as created_room
FROM
    room
WHERE
    user_id = :user_id
AND
    delete_flag = 0
End_of_sql;

        //SQL内で使う変数を定義
        $bind_params = [
           'user_id' => $user_id,
        ];

        $result = stdClassToArray(\DB::selectOne($sql, $bind_params));

        return $result['created_room'];
    }

    //ユーザーIDからそのユーザーが投稿したコメントを取得
    public function getPostedComment($user_id)
    {
        //実行したいSQL文を作成
        $sql = <<< End_of_sql
SELECT
    COUNT(comment_id) as posted_comment
FROM
    comment
WHERE
    user_id = :user_id
AND
    delete_flag = 0
End_of_sql;

        //SQL内で使う変数を定義
        $bind_params = [
            'user_id' => $user_id,
        ];

        $result = stdClassToArray(\DB::selectOne($sql, $bind_params));

        return $result['posted_comment'];
    }

    //ユーザーIDからそのユーザーが参加したルーム数を取得
    public function getJoinedRoom($user_id)
    {
        //実行したいSQL文を作成
        $sql = <<< End_of_sql
SELECT
    COUNT(DISTINCT room_id) as joined_room
FROM
    comment
WHERE
    user_id = :user_id
AND
    delete_flag = 0
End_of_sql;

        //SQL内で使う変数を定義
        $bind_params = [
            'user_id' => $user_id,
        ];

        $result = stdClassToArray(\DB::selectOne($sql, $bind_params));

        return $result['joined_room'];
    }

    //コメント数ランキングを取得
    public function getRanking()
    {
        //現在時刻
        $now = nowDateTime();
        //実行したいSQL文を作成
        $sql = <<< End_of_sql
SELECT
    title,
    room.room_id,
    count(comment_id) as comment_count
FROM
    room
LEFT JOIN comment
    ON room.room_id = comment.room_id
WHERE
    room.delete_flag = 0
AND
    comment.delete_flag = 0
AND
    room.created_date > (:now - INTERVAL 1 MONTH)
GROUP BY room.room_id
ORDER BY comment_count DESC,
        room.created_date ASC
LIMIT 10
End_of_sql;

        //SQL内で使う変数を定義
        $bind_params = [
            'now' => $now,
        ];

        $result = stdClassToArray(\DB::select($sql, $bind_params));

        return $result;
    }
}
