<?php

namespace App\Http\Requests\Web\MyProfile\MyWebsiteGroup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Enums\Status as EnumStatus;

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
            'type' => 'nullable',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'additional_information_title' => 'nullable|string',
            'additional_information_content' => 'nullable|string',
            'status' => [
                'in:'.implode(',', EnumStatus::shortPublish()),
            ],
            'specify_website_group_type' => 'nullable|string',
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
