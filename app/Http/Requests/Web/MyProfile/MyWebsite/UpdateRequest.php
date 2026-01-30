<?php

namespace App\Http\Requests\Web\MyProfile\MyWebsite;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Enums\Status as EnumStatus;

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
            'media' => 'nullable|file|max:1500|mimes:jpeg,png,jpg',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'url' => 'required|url',
            'owner_name' => 'nullable|string',
            'owner_link' => 'nullable|url',
            'additional_information_title' => 'nullable|string',
            'additional_information_content' => 'nullable|string',
            'status' => [
                'in:'.implode(',', EnumStatus::shortPublish()),
            ],
        ];

        if (!empty($this->url) && !$this->my_website->getFirstMedia()) {
            $rules = array_merge($rules, [
                'media' => 'required|file|max:1500|mimes:jpeg,png,jpg',
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
        return Auth::user()->profiles->pluck('id')->contains($this->my_profile->id);
    }
}
