<?php

namespace App\Http\Controllers\Web\Profile;

use Exception;
use App\Exceptions\ServiceException;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Requests\Web\Profile\CollectionItemComment\StoreRequest;
use App\Http\Controllers\Web\BaseController;
use App\Models\Collection;
use App\Models\CollectionItem;
use App\Models\UserProfile;
use App\Services\Web\Profile\CollectionItemCommentService;

class CollectionItemCommentController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CollectionItemCommentService $service)
    {
        $this->service = $service;
        $this->middleware(\App\Http\Middleware\VerifyCsrfToken::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param App\Http\Requests\Web\CollectionItemComment\StoreRequest $request
     * @param App\Models\UserProfile $profile
     * @param App\Models\CollectionItem $item
     *
     * @return Response
     */
    public function store(StoreRequest $request, UserProfile $profile, Collection $collection, CollectionItem $item)
    {
        try {
            $data = $request->validated();
            $data['writer_id'] = app('profile.session')->getProfileId();
            $data['writer_type'] = app('profile.session')->getProfileType();
            $data['commentable_id'] = $item->id;
            $data['commentable_type'] = CollectionItem::class;
            $comment = $this->service->store($data);

            return response()->json([
                'status' => 'success',
                'view' => view('profile.collection.item.comment', [
                    'item' => $item,
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
