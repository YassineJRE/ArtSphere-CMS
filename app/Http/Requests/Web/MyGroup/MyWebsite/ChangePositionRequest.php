<?php

namespace App\Http\Requests\Web\MyGroup\MyWebsite;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ChangePositionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return 
            Auth::user()->groups->pluck('id')->contains($this->my_group->id)
            &&
            app('profile.session')->isAdministratorOfThisGroup($this->my_group);
    }
}
