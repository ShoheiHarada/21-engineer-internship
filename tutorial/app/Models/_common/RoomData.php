<?php

//このファイルの場所
namespace  App\Models\_common;

//このファイルのクラス名と役割
class RoomData
{
    const TABLE = 'room';

    //ルームIDのリストを取得
    public function getRoomIdList($param)
    {
        $where = [];
        $or_where = [];
        //ワード検索がかかっていた場合に設定
        if (isset($param['search'])) {
            //全角空白を半角空白に変換
            $search = preg_replace("|　|"," ",$param['search']);
            //検索ワードを半角カナ→全角カナ、全角英数字→半角英数字に変換
            $search_word = mb_convert_kana($search,"KVnr","UTF-8");
            //半角空白で区切ってそれぞれを配列に
            $search_words = explode(" ",$search_word);
            //すべての検索ワードに関して条件節を作成
            foreach ($search_words as $word) {
                $word = likeEscape($word);
                //ルーム名に対する条件
                $where[] = ['title', 'LIKE', "%{$word}%"];
                //ルーム詳細に対する条件
                $or_where[] = ['body', 'LIKE', "%{$word}%"];
            }

        }

        //ページネーションにはLaravelのクエリビルダが便利なので使用
        //参考：https://readouble.com/laravel/5.5/ja/queries.html
        $result = \DB::table(self::TABLE)
            ->select('room_id')
            ->where('delete_flag',0)
            ->where(function ($query) use ($where,$or_where) {
                    $query->where($where)
                        ->orWhere($or_where);
            })
            ->orderBy('created_date', 'desc')
            ->paginate(10);

        return stdClassToArray($result);
    }

    //カテゴリIDからルームIDリストを取得
    public function getRoomIdListByCategory($category_id)
    {
        //ページネーションにはLaravelのクエリビルダが便利なので使用
        //参考：https://readouble.com/laravel/5.5/ja/queries.html
        $result = \DB::table(self::TABLE)
            ->select('room_id')
            ->where('delete_flag',0)
            ->where('category_id',$category_id)
            ->orderBy('created_date', 'desc')
            ->paginate(10);

        return stdClassToArray($result);
    }

    //ルームIDからルームの詳細を取得
    public function getRoomData($room_id)
    {
        //実行したいSQL文を作成
        $sql = <<< End_of_sql
SELECT
    room.room_id,
    room.category_id,
    category_name,
    room.user_id as creator_id,
    title,
    body,
    room_text1,
    room_text2,
    room_flag1,
    room_flag2,
    room.created_date,
    name as creator,
    user.delete_flag as creator_unsub
FROM
    room
LEFT JOIN user
    ON user.user_id = room.user_id
LEFT JOIN category
    ON category.category_id = room.category_id
WHERE
    room.room_id = :room_id
AND
    room.delete_flag = 0
End_of_sql;

        //SQL内で使う変数を定義
        $bind_params = [
            'room_id' => $room_id,
        ];

        $result = stdClassToArray(\DB::selectOne($sql, $bind_params));

        return $result;
    }

    //新しいルームを作成
    public function createNewRoom($param)
    {
        //現在時刻
        $now = nowDateTime();

        //実行したいSQL文を作成
        $sql = <<< End_of_sql
INSERT INTO
    room
    (
        category_id,
        user_id,
        title,
        body,
        room_text1,
        room_text2,
        room_flag1,
        room_flag2,
        created_date,
        updated_date
    )
VALUES
    (
        :category_id,
        :user_id,
        :title,
        :body,
        :room_text1,
        :room_text2,
        :room_flag1,
        :room_flag2,
        :created_date,
        :updated_date
    )
End_of_sql;

        //SQL内で使う変数を定義
        $bind_params = [
            'category_id' => $param['category_id'],
            'user_id' => $param['user_id'],
            'title' => mb_convert_kana($param['title'],"KVnr"),
            'body' => mb_convert_kana($param['body'],"KVnr"),
            'room_text1' =>array_get($param,'room_text1',''),
            'room_text2' =>array_get($param,'room_text2',''),
            'room_flag1' =>array_get($param,'room_flag1',0),
            'room_flag2' =>array_get($param,'room_flag2',0),
            'created_date' => $now,
            'updated_date' => $now
        ];

        \DB::insert($sql,$bind_params);

        $result = stdClassToArray(\DB::selectOne('SELECT LAST_INSERT_ID() AS room_id'));

        return array_get($result,'room_id');
    }

    //ルーム情報を更新
    public function updateRoom($param)
    {
        //現在時刻
        $now = nowDateTime();
        //実行したいSQL文を作成
        $sql = <<< End_of_sql
UPDATE
    room
SET
    category_id = :category_id,
    title = :title,
    body = :body,
    room_text1 = :room_text1,
    room_text2 = :room_text2,
    room_flag1 = :room_flag1,
    room_flag2 = :room_flag2,
    updated_date = :updated_date
WHERE
    room_id = :room_id
AND
    user_id = :user_id
End_of_sql;

        //SQL内で使う変数を定義
        $bind_params = [
            'category_id' => $param['category_id'],
            'title' => mb_convert_kana($param['title'],"KVnr"),
            'body' => mb_convert_kana($param['body'],"KVnr"),
            'room_text1' =>array_get($param,'room_text1',''),
            'room_text2' =>array_get($param,'room_text2',''),
            'room_flag1' =>array_get($param,'room_flag1',0),
            'room_flag2' =>array_get($param,'room_flag2',0),
            'updated_date' => $now,
            'room_id' => $param['room_id'],
            'user_id' => $param['user_id']
        ];

        $result = \DB::update($sql,$bind_params);

        return $result;
    }

    //ルームの削除フラグを立てる
    public function deleteRoom($param)
    {
        //現在時刻
        $now = nowDateTime();
        //実行したいSQL文を作成
        $sql = <<< End_of_sql
UPDATE
    room
SET
    delete_flag = :delete_flag,
    updated_date = :updated_date
WHERE
    room_id = :room_id
AND
    user_id = :user_id
End_of_sql;

        //SQL内で使う変数を定義
        $bind_params = [
            'delete_flag' => 1,
            'updated_date' => $now,
            'room_id' => $param['room_id'],
            'user_id' => $param['user_id']
        ];

        $result = \DB::update($sql,$bind_params);

        return $result;
    }
}
