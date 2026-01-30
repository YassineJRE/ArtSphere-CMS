<?php

namespace App\Http\Controllers\Web;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Enums\ContentKey as EnumContentKey;
use App\Enums\Status as EnumStatus;
use App\Models\Content;
use Illuminate\Support\Facades\App;

class HomeController extends BaseController
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
        $aboutUs = Content::where([
            'key' => EnumContentKey::ABOUT_US,
            'status' => EnumStatus::ENABLED
        ])->first();
        $thanks = Content::where([
            'key' => EnumContentKey::THANKS,
            'status' => EnumStatus::ENABLED
        ])->first();

        return view('home.index', [
            'aboutUs' => $aboutUs->content->{App::getLocale()} ?? '',
            'thanks' => $thanks->content->{App::getLocale()} ?? ''
        ]);
    }
}
