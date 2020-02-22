<?php


//このファイルの場所
namespace  App\Http\Controllers;

//使用するファイル
use App\Http\Controllers\Controller;
use App\Services\ExampleService;
use App\Http\Requests\User\ExampleRequest;

//このファイルのクラス名と役割
class ExampleController extends Controller
{
  public function index(ExampleService $service,ExampleRequest $request) {  //ExampleServiceを$serviceに入れる
   
    $param = $request->all();  
    $data = $service->getRoomList($param);
   // preDump($data,1);
    
    $data['room_index'] = $service->getRoomIndex();   //ExampleServiceのgetRoomIndexを呼びだす
    //preDump($data,1);
    return view('example')->with($data);                //$data['room_index'] を応答として返す
  }
}

?>