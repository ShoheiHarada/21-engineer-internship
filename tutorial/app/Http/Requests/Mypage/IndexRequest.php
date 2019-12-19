<?php

//このファイルの場所
namespace  App\Http\Requests\Mypage;

//使うファイルのディレクトリ
use Illuminate\Foundation\Http\FormRequest;

//このファイルのクラス名と役割
class IndexRequest extends FormRequest
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
            'user_image'=> 'mimes:jpeg,jpg,JPEG,JPG|max:2000',
            'name'=> 'min:1|max:50',
            'address'=> 'email|max:100',
            //userテーブルのpasswordに存在
            'old_password'=>'exists:user,password',
            'new_password1'=>'min:4|max:50',
            'new_password2'=>'same:new_password1'
        ];
    }

    //パラメータの名前を設定
    public function attributes()
    {
        return [
            'name'=> '氏名',
            'address'=> 'メールアドレス',
            'old_password'=>'旧パスワード',
            'new_password1'=>'新しいパスワード',
            'new_password2'=>'新しいパスワード(確認用)'
        ];
    }

    //バリデーションエラーの時のメッセージを設定
    public function messages()
    {
        return [
            'name.min'=> '氏名を入力してください',
            'name.max'=> '氏名が長すぎます(最大50文字)',
            'address.email'=> 'メールアドレスの形式が不正です',
            'address.max'=> 'メールアドレスが長すぎます(最大100文字)',
            'old_password.exists'=>'パスワードが正しくありません',
            'new_password1.min'=>'新しいパスワードが短すぎます(最低4文字)',
            'new_password1.max'=>'新しいパスワードが長すぎます(最大50文字)',
            'new_password2.same'=>'新しいパスワードが一致していません'
        ];
    }
}
