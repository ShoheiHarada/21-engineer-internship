<?php

//このファイルの場所
namespace  App\Services;

//使用するファイル
use App\Models\_common\RoomData;
//このファイルのクラス名と役割
class ExampleService
{
    protected $_room; //プロパティを作成

    //1.RoomDataをroomに代入するだけのファンクション
    public function __construct(RoomData $room)
    {
        //this->roomと書くことでモデルのRoomDataモデルが呼び出せるようになった
        //今のクラスのスコープで、roomプロパティにアクセス。
        //コンストラクタは、インスタンスが生成されたタイミングで、プロパティを初期化する役割を持つ。
        //初期値として$roomを設定。
        $this->_room = $room;
    }

    public function getRoomIndex() {

    $id_list = $this->_room->getAllRoomId();
    foreach($id_list as $row){ 
        // -> （アロー演算子）は左に記述したクラスのメソッドにアクセスする
        //$this->roomで呼び出したモデル内のgetRoomDataメソッドを呼び出す
        //getRoomDataメソッドは、RoomIDをわたすと、ルーム情報を取得する。
        $detail[] = $this->_room->getRoomData($row['room_id']);  
         //ルームIDをforeachで毎回自動で入力し、毎回取得したルーム情報を、ひとつづつ$detailの配列に入れる。
         //
                             //$detailの中身を表示して中断
                             
                            //  デバッグはこんなコードも使えるよ！
                            //  print "<pre>";
                            //  print_r($detail);
                            //  print "</pre>";

    
                            
                                                 //$detail_listの中身を表示して中断
        
         //returnのあとはコードが実行されないよ！
    }
    return ['サービス！',$detail];
}
}