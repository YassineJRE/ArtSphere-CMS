<?php

namespace App\Http\Requests\Web\Profile\Artwork;

use Illuminate\Foundation\Http\FormRequest;

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
            app('profile.session')->isOwnerOfThisExhibit($this->exhibit->id) ?
                true : (
                    $this->exhibit->isToVerifiedGalleriesOnly() ?
                        app('profile.session')->isVerifiedGallery() : (
                            $this->exhibit->isDisabled() && $this->exhibit->isToken($this->token) ?
                                true : !$this->exhibit->isDisabled()
                        )
                );
    }
}
