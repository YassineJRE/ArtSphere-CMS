<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'pagination' => 'nullable|array',
            'pagination.currentPage' => 'numeric|min:1',
            'pagination.perPage' => 'numeric',
            'pagination.hasMorePages' => 'boolean',
            'sortBy' => 'nullable|string',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
