<?php

namespace App\Http\Requests\Web\MyGroup\Member;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Enums\MemberType as EnumMemberType;

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
            'user_profile_id' => 'required|exists:user_profiles,id',
            'role' => 'required|in:'.implode(',', EnumMemberType::list()),
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
            'user_profile_id' => 'profile',
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
