<?php 
    namespace  App\Services; 

    use App\Models\_common\RoomData;

    class ExampleService
    {
        protected $_room; //プロパティを作成

    //全体で使う変数等を定義
        public function __construct(RoomData $room)
        {
            $this->_room = $room;
        }
        public function getRoomIndex() {
            $search=array_get($_GET,"kennsaku");
            $id_list=$this->_room->getAllRoomId($search);
            $detail_list=[];

            foreach($id_list as $row){
                $detail=$this->_room->getRoomData($row["room_id"]);
                $detail_list[]=$detail;
            }
            //preDump($detail_list,1);
            return $detail_list;
        }

    }