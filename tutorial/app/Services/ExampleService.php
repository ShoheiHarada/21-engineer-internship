<?php

namespace App\Services;
use App\Models\_common\RoomData;

class ExampleService
{
  protected $_room; //プロパティを作成

  //全体で使う変数等を定義
  public function __construct(RoomData $room)
  {
      $this->_room = $room;
  }
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
    
  public function getRoomIndex() {
    //$id_list = $this->_room->getAllRoomId(); //さっきのメソッドを呼び出し
    $search = array_get($_GET,'kennsaku');              //送信した値を取得して変数に
        $id_list = $this->_room->getAllRoomId($search);     //RoomDataに渡す

        $detail_list = [];
//preDump($id_list,1);
    foreach ($id_list as $row) {
      $detail = $this->_room->getRoomData($row['room_id']);//IDから詳細を取得して$detailに
      $detail_list[] = $detail;           //$detailを$detail_listにまとめる
  }
// preDump($detail_list,1);                       //$detail_listの中身を表示して中断

        return  $detail_list;
}
}
?>