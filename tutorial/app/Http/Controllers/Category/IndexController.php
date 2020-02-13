<?php


//このファイルの場所
namespace  App\Http\Controllers\Category;

//使うファイルのディレクトリ
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\DetailRequest;
use App\Http\Requests\Category\IndexRequest;
use App\Services\Category\IndexService;

//このファイルのクラス名と役割
class IndexController extends Controller
{
    //カテゴリ一覧表示
    public function index(IndexRequest $request, IndexService $service)
    {
        //バリデーションとパラメータ取得
        $param = $request->all();

        //サービスでカテゴリリストを取得
        $data = $service->getCategoryList($param);

        //取得したデータを使ってビューを表示
        return view('Category.index')->with($data);
    }

    //カテゴリの詳細表示
    public function detail(DetailRequest $request, IndexService $service)
    {
        //バリデーションとパラメータ取得
        $param = $request->all();
        //サービスでカテゴリに属するルームの一覧を取得
        $data = $service->getRoomList($param);

        $data['category_id'] = $param['category_id'];

        //取得したデータを使ってビューを表示
        return view('Category.detail')->with($data);
    }
}