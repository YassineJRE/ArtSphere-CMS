<?php

namespace App\Http\Requests\Admin\Auth;

use App\Http\Requests\Api\ApiRequest;

class ChangePasswordRequest extends ApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email'             => 'required|email|exists:users,email',
            'password'          => 'required|string|min:8|max:255',
            'token'             => 'required|string',
        ];
    }
}
