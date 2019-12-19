<?php

//このファイルの場所
namespace  App\Http\Requests;

//使うファイルのディレクトリ
use Illuminate\Foundation\Http\FormRequest;

//このファイルのクラス名と役割
class LoginRequest extends FormRequest
{
    protected $_inputs = [];

    public function all($keys = null)
    {
        if (!empty($this->_inputs)) {
            return $this->_inputs;
        }

        $this->_inputs = parent::all();

        return $this->_inputs;
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
            'address'=> 'required|max:100',
            'password'=>'required|min:4|max:50'
        ];
    }

    //パラメータの名前を設定
    public function attributes()
    {
        return [
            'address'=> 'メールアドレス',
            'password'=>'パスワード'
        ];
    }

    //バリデーションエラーの時のメッセージを設定
    public function messages()
    {
        return [
            'address.required'=> 'メールアドレスを入力してください',
            'address.max'=> 'メールアドレスは100文字以内で入力してください',
            'password.max'=> 'パスワードは50文字以内で入力してください',
            'password.required'=>'パスワードを入力してください',
            'password.min'=>'パスワードは4文字以上です'
        ];
    }
}
