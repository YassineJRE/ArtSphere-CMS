<?php

namespace App\Http\Requests\Web\MyGroup\Verification;

use Illuminate\Validation\Rule;
use App\Enums\VerifiedStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


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
            'verified_status' => [Rule::in(VerifiedStatus::list())],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->groups->pluck('id')->contains($this->my_group->id);
    }
}
