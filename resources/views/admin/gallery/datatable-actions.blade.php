@can(PrivilegeAdmin::WEB_GALLERY_READ)
<a href="{{ route('admin.galleries.show',['gallery' => $id]) }}" class="button view">
    <i class="sl sl-icon-eye"></i>
    {{ __('admin-gallery.views.datatable-actions.button.view') }}
</a>
@endcan

@if ($isAwaitingApproval)
    @can(PrivilegeAdmin::WEB_GALLERY_APPROVE)
        <a href="{{ route('admin.galleries.approve',['gallery' => $id]) }}" class="button view">
            <i class="sl sl-icon-check"></i>
            {{ __('admin-gallery.views.datatable-actions.button.approve') }}
        </a>
    @endcan
@endif

@if ($isEnabled)
    @can(PrivilegeAdmin::WEB_GALLERY_TOGGLE_ENABLE)
        <a href="{{ route('admin.galleries.toggle-enable',['gallery' => $id]) }}" class="button view">
            <i class="sl sl-icon-close"></i>
            {{ __('admin-gallery.views.datatable-actions.button.unpublish') }}
        </a>
    @endcan
@endif

@if ($isDisabled)
    @can(PrivilegeAdmin::WEB_GALLERY_TOGGLE_ENABLE)
        <a href="{{ route('admin.galleries.toggle-enable',['gallery' => $id]) }}" class="button view">
            <i class="sl sl-icon-check"></i>
            {{ __('admin-gallery.views.datatable-actions.button.publish') }}
        </a>
    @endcan
@endif

@if ($isDeleted)
    @can(PrivilegeAdmin::WEB_GALLERY_DELETE)
        <a href="{{ route('admin.galleries.restore',['gallery' => $id]) }}" class="button view">
            <i class="sl sl-icon-arrow-right-circle"></i>
            {{ __('admin-gallery.views.datatable-actions.button.restore') }}
        </a>
    @endcan
@else
    @can(PrivilegeAdmin::WEB_GALLERY_DELETE)
        <a href="#delete-row-dialog-{{ $id }}" class="button cancel popup-delete-row">
            <i class="sl sl-icon-close"></i>
            {{  __('admin-gallery.views.datatable-actions.button.delete') }}
        </a>
        <div id="delete-row-dialog-{{ $id }}" class="listeo-dialog ical-import-dialog zoom-anim-dialog  mfp-hide">
            <div class="small-dialog-header">
                <h3>{{  __('admin-gallery.views.datatable-actions.h3.delete-gallery') }}</h3>
            </div>
            <div class="sign-in-form style-1">
                <p>{{  __('admin-gallery.views.datatable-actions.paragraph.sure') }}</p>
                <form method="post"
                    action="{{ route('admin.galleries.destroy',['gallery' => $id]) }}">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button class="button">
                        <i class="fa fa-circle-o-notch fa-spin"></i>
                        {{  __('admin-gallery.views.datatable-actions.button.delete') }}
                    </button>
                </form>
            </div>
        </div>
    @endcan
@endif
