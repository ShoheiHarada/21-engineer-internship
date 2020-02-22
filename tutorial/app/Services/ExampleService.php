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

    public function getRoomIndex() {
        $id_list = $this->_room->getAllRoomId();
        foreach ($id_list as $row) {
            $detail = $this->_room->getRoomData($row['room_id']);//IDから詳細を取得して$detailに
            $detail_list[] = $detail;           //$detailを$detail_listにまとめる
        }
        //preDump($detail_list,1);            preDump($id_list,1);
        //ここにメソッドの中身を書きます
        return $detail_list;
   }
}