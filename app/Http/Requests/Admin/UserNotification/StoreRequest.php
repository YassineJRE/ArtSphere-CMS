<?php

namespace App\Http\Requests\Admin\UserNotification;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'profile_id' => 'exists:users,id',
			'ad_id'  => 'exists:ad,id',
			'comment_id'      => 'exists:comments,id',
			'review_id'    => 'exists:reviews,id',
			'contact_id'    => 'exists:contacts,id',
			'is_sent'    => '',
			'is_read'    => '',
		];
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
