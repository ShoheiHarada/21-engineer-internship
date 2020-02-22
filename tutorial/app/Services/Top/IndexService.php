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
//preDump($result['room_list'][1]['created_date'],1);

// foreach($result['room_list'] as $room){//preDump($room['created_date'],1);
//     $date = new \DateTime($room['created_date']);
//    // preDump(date('Y年m月d日　H時i分s秒', strtotime($room['created_date'])),1);
//     $room['created_date_jp']=date('Y年m月d日　H時i分s秒', strtotime($room['created_date']));
//    // preDump($room['created_date_jp'],1);
//             }
// preDump($result,1);
        return $result;
    }
}