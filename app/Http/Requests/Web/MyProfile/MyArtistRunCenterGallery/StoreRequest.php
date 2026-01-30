<?php

namespace App\Http\Requests\Web\MyProfile\MyArtistRunCenterGallery;

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
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'mandate' => 'required',
            'institution_type' => 'nullable|in:'.implode(',', InstitutionType::list()),
            'member_of' => 'nullable|string',
            'art_practice_type' => 'nullable|in:'.implode(',', ArtPracticeType::list()),
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
        return Auth::user()->profiles->pluck('id')->contains($this->my_profile->id);
    }
}
