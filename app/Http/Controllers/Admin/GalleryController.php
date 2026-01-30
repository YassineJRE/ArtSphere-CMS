<?php

namespace App\Http\Controllers\Admin;

use App\Enums\InstitutionType as EnumInstitutionType;
use App\Enums\Status as EnumStatus;
use App\Enums\PrivilegeAdmin;
use App\Exceptions\ServiceException;
use App\Http\Controllers\Web\BaseController;
use App\Models\Group;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\DatatableRequest;
use App\Services\Admin\GalleryService;
use Carbon\Carbon;

class GalleryController extends BaseController
{
    public function __construct(GalleryService $service)
    {
        $this->service = $service;
        $this->middleware('permission:'.implode('|', [
            PrivilegeAdmin::WEB_GALLERY_READ,
            PrivilegeAdmin::WEB_GALLERY_DELETE,
            PrivilegeAdmin::WEB_GALLERY_TOGGLE_ENABLE,
            PrivilegeAdmin::WEB_GALLERY_APPROVE,
        ]), ['only' => ['index', 'datatable', 'show']]);
        $this->middleware('permission:'.PrivilegeAdmin::WEB_GALLERY_DELETE, [
            'only' => ['destroy', 'restore'],
        ]);
        $this->middleware('permission:'.PrivilegeAdmin::WEB_GALLERY_TOGGLE_ENABLE, [
            'only' => ['toggleEnable'],
        ]);
        $this->middleware('permission:'.PrivilegeAdmin::WEB_GALLERY_APPROVE, [
            'only' => ['approve'],
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index()
    {
        return view('admin.gallery.index');
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
            if ($request->get('status') == 'awaiting-approval') {
                $request->request->remove('status');
                $request->merge(['approved_at' => NULL]);
            }
            return json_encode($this->service->datatable($request));
        }
    }

    /**
     * Show the specified resource.
     *
     * @param Illuminate\Http\Request $request
     * @param App\Models\Group $gallery
     *
     * @return Renderable
     */
    public function show(Request $request, Group $gallery)
    {
        return view('admin.gallery.show', ['gallery' => $gallery]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Illuminate\Http\Request $request
     * @param App\Models\Group $gallery
     *
     * @return void
     */
    public function destroy(Request $request, Group $gallery)
    {
        try {
            $this->service->destroy($gallery);

            return back()->withSuccess(__('admin-gallery.message.success.gallery-deleted'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param Illuminate\Http\Request $request
     * @param App\Models\Group $gallery
     *
     * @return void
     */
    public function restore(Request $request, Group $gallery)
    {
        try {
            $this->service->restore($gallery);

            return back()->withSuccess(__('admin-gallery.message.success.gallery-restored'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Toggle status enable the specified resource from storage.
     *
     * @param Illuminate\Http\Request $request
     * @param App\Models\Group $gallery
     *
     * @return void
     */
    public function toggleEnable(Request $request, Group $gallery)
    {
        try {
            $gallery = $this->service->toggleEnable($gallery);

            return back()->withSuccess(
                $gallery->isEnabled() ?
                __('gallery.message.success.gallery-enabled') :
                __('gallery.message.success.gallery-disabled')
            );
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Approve the specified resource from storage.
     *
     * @param Illuminate\Http\Request $request
     * @param App\Models\Group $gallery
     *
     * @return void
     */
    public function approve(Request $request, Group $gallery)
    {
        try {            
            if ($gallery->isAwaitingApproval()) {
                $gallery->fill([
                    'status' => $gallery->status == EnumStatus::AWAITING_APPROVAL ? EnumStatus::DISABLED : $gallery->status,
                    'approved_at' => Carbon::now(),
                ])->save();
            }

            return back()->withSuccess(
                $gallery->isApproved() ?
                __('gallery.message.success.gallery-approved') :
                __('gallery.message.success.gallery-awaiting-approval')
            );
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
