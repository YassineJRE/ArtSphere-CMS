<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DatatableRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'draw' => 'required|numeric',
            'start' => 'required|numeric|min:0',
            'length' => 'required|numeric',
            'order' => 'required|array',
            'order.0.dir' => 'in:asc,desc',
            'columns' => 'required|array',
            'search' => 'required|array',
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
