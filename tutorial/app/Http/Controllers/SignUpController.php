<?php


//このファイルの場所
namespace  App\Http\Controllers;


//使うファイルのディレクトリ
use App\Http\Controllers\Controller;
use App\Http\Requests\SignUpRequest;
use App\Services\SignUpService;

//このファイルのクラス名と役割
class SignUpController extends Controller
{
    public function index()
    {
        //ビューを表示
        return view('sign_up');
    }


    public function action(SignUpRequest $request, SignUpService $service)
    {
        //バリデーションとパラメータ取得
        $param = $request->all();
        //serviceのcreateNewAccount()メソッドを起動
        $service->createNewAccount($param);
        //作ったアカウントでログインを試行
        if (!\Auth::guard('user')->attempt($param)) {
            // ログイン失敗
            return redirect()->back();
        }
        // ログイン成功
        return redirect('/')->with('flash_message','アカウントが作成されました');
    }
}