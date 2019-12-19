<?php


//このファイルの場所
namespace  App\Http\Controllers\Top;

//使用するファイル
use App\Http\Controllers\Controller;
use App\Http\Requests\Top\IndexRequest;
use App\Services\Top\IndexService;

//このファイルのクラス名と役割
class IndexController extends Controller
{
    public function index(IndexRequest $request, IndexService $service)
    {
        //バリデーションとパラメータ取得
        $param = $request->all();
        //serviceのgetRoomList()を起動
        $data = $service->getRoomList($param);

        //取得したデータを使ってビューを表示
        return view('top.index')->with($data);
    }
}