<?php

namespace App\Http\Requests\Web\MyAccount;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDetailsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'email' => 'email',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'avatar' => 'nullable|file|max:1500|image|mimes:jpeg,png,jpg,gif,svg',
            'pronoun' => 'nullable|string',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'country' => 'required|string',
            'ethnicity' => 'nullable|string',
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
