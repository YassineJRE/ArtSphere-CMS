<?php

namespace App\Http\Requests\Web\MyProfile\MyCollection;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DestroyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'exhibit_id' => 'nullable|exists:exhibits,id',
            'artwork_id' => 'nullable|exists:artworks,id',
            'collection_id' => 'nullable|exists:collections,id',
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
            'exhibit_id' => 'exhibit',
            'artwork_id' => 'artwork',
            'collection_id' => 'collection',
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
