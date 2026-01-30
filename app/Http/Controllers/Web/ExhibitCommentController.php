<?php

namespace App\Http\Controllers\Web;

use Exception;
use App\Exceptions\ServiceException;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Requests\Web\ExhibitComment\StoreRequest;
use App\Http\Controllers\Web\BaseController;
use App\Models\Exhibit;
use App\Services\Web\ExhibitCommentService;

class ExhibitCommentController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ExhibitCommentService $service)
    {
        $this->service = $service;
        $this->middleware(\App\Http\Middleware\VerifyCsrfToken::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param App\Http\Requests\Web\ExhibitComment\StoreRequest $request
     * @param App\Models\Exhibit $exhibit
     *
     * @return Response
     */
    public function store(StoreRequest $request, Exhibit $exhibit)
    {
        try {
            $data = $request->validated();
            $data['writer_id'] = app('profile.session')->getProfileId();
            $data['writer_type'] = app('profile.session')->getProfileType();
            $data['commentable_id'] = $exhibit->id;
            $data['commentable_type'] = Exhibit::class;
            $comment = $this->service->store($data);

            return response()->json([
                'status' => 'success',
                'view' => view('profile.exhibit.comment', [
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
