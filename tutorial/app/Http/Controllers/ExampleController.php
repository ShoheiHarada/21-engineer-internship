<?php


//このファイルの場所
namespace  App\Http\Controllers;

//useは、DIを用いる時に、パスを指定するもの。後ほどセッターインジェクション コンストラクターインストラクション、で使う
//継承に使用するファイルを選択
use App\Http\Controllers\Controller;
//使用するサービスファイル
use App\Services\ExampleService;

//モデルの中にクラスを定義している。Controllerクラスを継承している。（ControllerクラスはBaseControllerを継承している）
class ExampleController extends Controller
{
    //プロパティに設定する初期値がないので、メソッドインジェクションを使っている
    //デストラクタはhttpがステートレスなので、必要ではない。
    public function index(ExampleService $service)
    {
        //dataの配列、key:room_indexの値にgetRoomIndexから得た値を入れていく。
        $data['room_index'] = $service->getRoomIndex();
        print "<pre>";
        print_r($data);
        print "</pre>";
        //どこに返すのか・・・→呼び出し元はrouter。直で@indexが呼ばれている。
        //呪文「dataの中身をbladeに渡してviewをrouterに返す」
        exit;
        return $view('example')->with($data);
    }
}
