@inject('sidebarService', 'App\Services\Admin\SidebarService')
<a href="#" class="dashboard-responsive-nav-trigger">
    <i class="fa fa-reorder"></i>
    {{ __('admin-components.views.sidebar.link.title') }}
</a>
<div class="dashboard-nav">
    <div class="dashboard-nav-inner">
        <ul data-submenu-title="{{ __('admin-components.views.sidebar.ul.submenu.main.title') }}">
            <li class="@if (Route::current()->getName() == 'admin.dashboard') active @endif">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="sl sl-icon-settings"></i>
                    {{ __('admin-components.views.sidebar.ul.submenu.main.li.link.dashboard') }}
                </a>
            </li>
        </ul>
        <ul data-submenu-title="{{ __('admin-components.views.sidebar.ul.submenu.listings.title') }}">
            <li class="@if (Str::contains(Route::current()->getName(),['admin.members'])) active @endif">
                <a>
                    <i class="sl sl-icon-people"></i>
                    {{ __('admin-components.views.sidebar.ul.submenu.listings.li.link.members.title') }}
                </a>
                <ul>
                    <li class="@if(Request::query('status') == 'enabled') active @endif">
                        <a href="{{ route('admin.members.index', ['status' => 'enabled']) }}">
                            {{ __('admin-components.views.sidebar.ul.submenu.listings.li.link.members.active') }}
                            <span class="nav-tag green">{{ $sidebarService::getNumberMembersEnabled() }}</span>
                        </a>
                    </li>
                    <li class="@if(Request::query('status') == 'pending') active @endif">
                        <a href="{{ route('admin.members.index', ['status' => 'pending']) }}">
                            {{ __('admin-components.views.sidebar.ul.submenu.listings.li.link.members.pending') }}
                            <span class="nav-tag yellow">{{ $sidebarService::getNumberMembersPending() }}</span>
                        </a>
                    </li>
                    <li class="@if(Request::query('status') == 'banned') active @endif">
                        <a href="{{ route('admin.members.index', ['status' => 'banned']) }}">
                            {{ __('admin-components.views.sidebar.ul.submenu.listings.li.link.members.banned') }}
                            <span class="nav-tag red">{{ $sidebarService::getNumberMembersBanned() }}</span>
                        </a>
                    </li>
                    <li class="@if(Request::query('status') == 'deleted') active @endif">
                        <a href="{{ route('admin.members.index', ['status' => 'deleted']) }}">
                            {{ __('admin-components.views.sidebar.ul.submenu.listings.li.link.members.deleted') }}
                            <span class="nav-tag red">{{ $sidebarService::getNumberMembersDeleted() }}</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="@if (Str::contains(Route::current()->getName(),['admin.galleries'])) active @endif">
                <a>
                    <i class="sl sl-icon-picture"></i>
                    {{ __('admin-components.views.sidebar.ul.submenu.listings.li.link.galleries.title') }}
                </a>
                <ul>
                    <li class="@if(Request::query('status') == 'awaiting-approval') active @endif">
                        <a href="{{ route('admin.galleries.index', ['status' => 'awaiting-approval']) }}">
                            {{ __('admin-components.views.sidebar.ul.submenu.listings.li.link.galleries.awaiting-approval') }}
                            <span class="nav-tag yellow">{{ $sidebarService::getNumberGalleriesAwaitingApproval() }}</span>
                        </a>
                    </li>                    
                    <li class="@if(Request::query('status') != 'awaiting-approval') active @endif">
                        <a href="{{ route('admin.galleries.index') }}">
                            {{ __('admin-components.views.sidebar.ul.submenu.listings.li.link.galleries.all') }}
                            <span class="nav-tag green">{{ $sidebarService::getNumberGalleries() }}</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <ul data-submenu-title="Settings">
            <li class="@if (Str::contains(Route::current()->getName(),['admin.contents'])) active @endif">
                <a href="{{ route('admin.contents.index') }}">
                    <i class="sl sl-icon-folder"></i>
                    {{ __('admin-components.views.sidebar.ul.submenu.system.li.contents') }}
                </a>
            </li>
        </ul>
        <ul data-submenu-title="{{ __('admin-components.views.sidebar.ul.submenu.system.title') }}">
            {{-- <li class="@if (Str::contains(Route::current()->getName(),['admin.user-notifications'])) active @endif">
                <a href="{{ route('admin.user-notifications.index') }}">
                    <i class="sl sl-icon-envelope-open"></i>
                    {{ __('admin-components.views.sidebar.ul.submenu.system.li.link.user-notifications') }}
                    <span class="nav-tag messages">{{ $sidebarService::getNumberUnreadNotifications() }}</span>
                </a>
            </li> --}}
            <li class="@if (Str::contains(Route::current()->getName(),['logs'])) active @endif">
                <a>
                    <i class="sl sl-icon-book-open"></i>
                    {{ __('admin-components.views.sidebar.ul.submenu.system.li.link.logs.title') }}
                </a>
                <ul>
                    <li class="@if (Str::contains(Route::current()->getName(),['admin.user-logs'])) active @endif">
                        <a href="{{ route('admin.user-logs.index') }}">
                            <i class="sl sl-icon-book-open"></i>
                            {{ __('admin-components.views.sidebar.ul.submenu.system.li.link.logs.user-logs') }}
                        </a>
                    </li>
                    <li class="@if (Str::contains(Route::current()->getName(),['admin.admin-logs'])) active @endif">
                        <a href="{{ route('admin.admin-logs.index') }}">
                            <i class="sl sl-icon-book-open"></i>
                            {{ __('admin-components.views.sidebar.ul.submenu.system.li.link.logs.admin-logs') }}
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <ul data-submenu-title="{{ __('admin-components.views.sidebar.ul.submenu.user-management.title') }}">
            <li class="@if (Str::contains(Route::current()->getName(),['admin.users'])) active @endif">
                <a href="{{ route('admin.users.index') }}">
                    <i class="sl sl-icon-people"></i>
                    {{ __('admin-components.views.sidebar.ul.submenu.user-management.li.link.users') }}
                </a>
            </li>
            <li class="@if (Str::contains(Route::current()->getName(),['admin.roles'])) active @endif">
                <a href="{{ route('admin.roles.index') }}">
                    <i class="sl sl-icon-people"></i>
                    {{ __('admin-components.views.sidebar.ul.submenu.user-management.li.link.roles') }}
                </a>
            </li>
        </ul>
        <ul data-submenu-title="{{ __('admin-components.views.sidebar.ul.submenu.account.title') }}">
            <li class="@if (Route::current()->getName() == 'admin.my-profile') active @endif">
                <a href="{{ route('admin.my-profile') }}">
                    <i class="sl sl-icon-user"></i>
                    {{ __('admin-components.views.sidebar.ul.submenu.account.li.link.my-profile') }}
                </a>
            </li>
            <li>
                <a href="{{ route('admin.logout') }}">
                    <i class="sl sl-icon-power"></i>
                    {{ __('admin-components.views.sidebar.ul.submenu.account.li.link.logout') }}
                </a>
            </li>
        </ul>
    </div>
</div>
