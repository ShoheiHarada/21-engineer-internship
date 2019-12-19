<?php


//このファイルの場所
namespace  App\Http\Controllers\Category;

//使うファイルのディレクトリ
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\IndexRequest;
use App\Services\Category\IndexService;

//このファイルのクラス名と役割
class IndexController extends Controller
{
    //カテゴリ一覧表示
    public function index(IndexService $service)
    {
        //サービスでカテゴリリストを取得
        $data = $service->getCategoryList();

        //取得したデータを使ってビューを表示
        return view('Category.index')->with($data);
    }

    //カテゴリの詳細表示
    public function detail(IndexRequest $request, IndexService $service)
    {
        //バリデーションとパラメータ取得
        $param = $request->all();
        //サービスでカテゴリに属するルームの一覧を取得
        $data = $service->getRoomList($param);

        //取得したデータを使ってビューを表示
        return view('Category.detail')->with($data);
    }
}