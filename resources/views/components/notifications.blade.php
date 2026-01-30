{{-- <div class="row">
    <div class="col-md-12">

        @if ($errors->any())
            <div class="notification error closeable margin-bottom-30">
                <a class="close" href="#"></a>
                <p>{!! __('admin-components.views.notifications.p.error-message') !!}</p>
            </div>
            <div class="notification error closeable margin-bottom-30">
                <a class="close" href="#"></a>
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        @if ($message = Session::get('success'))
            <div class="notification success closeable margin-bottom-30">
                <a class="close" href="#"></a>
                <p><strong>{{ __('admin-components.views.notifications.p.success') }}</strong> {{ $message }}</p>
            </div>
        @endif

        @if ($message = Session::get('error'))
            <div class="notification error closeable margin-bottom-30">
                <a class="close" href="#"></a>
                <p><strong>{{ __('admin-components.views.notifications.p.error') }}</strong> {{ $message }}</p>
            </div>
        @endif

        @if ($message = Session::get('warning'))
            <div class="notification warning closeable margin-bottom-30">
                <a class="close" href="#"></a>
                <p><strong>{{ __('admin-components.views.notifications.p.warning') }}</strong> {{ $message }}</p>
            </div>
        @endif

        @if ($message = Session::get('info'))
            <div class="notification notice closeable margin-bottom-30">
                <a class="close" href="#"></a>
                <p><strong>{{ __('admin-components.views.notifications.p.info') }}</strong> {{ $message }}</p>
            </div>
        @endif

        @if ($message = Session::get('msg'))
            <div class="notification error closeable margin-bottom-30">
                <a class="close" href="#"></a>
                <p><strong>{{ __('admin-components.views.notifications.p.error') }}</strong> {{ $message }}</p>
            </div>
        @endif
    </div>
</div> --}}
