<?php

//このファイルの場所
namespace  App\Services;

//使用するファイル
use App\Models\_common\RoomData;


//このファイルのクラス名と役割
class ExampleService
{
    protected $_room; //プロパティを作成

    //全体で使う変数等を定義
    public function __construct(RoomData $room)
    {
        $this->_room = $room;
    }
 public function getRoomIndex() 
 {
    $search = array_get($_GET,'kennsaku');
                  //送信した値を取得して変数に
    $id_list = $this->_room->getAllRoomId($search);     //RoomDataに渡す

    $detail_list = [];

    foreach ($id_list as $row) {

        $detail = $this->_room->getRoomData($row['room_id']);   //ルームIDが5のルーム情報を取得して$detailに入れる
    //$detailの中身を表示して

    $detail_list[] = $detail;           //$detailを$detail_listにまとめる
        }

    //ここにメソッドの中身を書きます
    return $detail_list; 
}
}

    ;