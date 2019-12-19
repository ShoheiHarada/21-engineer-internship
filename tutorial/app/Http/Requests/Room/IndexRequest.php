<?php

//このファイルの場所
namespace  App\Http\Requests\Room;

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
            'room_id'=> 'required|exists:room',
        ];
    }

    //パラメータの名前を設定
    public function attributes()
    {
        return [
            'room_id'=> 'ルームID',
        ];
    }

    //バリデーションエラーの時のメッセージを設定
    public function messages()
    {
        return [
            'room_id.required'=> 'ルームIDを入力してください',
            'room_id.exists'=> 'ルームが存在しません',
        ];
    }
}
