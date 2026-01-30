<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ContentType as EnumContentType;
use App\Enums\PrivilegeAdmin;
use App\Enums\Status as EnumStatus;
use App\Exceptions\ServiceException;
use App\Http\Controllers\Web\BaseController;
use App\Models\Content;
use Illuminate\Contracts\Support\Renderable;
use App\Http\Requests\Admin\DatatableRequest;
use App\Http\Requests\Admin\Content\StoreRequest;
use App\Http\Requests\Admin\Content\UpdateRequest;
use App\Services\Admin\ContentService;

class ContentController extends BaseController
{
    public function __construct(ContentService $service)
    {
        $this->service = $service;
        $this->middleware('permission:'.implode('|', [
            PrivilegeAdmin::WEB_CONTENT_CREATE,
            PrivilegeAdmin::WEB_CONTENT_READ,
            PrivilegeAdmin::WEB_CONTENT_UPDATE,
            PrivilegeAdmin::WEB_CONTENT_DELETE,
        ]), ['only' => ['index', 'datatable',  'show']]);
        $this->middleware('permission:'.PrivilegeAdmin::WEB_CONTENT_CREATE, [
            'only' => ['create', 'store'],
        ]);
        $this->middleware('permission:'.PrivilegeAdmin::WEB_CONTENT_UPDATE, [
            'only' => ['edit', 'update'],
        ]);
        $this->middleware('permission:'.PrivilegeAdmin::WEB_CONTENT_DELETE, [
            'only' => ['destroy'],
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index()
    {
        return view('admin.content.index');
    }

    /**
     * Get Datatable records.
     *
     * @param App\Http\Requests\Admin\DatatableRequest $request
     *
     * @return string JSON of Datatable
     */
    public function datatable(DatatableRequest $request): string
    {
        if ($request->ajax()) {
            return json_encode($this->service->datatable($request));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create()
    {
        return view('admin.content.create', [
            'contentTypes' => EnumContentType::list(),
            'statuses' => [
                EnumStatus::ENABLED,
                EnumStatus::DISABLED,
                EnumStatus::DELETED
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param App\Http\Requests\Admin\Content\StoreRequest $request
     *
     * @return void
     */
    public function store(StoreRequest $request)
    {
        try {
            $this->service->store($request->all());

            return redirect()->route('admin.contents.index')
                ->withSuccess(__('admin-content.message.success.content-created'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     *
     * @param int $contentId
     *
     * @return Renderable
     */
    public function show($contentId)
    {
        $content = Content::findOrFail($contentId);

        return view('admin.content.show', [
            'content' => $content,
            'contentTypes' => EnumContentType::list(),
            'statuses' => [
                EnumStatus::ENABLED,
                EnumStatus::DISABLED,
                EnumStatus::DELETED
            ]
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $contentId
     *
     * @return Renderable
     */
    public function edit($contentId)
    {
        $content = Content::findOrFail($contentId);

        return view('admin.content.edit', [
            'content' => $content,
            'contentTypes' => EnumContentType::list(),
            'statuses' => [
                EnumStatus::ENABLED,
                EnumStatus::DISABLED,
                EnumStatus::DELETED
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Requests\Admin\Content\UpdateRequest $request
     * @param int                                                            $contentId
     *
     * @return void
     */
    public function update(UpdateRequest $request, $contentId)
    {
        try {
            $content = Content::findOrFail($contentId);
            $this->service->update($content, $request->all());

            return redirect()->route('admin.contents.index')
                ->withSuccess(__('admin-content.message.success.content-updated'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $contentId
     *
     * @return void
     */
    public function destroy($contentId)
    {
        try {
            $content = Content::findOrFail($contentId);
            $this->service->destroy($content);

            return redirect()->route('admin.contents.index')
                ->withSuccess(__('admin-content.message.success.content-deleted'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param int $contentId Content ID
     *
     * @return void
     */
    public function restore(int $contentId)
    {
        try {
            $content = Content::withTrashed()->findOrFail($contentId);
            $this->service->restore($content);

            return redirect()->route('admin.contents.index')
                ->withSuccess(__('admin-content.message.success.content-restored'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
