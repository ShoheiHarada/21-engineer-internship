<?php

//このファイルの場所
namespace  App\Http\Requests\Room;

//使うファイルのディレクトリ
use Illuminate\Foundation\Http\FormRequest;

//このファイルのクラス名と役割
class CommentRequest extends FormRequest
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
            'room_id' => 'numeric|exists:room',
            'comment_id' => 'numeric|exists:comment',
            'destination_id'=> 'numeric|exists:user,user_id',
            'comment_body'=> 'required_with:destination_id|required_without:comment_id|min:1|max:500',
        ];
    }

    //パラメータの名前を設定
    public function attributes()
    {
        return [
            'comment_id' => 'コメントID',
            'destination_id'=> '返信先',
            'comment_body'=> 'コメント',
        ];
    }

    //バリデーションエラーの時のメッセージを設定
    public function messages()
    {
        return [
            'room_id.numeric' => '対象のルームが削除されたか存在しません',
            'room_id.exists' => '対象のルームが削除されたか存在しません',
            'comment_id.numeric' => '対象のコメントが削除されたか存在しません',
            'comment_id.exists' => '対象のコメントが削除されたか存在しません',
            'destination_id.numeric'=> '対象のコメントが削除されたか存在しません',
            'destination_id.exists'=> '対象のコメントが削除されたか存在しません',
            'comment_body.required_with'=> 'コメントを入力してください',
            'comment_body.required_without'=> 'コメントを入力してください',
            'comment_body.min'=> 'コメントを入力してください',
            'comment_body.max'=> 'コメントは500文字以内で入力してください',
        ];
    }

}
