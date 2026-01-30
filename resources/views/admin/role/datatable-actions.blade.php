@can(PrivilegeAdmin::WEB_ROLE_UPDATE)
    <a href="{{ route('admin.roles.edit',['role' => $id]) }}" class="button edit">
        <i class="sl sl-icon-note"></i>
        {{  __('admin-role.views.datatable-actions.button.edit') }}
    </a>
@endcan

@can(PrivilegeAdmin::WEB_ROLE_DELETE)
    <a href="#delete-row-dialog-{{ $id }}" class="button cancel popup-delete-row">
        <i class="sl sl-icon-close"></i>
        {{  __('admin-role.views.datatable-actions.button.delete') }}
    </a>
    <div id="delete-row-dialog-{{ $id }}" class="listeo-dialog ical-import-dialog zoom-anim-dialog  mfp-hide">
        <div class="small-dialog-header">
            <h3>{{  __('admin-role.views.datatable-actions.h3.delete-role') }}</h3>
        </div>
        <div class="sign-in-form style-1">
            <p>{{  __('admin-role.views.datatable-actions.paragraph.sure') }}</p>
            <form method="post"
                action="{{ route('admin.roles.destroy',['role' => $id]) }}">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button class="button">
                    <i class="fa fa-circle-o-notch fa-spin"></i>
                    {{  __('admin-role.views.datatable-actions.button.delete') }}
                </button>
            </form>
        </div>
    </div>
@endcan
