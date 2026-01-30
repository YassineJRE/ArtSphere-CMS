<?php

namespace App\Http\Controllers\Web\Group;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Web\BaseController;
use App\Models\Group;
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
     * @param App\Models\Group $group
     * @param App\Models\Document $document
     *
     * @return Renderable
     */
    public function show(Request $request, Group $group, Document $document)
    {
        return view('group.document.show', [
            'group' => $group,
            'document' => $document,
        ]);
    }
}
