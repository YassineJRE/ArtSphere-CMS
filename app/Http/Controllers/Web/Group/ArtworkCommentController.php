<?php

namespace App\Http\Controllers\Web\Group;

use Exception;
use App\Exceptions\ServiceException;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Requests\Web\Group\ArtworkComment\StoreRequest;
use App\Http\Controllers\Web\BaseController;
use App\Models\Artwork;
use App\Models\Exhibit;
use App\Models\Group;
use App\Services\Web\Group\ArtworkCommentService;

class ArtworkCommentController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ArtworkCommentService $service)
    {
        $this->service = $service;
        $this->middleware(\App\Http\Middleware\VerifyCsrfToken::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param App\Http\Requests\Web\ArtworkComment\StoreRequest $request
     * @param App\Models\Group $group
     * @param App\Models\Exhibit $exhibit
     * @param App\Models\Artwork $artwork
     *
     * @return Response
     */
    public function store(StoreRequest $request, Group $group, Exhibit $exhibit, Artwork $artwork)
    {
        try {
            $data = $request->validated();
            $data['writer_id'] = app('profile.session')->getProfileId();
            $data['writer_type'] = app('profile.session')->getProfileType();
            $data['commentable_id'] = $artwork->id;
            $data['commentable_type'] = Artwork::class;
            $comment = $this->service->store($data);

            return response()->json([
                'status' => 'success',
                'view' => view('profile.exhibit.artwork.comment', [
                    'artwork' => $artwork,
                    'comment' => $comment,
                ])->render(),
            ]);
        } catch (ServiceException $e) {
            return response()->json([
                'status' => 'error', 
                'message' => __('contact-us.message.success.contact-us-error')
            ]);
        }
    }
}
