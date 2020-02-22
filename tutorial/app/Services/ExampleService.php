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
        $id_list = $this->_room->getAllRoomId(); //さっきのメソッドを呼び出し

        foreach ($id_list as $row) {
            $detail = $this->_room->getRoomData($row['room_id']);//IDから詳細を取得して$detailに
            $detail_list[] = $detail;           //$detailを$detail_listにまとめる
        }
        //preDump($detail_list,1);                       //$detail_listの中身を表示して中断

        return $detail_list;                    //$detail_listをコントローラーへ返す
   }
}