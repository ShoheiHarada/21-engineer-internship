<?php

//このファイルの場所
namespace  App\Services\Category;

//使うファイルのディレクトリ
use App\Models\_common\CategoryData;
use App\Models\_common\RoomData;
use App\Models\_common\CommentData;
use App\Models\_common\UserData;

//このファイルのクラス名と役割
class IndexService
{
    protected $_category;
    protected $_room;
    protected $_user;
    protected $_comment;

    //全体で使う変数等を定義
    public function __construct(
        CategoryData $category,
        RoomData $room,
        UserData $user,
        CommentData $comment
    )
    {
        $this->_category = $category;
        $this->_room = $room;
        $this->_user = $user;
        $this->_comment = $comment;
    }

    //カテゴリ一覧を作成
    public function getCategoryList($param)
    {
        //カテゴリIDのリストを取得
        $data = $this->_category->getCategoryList($param);
        //$param['category_search']がセットされていればページング用の文字列をセット
        if (!empty($param['category_search'])) {
            $data['category_search'] = $param['category_search'];
        }

        return $data;
    }

    //カテゴリに属するルーム一覧を作成
    public function getRoomList($param)
    {
        //カテゴリの情報を取得
        $result['category_data'] = $this->_category->getCategoryData($param['category_id']);
        //カテゴリに属するルームのIDリストを取得
        $result += $this->_room->getRoomIdListByCategory($param['category_id']);
        //それぞれのルーム詳細を取得
        foreach ($result['data'] as $room) {
            $result['room_list'][] = $this->_room->getRoomData($room['room_id']);
        }

        return $result;
    }
}
