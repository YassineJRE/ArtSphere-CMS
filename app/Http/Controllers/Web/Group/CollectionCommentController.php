<?php

namespace App\Http\Controllers\Web\Group;

use Exception;
use App\Exceptions\ServiceException;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Requests\Web\Group\CollectionComment\StoreRequest;
use App\Http\Controllers\Web\BaseController;
use App\Models\Collection;
use App\Models\Group;
use App\Services\Web\Group\CollectionCommentService;

class CollectionCommentController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CollectionCommentService $service)
    {
        $this->service = $service;
        $this->middleware(\App\Http\Middleware\VerifyCsrfToken::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param App\Http\Requests\Web\CollectionComment\StoreRequest $request
     * @param App\Models\Group $group
     * @param App\Models\Collection $collection
     *
     * @return Response
     */
    public function store(StoreRequest $request, Group $group, Collection $collection)
    {
        try {
            $data = $request->validated();
            $data['writer_id'] = app('profile.session')->getProfileId();
            $data['writer_type'] = app('profile.session')->getProfileType();
            $data['commentable_id'] = $collection->id;
            $data['commentable_type'] = Collection::class;
            $comment = $this->service->store($data);

            return response()->json([
                'status' => 'success',
                'view' => view('profile.collection.comment', [
                    'collection' => $collection,
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
