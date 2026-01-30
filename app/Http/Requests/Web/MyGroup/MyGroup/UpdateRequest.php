<?php

namespace App\Http\Requests\Web\MyGroup\MyGroup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Enums\InstitutionType;
use App\Enums\ArtPracticeType;

class UpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|string',
            'biography' => 'nullable',            
            'address' => 'nullable',
            'city' => 'nullable',
            'country' => 'required',
            'mandate' => 'nullable',
            'institution_type' => 'nullable|in:'.implode(',', InstitutionType::list()),
            'member_of' => 'nullable|string',
            'art_practice_type' => 'nullable|in:'.implode(',', ArtPracticeType::list()),
            'additional_information_title' => 'nullable|string',
            'additional_information_content' => 'nullable|string',
            'status' => 'nullable',
            'specify_artist_type' => 'nullable',
        ];

        if ($this->my_group->isArtistRunCenterOrganisation()) {
            $rules = array_merge($rules, [   
                'email' => 'required|email',
                'phone' => 'required',
                'mandate' => 'required',
                'city' => 'required',
                'address' => 'required',
            ]);
        }

        return $rules;
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
