<?php

//このファイルの場所
namespace  App\Http\Requests\Room;

//使うファイルのディレクトリ
use Illuminate\Foundation\Http\FormRequest;

//このファイルのクラス名と役割
class ActionRequest extends FormRequest
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
            'title'=> 'required|min:5|max:100',
            'category_name'=> 'required|max:50',
            'body'=>'required|max:5000'
        ];
    }

    //パラメータの名前を設定
    public function attributes()
    {
        return [
            'title'=> 'ルーム名',
            'category_name'=>'カテゴリ',
            'body'=>'ルーム詳細'
        ];
    }

    //バリデーションエラーの時のメッセージを設定
    public function messages()
    {
        return [
            'title.required'=> 'ルーム名を入力してください',
            'title.min'=> 'ルーム名は5文字以上入力してください',
            'title.max'=> 'ルーム名は100文字以内で入力してください',
            'category_name.required'=>'カテゴリを入力してください',
            'category_name.max'=> 'カテゴリは50文字以内で入力してください',
            'body.required'=>'ルーム詳細を入力してください',
            'body.max'=> 'ルーム詳細は500文字以内で入力してください',
        ];
    }
}
