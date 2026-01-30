<?php

namespace App\Http\Controllers\Web\Profile;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Web\BaseController;
use App\Models\UserProfile;
use App\Models\Document;

class DocumentController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the specified resource.
     *
     * @param Illuminate\Http\Request $request
     * @param App\Models\UserProfile $profile
     * @param App\Models\Document $document
     *
     * @return Renderable
     */
    public function show(Request $request, UserProfile $profile, Document $document)
    {
        return view('profile.document.show', [
            'profile' => $profile,
            'document' => $document,
        ]);
    }
}
