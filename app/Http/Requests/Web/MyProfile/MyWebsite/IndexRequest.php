<?php

namespace App\Http\Requests\Web\MyProfile\MyWebsite;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class IndexRequest extends FormRequest
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
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->profiles->pluck('id')->contains($this->my_profile->id);
    }
}
