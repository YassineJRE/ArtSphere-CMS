<?php

namespace App\Http\Requests\Web\MyGroup\MyCollection;

use App\Enums\Status as EnumStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            'description' => 'nullable|string',
            'additional_information_title' => 'nullable|string',
            'additional_information_content' => 'nullable|string',
            'status' => [
                'in:' . implode(',', EnumStatus::longPublish()),
            ],
            'exhibit_id' => 'nullable|exists:exhibits,id',
            'artwork_id' => 'nullable|exists:artworks,id',
            'collection_id' => 'nullable|exists:collections,id',
            'collection_item_id' => 'nullable|exists:collection_items,id',
            'website_id' => 'nullable|exists:websites,id',
            'website_group_id' => 'nullable|exists:website_groups,id',
            'user_profile_id' => 'nullable|exists:user_profiles,id',
            'group_id' => 'nullable|exists:groups,id',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes()
    {
        return [];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * The authenticated user must belong to the group and be an administrator of it.
     *
     * @return bool
     */
    public function authorize()
    {
        return
        Auth::user()->groups->pluck('id')->contains($this->my_group->id)
        && app('profile.session')->isAdministratorOfThisGroup($this->my_group);
    }
}
