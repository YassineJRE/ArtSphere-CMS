@can(PrivilegeAdmin::WEB_REVIEW_UPDATE)
    <a href="{{ route('admin.reviews.edit',['review' => $id]) }}" class="button edit">
        <i class="sl sl-icon-note"></i>
        {{  __('admin-review.views.datatable-actions.button.edit') }}
    </a>
@endcan

@can(PrivilegeAdmin::WEB_REVIEW_DELETE)
    <a href="#delete-row-dialog-{{ $id }}" class="button cancel popup-delete-row">
        <i class="sl sl-icon-close"></i>
        {{  __('admin-review.views.datatable-actions.button.delete') }}
    </a>
    <div id="delete-row-dialog-{{ $id }}" class="listeo-dialog ical-import-dialog zoom-anim-dialog  mfp-hide">
        <div class="small-dialog-header">
            <h3>{{  __('admin-review.views.datatable-actions.h3.delete-review') }}</h3>
        </div>
        <div class="sign-in-form style-1">
            <p>{{  __('admin-review.views.datatable-actions.paragraph.sure') }}</p>
            <form method="post"
                action="{{ route('admin.reviews.destroy',['review' => $id]) }}">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button class="button">
                    <i class="fa fa-circle-o-notch fa-spin"></i>
                    {{  __('admin-review.views.datatable-actions.button.delete') }}
                </button>
            </form>
        </div>
    </div>
@endcan
