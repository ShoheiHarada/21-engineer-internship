<?php

//このファイルの場所
namespace App\Http\Controllers;

//使用するファイル
use App\Http\Controllers\Controller;
use App\Services\ExampleService;

//このファイルのクラス名と役割
class ExampleController extends Controller
{

    public function index(ExampleService $service) {  //ExampleServiceを$serviceに入れる
        $data['room_index'] = $service->getRoomIndex();   //ExampleServiceのgetRoomIndexを呼びだす
        $data["room_index"]=$this->changeDateSetNotation($data["room_index"]);

        //return $data['room_index'];                  //$data['room_index'] を応答として返す
        return view("example")->with($data);
    }

    //date_format関数を用いると簡単にできる
    function changeDateSetNotation($data){
        //preDump($data);
        foreach($data as &$room){
            $room=$this->changeDateNotation($room);
        }
        //unsetを用いないと$dateがまた別のところで用いられた場合値が残ってしまう
        unset($room);

        return $data;
    }

    function changeDateNotation($room){
            //$room=$this->changeDateNotation($room);
            $date = $room['created_date'];
            //表記が2020-1-20 19:20:10のような形式
            $date_components = explode(" ", $date);
            $month = explode("-", $date_components[0]);
            $new_month = $month[0] . "年" . $month[1] . "月" . $month[2] . "日";
            $room["created_date"] = $new_month." ".$date_components[1];

            return $room;

    }



}
