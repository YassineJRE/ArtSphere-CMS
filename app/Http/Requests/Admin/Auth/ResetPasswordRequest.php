<?php

namespace App\Http\Requests\Admin\Auth;

use App\Http\Requests\Api\ApiRequest;

class ResetPasswordRequest extends ApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'activation_url'            => 'nullable', // |url|active_url
            'email'                     => 'required|email|exists:users,email',
        ];
    }
}
