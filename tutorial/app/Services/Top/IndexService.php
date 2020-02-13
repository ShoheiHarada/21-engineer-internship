<?php

//このファイルの場所
namespace  App\Services\Top;

//使うファイルのディレクトリ
use App\Models\_common\CategoryData;
use App\Models\_common\RoomData;
use App\Models\_common\UserData;

//このファイルのクラス名と役割
class IndexService
{
    protected $_category;
    protected $_room;
    protected $_user;

    //全体で使う変数等を定義
    public function __construct(
        CategoryData $category,
        RoomData $room,
        UserData $user
    )
    {
        $this->_category = $category;
        $this->_room = $room;
        $this->_user = $user;
    }

    //ルーム一覧を取得
    public function getRoomList($param)
    {
        //ルームIDのリストを取得
        $result = $this->_room->getRoomIdList($param);
        //検索があればページング用のパラメータ設定
        if (!empty($param['search'])) {
            $result['search'] = $param['search'];
        }

        //それぞれのルームの詳細を取得
        foreach ($result['data'] as $room) {
            $result['room_list'][] = $this->_room->getRoomData($room['room_id']);
        }

        return $result;
    }
}
