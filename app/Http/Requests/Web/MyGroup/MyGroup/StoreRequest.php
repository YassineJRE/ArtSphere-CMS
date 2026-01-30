<?php

namespace App\Http\Requests\Web\MyGroup\MyGroup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Enums\ArtistType;
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
            'artist_name' => 'required|string',
            'other_artist_name' => 'nullable|string',
            'biography' => 'required',
            'artist_type' => 'nullable|in:'.implode(',', ArtistType::list()),
            'member_of' => 'nullable|string',
            'art_practice_type' => 'nullable|in:'.implode(',', ArtPracticeType::list()),
            'additional_information_title' => 'nullable|string',
            'additional_information_content' => 'nullable|string',
            'specify_artist_type' => 'nullable',
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
