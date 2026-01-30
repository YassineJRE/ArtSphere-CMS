<?php

namespace App\Http\Requests\Web\MyProfile\MyArtwork;

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
            'name' => 'required|string',
            'description' => 'nullable|string',
            'location' => 'nullable|string',
            'date' => 'nullable|date',
            'photographer' => 'nullable|string',
            'medium' => 'nullable|string',
            'size' => 'nullable|string',
            'grant_acknowledgement' => 'nullable|string',
            'other_acknoledgements' => 'nullable|string',
            'media' => 'nullable|file|max:1500|mimes:jpeg,png,jpg,pdf,doc,docx',
            'status' => [
                'in:'.implode(',', EnumStatus::longPublish()),
            ],
            'size_lenght' => 'nullable|numeric',
            'size_width' => 'nullable|numeric',
            'size_height' => 'nullable|numeric',
            'video_url' => 'nullable|url',
            'photographer_link' => 'nullable|url',
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
            $this->my_profile->exhibits->pluck('id')->contains($this->my_exhibit->id);
    }
}
