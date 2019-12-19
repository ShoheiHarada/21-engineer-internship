<?php

//このファイルの場所
namespace  App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

//このファイルのクラス名と役割
class SignUpRequest extends FormRequest
{
    protected $_inputs = [];

    public function all($keys = null)
    {
        if (!empty($this->_inputs)) {
            return $this->_inputs;
        }

        $inputs = parent::all();

        return $inputs;
    }

    public function authorize()
    {
        return true;
    }

    //バリデーションのルールを設定
    //参考：https://readouble.com/laravel/5.5/ja/validation.html#available-validation-rules
    public function rules()
    {
        return [
            'name'=> 'required|unique:user|max:50',
            'address'=> 'required|email|unique:user|max:100',
            'password'=>'required|min:4|max:50',
            'repeatPassword'=>'same:password'
        ];
    }

    //パラメータの名前を設定
    public function attributes()
    {
        return [
            'name'=> '氏名',
            'address'=> 'メールアドレス',
            'password'=>'パスワード',
            'repeatPassword'=>'確認用パスワード'
        ];
    }

    //バリデーションエラーの時のメッセージを設定
    public function messages()
    {
        return [
            'name.required'=> 'ユーザー名を入力してください',
            'name.unique'=> 'このユーザー名は使われています',
            'name.max'=> 'ユーザー名が長すぎます(最大50文字)',
            'address.required'=> 'メールアドレスを入力してください',
            'address.unique'=> 'このメールアドレスはすでに登録されています',
            'address.email'=> 'メールアドレスの形式が不正です',
            'address.max'=> 'メールアドレスが長すぎます(最大100文字)',
            'password.required'=>'パスワードを入力してください',
            'password.min'=>'パスワードが短すぎます(最低4文字)',
            'password.max'=>'パスワードが長すぎます(最大50文字)',
            'repeatPassword.same'=>'パスワードが一致していません'
        ];
    }
}
