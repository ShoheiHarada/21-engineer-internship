<?php


//このファイルの場所
namespace  App\Http\Controllers\User;


//使うファイルのディレクトリ
use App\Http\Controllers\Controller;
use App\Http\Requests\User\IndexRequest;
use App\Services\User\IndexService;

//このファイルのクラス名と役割
class IndexController extends Controller
{
    public function index(IndexRequest $request, IndexService $service)
    {
        //バリデーションとパラメータ取得
        $param = $request->all();
        //対象のユーザーIDが自分のものかを確認
        if ($param ['user_id'] == \Auth::guard('user')->Id()) {
            //自分のものならマイページへ
            return redirect('/mypage');
        };
        //serviceのgetUserData()メソッドを起動
        if (!$data = $service->getUserData($param)) {
            //失敗するとトップ画面へ
            return redirect('/')->with('alert' , '指定したユーザーは既に退会したか存在しません。');
        };

        //ビューを表示
        return view('User.index')->with($data);
    }
}