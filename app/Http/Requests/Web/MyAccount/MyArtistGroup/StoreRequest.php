<?php

namespace App\Http\Requests\Web\MyAccount\MyArtistGroup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Enums\InstitutionType;
use App\Enums\ArtPracticeType;

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
            'name' => 'required|string',
            'biography' => 'required',
            'address' => 'nullable',
            'country' => 'required',
            'city' => 'nullable',
            'mandate' => 'nullable',
            'institution_type' => 'nullable|in:'.implode(',', InstitutionType::list()),
            'member_of' => 'nullable|string',
            'art_practice_type' => 'nullable|in:'.implode(',', ArtPracticeType::list()),
            'additional_information_title' => 'nullable|string',
            'additional_information_content' => 'nullable|string',
            'status' => 'nullable',
            'specify_art_practice_type' => 'nullable',
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
