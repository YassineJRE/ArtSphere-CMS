<?php

namespace App\Http\Requests\Web\MyAccount\MyCuratorProfile;

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
            'artist_name' => 'required|string',
            'pronoun' => 'nullable',
            'first_name' => 'nullable',
            'last_name' => 'nullable',
            'address' => 'nullable',
            'city' => 'nullable',
            'country' => 'nullable',
            'ethnicity' => 'nullable',
            'biography' => 'required',
            'member_of' => 'nullable|string',
            'additional_information_title' => 'nullable|string',
            'additional_information_content' => 'nullable|string',
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
