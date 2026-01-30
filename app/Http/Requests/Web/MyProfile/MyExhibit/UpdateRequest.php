<?php

namespace App\Http\Requests\Web\MyProfile\MyExhibit;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Enums\ExhibitType;
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
            'name' => 'required|string',
            'type' => 'required|in:'.implode(',', ExhibitType::list()),
            'description' => 'nullable|string',
            'locations' => 'nullable|string',
            'dates' => 'nullable|string',
            'location' => 'nullable|string',
            'upcoming_date' => 'nullable|date|date_format:Y-m-d',
            'open_at' => 'nullable|date|date_format:Y-m-d H:i:s',
            'special_thanks' => 'nullable|string',
            'grant_acknowledgement' => 'nullable|string',
            'other_acknoledgements' => 'nullable|string',
            'additional_information_title' => 'nullable|string',
            'additional_information_content' => 'nullable|string',
            'status' => [
                'in:'.implode(',', EnumStatus::longPublish()),
            ],
            'verifier_id' => [
                'nullable', Rule::exists('groups', 'id'),
            ]
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
