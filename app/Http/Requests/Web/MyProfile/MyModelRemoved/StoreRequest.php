<?php

namespace App\Http\Requests\Web\MyProfile\MyModelRemoved;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Auth::user()
            ->profiles
            ->pluck('id')
            ->contains($this->my_profile->id);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'exhibit_id' => 'nullable|exists:exhibits,id',
            'artwork_id' => 'nullable|exists:artworks,id',
            'collection_item_id' => 'nullable|exists:collection_items,id',
            'collection_id' => 'nullable|exists:collections,id',

            'website_group_id' => [
                'nullable',
                'integer',
                function ($attribute, $value, $fail) {
                    $exists = DB::table('websites')
                        ->where('id', $value)
                        ->whereNull('parent_id')
                        ->exists();

                    if (!$exists) {
                        $fail(__('validation.exists', ['attribute' => $attribute]));
                    }
                },
            ],

            'website_id' => [
                'nullable',
                'integer',
                function ($attribute, $value, $fail) {
                    $exists = DB::table('websites')
                        ->where('id', $value)
                        ->whereNotNull('parent_id')
                        ->exists();

                    if (!$exists) {
                        $fail(__('validation.exists', ['attribute' => $attribute]));
                    }
                },
            ],

            'user_profile_id' => 'nullable|exists:user_profiles,id',
            'group_id' => 'nullable|exists:groups,id',
        ];
    }

    /**
     * Get custom attribute names for validation errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'exhibit_id' => 'exhibit',
            'artwork_id' => 'artwork',
            'website_group_id' => 'website group',
            'website_id' => 'website',
            'user_profile_id' => 'profile',
            'group_id' => 'group',
            'collection_item_id' => 'collection item',
            'collection_id' => 'collection',
        ];
    }
}
