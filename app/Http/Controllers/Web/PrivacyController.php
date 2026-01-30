<?php

namespace App\Http\Controllers\Web;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Enums\ContentKey as EnumContentKey;
use App\Enums\Status as EnumStatus;
use App\Models\Content;
use Illuminate\Support\Facades\App;

class PrivacyController extends BaseController
{
    /**
     * Display Home page.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Renderable
     */
    public function index(Request $request)
    {
        $page = Content::where([
            'key' => EnumContentKey::PRIVACY_POLICY,
            'status' => EnumStatus::ENABLED
        ])->first();

        return view('privacy.index',[
            'content' => $page->content->{App::getLocale()} ?? ''
        ]);
    }
}
