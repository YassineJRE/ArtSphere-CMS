<?php

namespace App\Http\Requests\Web\MyProfile\MyCollectionItem;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * At least one of the following IDs must be present and exist:
     * exhibit_id, artwork_id, collection_id, collection_item_id,
     * website_id, website_group_id, user_profile_id, or group_id.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $requiredIfNoneOtherPresent = function ($excludedKeys) {
            return Rule::requiredIf(function () use ($excludedKeys) {
                foreach ($excludedKeys as $key) {
                    if (!empty($this->request->get($key))) {
                        return false;
                    }
                }
                return true;
            });
        };

        return [
            'exhibit_id' => [
                $requiredIfNoneOtherPresent([
                    'artwork_id', 'collection_id', 'collection_item_id', 'website_id', 'website_group_id', 'user_profile_id', 'group_id',
                ]),
                'nullable',
                'exists:exhibits,id',
            ],
            'artwork_id' => [
                $requiredIfNoneOtherPresent([
                    'exhibit_id', 'collection_id', 'collection_item_id', 'website_id', 'website_group_id', 'user_profile_id', 'group_id',
                ]),
                'nullable',
                'exists:artworks,id',
            ],
            'collection_id' => [
                $requiredIfNoneOtherPresent([
                    'exhibit_id', 'artwork_id', 'collection_item_id', 'website_id', 'website_group_id', 'user_profile_id', 'group_id',
                ]),
                'nullable',
                'exists:collections,id',
            ],
            'collection_item_id' => [
                $requiredIfNoneOtherPresent([
                    'exhibit_id', 'artwork_id', 'collection_id', 'website_id', 'website_group_id', 'user_profile_id', 'group_id',
                ]),
                'nullable',
                'exists:collection_items,id',
            ],
            'website_group_id' => [
                $requiredIfNoneOtherPresent([
                    'exhibit_id', 'artwork_id', 'collection_id', 'collection_item_id', 'website_id', 'user_profile_id', 'group_id',
                ]),
                'nullable',
                'exists:websites,id',
            ],
            'website_id' => [
                $requiredIfNoneOtherPresent([
                    'exhibit_id', 'artwork_id', 'collection_id', 'collection_item_id', 'website_group_id', 'user_profile_id', 'group_id',
                ]),
                'nullable',
                'exists:websites,id',
            ],
            'user_profile_id' => [
                $requiredIfNoneOtherPresent([
                    'exhibit_id', 'artwork_id', 'collection_id', 'collection_item_id', 'website_id', 'website_group_id', 'group_id',
                ]),
                'nullable',
                'exists:user_profiles,id',
            ],
            'group_id' => [
                $requiredIfNoneOtherPresent([
                    'exhibit_id', 'artwork_id', 'collection_id', 'collection_item_id', 'website_id', 'website_group_id', 'user_profile_id',
                ]),
                'nullable',
                'exists:groups,id',
            ],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes()
    {
        return [
            'exhibit_id' => 'exhibit',
            'artwork_id' => 'artwork',
            'collection_id' => 'collection',
            'collection_item_id' => 'collection item',
            'website_group_id' => 'website group',
            'website_id' => 'website',
            'user_profile_id' => 'profile',
            'group_id' => 'group',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * User must belong to the profile and the collection must belong to the profile.
     *
     * @return bool
     */
    public function authorize()
    {
        return
        Auth::user()->profiles->pluck('id')->contains($this->my_profile->id)
        &&
        $this->my_profile->collections->pluck('id')->contains($this->my_collection->id);
    }
}
