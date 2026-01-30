<?php

namespace App\Http\Requests\Web\MyGroup\MyCollectionItem;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ShowRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
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
            $this->my_group->collections->pluck('id')->contains($this->my_collection->id)
            &&
            $this->my_collection->items->pluck('id')->contains($this->item->id);
    }
}
