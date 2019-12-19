<?php


//このファイルの場所
namespace  App\Http\Requests\Top;


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

        $inputs = parent::all();

        // Format
        $this->_inputs = $this->_format($inputs);
        return $this->_inputs;
    }

    public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [];
	}

	public function attributes()
	{
		return [];
	}

	public function messages()
	{
		return [];
	}

	// ----------------------------------------------------

	protected function _format($inputs)
	{
		$rules = [];

		return [];
	}

}