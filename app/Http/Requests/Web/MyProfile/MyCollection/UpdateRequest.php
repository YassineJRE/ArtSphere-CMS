<?php

namespace App\Http\Requests\Web\MyProfile\MyCollection;

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
        return [
            'title' => 'required|string',
            'description' => 'nullable|string',
            'additional_information_title' => 'nullable|string',
            'additional_information_content' => 'nullable|string',
            'status' => [
                'in:'.implode(',', EnumStatus::longPublish()),
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
        return Auth::user()->profiles->pluck('id')->contains($this->my_profile->id);
    }
}
