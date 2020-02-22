<?php


//このファイルの場所
namespace  App\Http\Requests\User;


use Illuminate\Foundation\Http\FormRequest;

class ExampleRequest extends FormRequest
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

	public function rules()
	{
		return [
		    'search' => 'filled'
        ];
	}

	public function attributes()
	{
		return [
            'search' => '検索ワード'
        ];
	}

	public function messages()
	{
		return [
            'search.filled' => '検索ワードを入力してください'
        ];
	}

	// ----------------------------------------------------

	protected function _format($inputs)
	{
		$rules = [];

		return [];
	}


  }
?>