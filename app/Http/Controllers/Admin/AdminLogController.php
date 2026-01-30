<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PrivilegeAdmin;
use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Web\IndexRequest;
use Illuminate\Contracts\Support\Renderable;
use App\Services\Admin\AdminLogService;

class AdminLogController extends BaseController
{
    public function __construct(AdminLogService $service)
    {
        $this->service = $service;
        $this->middleware('permission:'.implode('|', [
            PrivilegeAdmin::WEB_ADMIN_LOG_READ,
        ]), ['only' => ['index', 'show'],
    ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param App\Http\Requests\Web\IndexRequest $request
     *
     * @return Renderable
     */
    public function index(IndexRequest $request)
    {
        return view('admin.admin-log.index', [
            'activities' => $this->service->index($request),
        ]);
    }

    /**
     * Show the specified resource.
     *
     * @param int $id
     *
     * @return Renderable
     */
    public function show($id)
    {
        return view('admin.admin-log.show');
    }
}
