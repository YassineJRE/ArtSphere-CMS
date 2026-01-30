@if ($user->trashed())
    <a href="{{ route('admin.users.restore',['user' => $user]) }}" class="button edit">
        <i class="sl sl-icon-refresh"></i>
        {{  __('admin-user.views.datatable-actions.button.restore') }}
    </a>
@else
    @can(PrivilegeAdmin::WEB_USER_UPDATE)
        <a href="{{ route('admin.users.edit',['user' => $user]) }}" class="button edit">
            <i class="sl sl-icon-note"></i>
            {{  __('admin-user.views.datatable-actions.button.edit') }}
        </a>
    @endcan

    @can(PrivilegeAdmin::WEB_USER_DELETE)
        <a href="#delete-row-dialog-{{ $user->id }}" class="button cancel popup-delete-row">
            <i class="sl sl-icon-close"></i>
            {{  __('admin-user.views.datatable-actions.button.delete') }}
        </a>
        <div id="delete-row-dialog-{{ $user->id }}" class="listeo-dialog ical-import-dialog zoom-anim-dialog  mfp-hide">
            <div class="small-dialog-header">
                <h3>{{  __('admin-user.views.datatable-actions.h3.delete-user') }}</h3>
            </div>
            <div class="sign-in-form style-1">
                <p>{{  __('admin-user.views.datatable-actions.paragraph.sure') }}</p>
                <form method="post"
                    action="{{ route('admin.users.destroy',['user' => $user]) }}">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button class="button">
                        <i class="fa fa-circle-o-notch fa-spin"></i>
                        {{  __('admin-user.views.datatable-actions.button.delete') }}
                    </button>
                </form>
            </div>
        </div>
    @endcan
@endif

@can(PrivilegeAdmin::WEB_USER_CREATE)
    @if ($user->needsActiveAdminAccount())
    <a href="{{ route('admin.users.notify-to-activate-account',['user' => $user]) }}" class="button view">
        <i class="sl sl-icon-envolope"></i>
        {{  __('admin-user.views.datatable-actions.button.link') }}
    </a>
    @endif
@endcan
