<?php

namespace App\Http\Requests\Web\Register;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\ProfileType;
use App\Enums\ArtistType;
use App\Enums\ArtPracticeType;
use App\Enums\Status as EnumStatus;

class FinalizeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => 'required|in:'.implode(',', ProfileType::list()),
            'artist_name' => 'required_if:type,'.ProfileType::ARTIST.','.ProfileType::CURATOR,
            'other_artist_name' => 'nullable|string',
            'pronoun' => 'nullable|string',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'country' => 'required_if:type,'.ProfileType::ARTIST.','.ProfileType::CURATOR,
            'ethnicity' => 'nullable|string',
            'biography' => 'required_if:type,'.ProfileType::ARTIST.','.ProfileType::CURATOR,
            'artist_type' => 'nullable|in:'.implode(',', ArtistType::list()),
            'member_of' => 'nullable|string',
            'art_practice_type' => 'nullable|in:'.implode(',', ArtPracticeType::list()),
            'additional_information_title' => 'nullable|string',
            'additional_information_content' => 'nullable|string',
            'specify_artist_type' => 'nullable',
            'specify_art_practice_type' => 'nullable',
            'status' => [
                'in:'.implode(',', EnumStatus::shortPublish()),
            ],
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
