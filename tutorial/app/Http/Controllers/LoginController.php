<?php


//このファイルの場所
namespace  App\Http\Controllers;

//使用するファイル
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Foundation\Auth\RedirectsUsers;

//このファイルのクラス名と役割
class LoginController extends Controller
{
    use RedirectsUsers;

    public function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/';
    }


    public function login()
    {
        session(['url.intended' => $_SERVER['HTTP_REFERER']]);
        //ビューを表示
        return view('login');
    }

    public function postLogin(LoginRequest $request)
    {
        //バリデーションとパラメータ取得
        $param = $request->all();
        //ログインを試行
        if (!\Auth::guard('user')->attempt($param)) {
            //表示用のデータを設定
            $data = [
                'loginError' => 'メールアドレスもしくはパスワード<br>が間違っています',
                'address' => $param['address']
            ];
            // ログイン失敗
            return redirect()->back()->with($data);
        }
        // ログイン成功
        return redirect()->intended($this->redirectPath());
    }

    public function logout()
    {
        if (\Auth::guard('user')->check()) {
            \Auth::guard('user')->logout();
        }

        return redirect('/login/');
    }
}