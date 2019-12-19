<?php


//このファイルの場所
namespace  App\Http\Controllers\Mypage;


//使うファイルのディレクトリ
use App\Http\Controllers\Controller;
use App\Http\Requests\Mypage\IndexRequest;
use App\Services\Mypage\IndexService;

//このファイルのクラス名と役割
class IndexController extends Controller
{
    //画面表示
    public function index()
    {
        //ログイン状態かチェック
        if (!\Auth::guard('user')->check()) {
            //ログインしていなければトップへ
            return redirect('/');
        }
        $user_id = \Auth::guard('user')->Id();
        $data['img_exists'] = file_exists("storage/user_image/user_$user_id.jpg");
        //ビューを表示
        return view('Mypage.index')->with($data);
    }

    //プロフィール画像変更
    public function image(IndexRequest $request)
    {
        $param = $request->all();
        $user_id = \Auth::guard('user')->Id();
        if(isset($param['user_image'])) {
            $request->file('user_image')->storeAs('public/user_image',"user_$user_id.jpg");
            return redirect("/mypage");
        }
        //失敗したらセッション変数にエラーメッセージを入れて戻る
        return redirect()->back()->with('alert','プロフィール画像の変更に失敗しました');
    }

    //ユーザー名変更
    public function name(IndexRequest $request, IndexService $service)
    {
        //バリデーションとパラメータ取得
        $param = $request->all();
        //serviceのupdateName()メソッドを起動
        if ($service->updateName($param)){
            //成功したらマイページへ
            return redirect('/mypage');
        }

        //失敗したらセッション変数にエラーメッセージを入れて戻る
        return redirect()->back()->with('alert','ユーザー名の変更に失敗しました');
    }

    //ユーザー名変更
    public function address(IndexRequest $request, IndexService $service)
    {
        $param = $request->all();
        if ($service->updateAddress($param)){
            return redirect('/mypage');
        }

        return redirect()->back()->with('alert','メールアドレスの変更に失敗しました');
    }

    //ユーザー名変更
    public function password(IndexRequest $request, IndexService $service)
    {
        $param = $request->all();
        if ($service->updatePassword($param)){
            return redirect('/mypage');
        }

        return redirect()->back()->with('alert','パスワードが正しくありません');
    }

    //ユーザー名変更
    public function unsub(IndexService $service)
    {
        if ($service->deleteUser()){
            return redirect('/');
        }

        return redirect()->back()->with('alert','退会に失敗しました');
    }
}