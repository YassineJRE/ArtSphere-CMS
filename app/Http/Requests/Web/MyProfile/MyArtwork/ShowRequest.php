<?php

namespace App\Http\Requests\Web\MyProfile\MyArtwork;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class ShowRequest extends FormRequest
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
        return 
            Auth::user()->profiles->pluck('id')->contains($this->my_profile->id) 
            &&
            $this->my_profile->exhibits->pluck('id')->contains($this->my_exhibit->id)
            &&
            $this->my_exhibit->artworks->pluck('id')->contains($this->my_artwork->id);
    }
}
