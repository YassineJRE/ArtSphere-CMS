<?php

namespace App\Http\Requests\Web\MyGroup\MyCollectionItem;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DestroyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'exhibit_id' => 'nullable|exists:exhibits,id',
            'artwork_id' => 'nullable|exists:artworks,id',
            'collection_id' => 'nullable|exists:collections,id',
            'collection_item_id' => 'nullable|exists:collection_items,id',
            'website_id' => 'nullable|exists:websites,id',
            'website_group_id' => 'nullable|exists:websites,id',
            'user_profile_id' => 'nullable|exists:user_profiles,id',
            'group_id' => 'nullable|exists:groups,id',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'exhibit_id' => 'exhibit',
            'artwork_id' => 'artwork',
            'collection_id' => 'collection',
            'collection_item_id' => 'collection item',
            'website_id' => 'website',
            'website_group_id' => 'website group',
            'user_profile_id' => 'profile',
            'group_id' => 'group',
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
        Auth::user()->groups->pluck('id')->contains($this->my_group->id)
        &&
        app('profile.session')->isAdministratorOfThisGroup($this->my_group);
    }
}
