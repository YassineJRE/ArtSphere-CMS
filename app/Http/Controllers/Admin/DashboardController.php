<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PrivilegeAdmin;
use App\Http\Controllers\Web\BaseController;
use Illuminate\Contracts\Support\Renderable;
use App\Services\Admin\DashboardService;

class DashboardController extends BaseController
{
    public function __construct(DashboardService $service)
    {
        $this->service = $service;
        $this->middleware(
            'permission:'.implode('|', [
            PrivilegeAdmin::WEB_DASHBOARD_READ,
        ]),
            ['only' => ['index'],
        ]
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index()
    {
        return view('admin.dashboard.index', [
            'number_members' => DashboardService::getNumberMembers(),
            'number_artist_profiles' => DashboardService::getNumberArtistProfiles(),
            'number_curator_profiles' => DashboardService::getNumberCuratorProfiles(),
            'number_public_collector_profiles' => DashboardService::getNumberPublicCollectorProfiles(),
        ]);
    }
}
