<?php

//このファイルの場所
namespace  App\Models\_common;

//このファイルのクラス名と役割
class CategoryData
{
    const TABLE = 'category';

    //カテゴリーIDからそのカテゴリーの情報を取得
    public function getCategoryData($category_id)
    {
        //実行したいSQL文を作成
        $sql = <<< End_of_sql
SELECT
    *
FROM
    category
WHERE
    category_id = :category_id
End_of_sql;

        //SQL内で使う変数を定義
        $bind_params = [
            'category_id' => $category_id,
        ];

        $result = stdClassToArray(\DB::selectOne($sql, $bind_params));

        return $result;
    }

    //カテゴリーIDのリストを取得
    public function getCategoryList($param)
    {
        $where = [];
        //もしカテゴリ検索をけけていたら
        if (isset($param['category_search'])) {
            //全角空白を半角空白に変換
            $search = preg_replace("|　|"," ",$param['category_search']);
            //検索ワードを半角カナ→全角カナ、全角英数字→半角英数字に変換
            $search_word = mb_convert_kana($search,"KVnr","UTF-8");
            //半角空白で区切ってそれぞれを配列に
            $search_words = explode(" ",$search_word);
            //すべての検索ワードに関して条件節を作成
            foreach ($search_words as $word) {
                $word = likeEscape($word);
                $where[] = ['category_name', 'LIKE', "%{$word}%"];
            }
        }

        //ページネーションにはLaravelのクエリビルダが便利なので使用
        //参考：https://readouble.com/laravel/5.5/ja/queries.html
        $result = \DB::table(self::TABLE)
            ->select(
                'category_id',
                'category_name',
                'room_count'
            )
            ->where('delete_flag', 0)
            ->where($where)
            ->orderBy('room_count', 'desc')
            ->paginate(20);

        //キー名を変更
        $result = stdClassToArray($result);
        $result['category_list'] = $result['data'];
        unset($result['data']);

        return $result;
    }

    //カテゴリーIDのリストを取得(サジェスト用)
    public function getCategoryListForSuggest()
    {
        //実行したいSQL文を作成
        $sql = <<< End_of_sql
SELECT
    category_name
FROM
    category
ORDER BY room_count desc
LIMIT 100

End_of_sql;

        $result = stdClassToArray(\DB::select($sql));

        return $result;
    }


    //新しいカテゴリを作成
    public function createNewCategory($param)
    {
        //現在時刻
        $now = nowDateTime();

        //実行したいSQL文を作成
        $sql = <<< End_of_sql
INSERT INTO
    category
    (
    category_name,
    created_date,
    updated_date
    )
VALUES
    (
    :category_name,
    :created_date,
    :updated_date
    )
End_of_sql;

        //SQL内で使う変数を定義
        $bind_params = [
            'category_name' => mb_convert_kana($param['category_name'],"KVnr"),
            'created_date' => $now,
            'updated_date' => $now,
    ];

        //インサートを実行
        \DB::insert($sql,$bind_params);

        //最後にインサートしたカテゴリのIDを取得
        $result = stdClassToArray(\DB::selectOne('SELECT LAST_INSERT_ID() AS category_id'));

        //作成したカテゴリIDを返す
        return array_get($result,'category_id');
    }

    //同じ名前のカテゴリが存在するか確認
    public function isExistCategory($category_name)
    {
        //実行したいSQL文を作成
        $sql = <<< End_of_sql
SELECT
    category_id
FROM
    category
WHERE
    category_name = :category_name
End_of_sql;

        //SQL内で使う変数を定義
        $bind_params = [
            'category_name' => $category_name,
        ];

        $result = stdClassToArray(\DB::selectOne($sql, $bind_params));

        //存在したらカテゴリIDを返す
        return array_get($result,'category_id');
    }

    //カテゴリの削除フラグをたてる
    public function deleteCategory($category_id)
    {
        //実行したいSQL文を作成
        $sql = <<< End_of_sql
UPDATE
    category
SET
    delete_flag = :delete_flag
WHERE
    category_id = :category_id
End_of_sql;

        //SQL内で使う変数を定義
        $bind_params = [
            'delete_flag' => 1,
            'category_id' => $category_id,
        ];

        $result = \DB::update($sql,$bind_params);

        return $result;
    }

    //カテゴリのルームカウントを更新
    public function updateCategoryRoomCount()
    {
        //実行したいSQL文を作成
        $sql = <<< End_of_sql
UPDATE
    category, 
    (
    SELECT 
        category.category_id,
        COUNT(room.room_id) as count,
        (CASE WHEN COUNT(room.room_id)=0 THEN 1 ELSE 0 END) AS del
    FROM category
    LEFT JOIN room
        ON category.category_id = room.category_id
    AND
        room.delete_flag = 0
    GROUP BY category_id
    ) AS counter
SET
    room_count = counter.count,
    delete_flag = counter.del
WHERE
    category.category_id = counter.category_id
AND 
    category.room_count <> counter.count
End_of_sql;

        $result = \DB::update($sql);

        return $result;
    }
}
