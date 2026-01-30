<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\Status as EnumStatus;
use App\Enums\ContentType as EnumContentType;
use Config;

class StoreRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$rules = [
			'key' => 'required|unique:contents,key',
            'type' => [
                'in:'.implode(',', EnumContentType::list()),
            ],
			'status' => [
                'in:'.implode(',', [EnumStatus::ENABLED, EnumStatus::DISABLED, EnumStatus::DELETED]),
            ],
			'content' => 'required|array',
		];

		foreach (Config::get('languages') as $lang => $language) {
            $rules['content.'.$lang] = 'required|string';
        }

		return $rules;
	}

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}
}
