<div class="col-lg-6 col-md-12">
    <div class="dashboard-list-box margin-top-0">
        <h4 class="gray">{{ __('admin-my-profile.views.change-password.h4.change-password') }}</h4>
        <div class="dashboard-list-box-static">
            <form method="post"
                class="login"
                action="{{ route('admin.my-profile.change-password') }}">
                <input type="hidden"
                    name="_method"
                    value="PUT">
                <input type="hidden"
                    name="_token"
                    value="{{ csrf_token() }}">

                <div class="my-profile">
                    <label class="margin-top-0">{{ __('admin-my-profile.views.change-password.label.current-password') }}</label>
                    <input type="password"
                        class="input-text @if ($errors->has('current_password')) invalid @endif"
                        name="current_password" required/>
                    @if ($errors->has('current_password'))
                        <span class="text-danger">{{ $errors->first('current_password') }}</span>
                    @endif

                    <label>{{ __('admin-my-profile.views.change-password.label.new-password') }}</label>
                    <input type="password"
                        class="input-text @if ($errors->has('password')) invalid @endif"
                        name="password" required/>
                    @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif

                    <label>{{ __('admin-my-profile.views.change-password.label.confirm-new-password') }}</label>
                    <input type="password"
                    class="input-text @if ($errors->has('password_confirmation')) invalid @endif"
                    name="password_confirmation" required/>
                    @if ($errors->has('password_confirmation'))
                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                    @endif

                    <button class="button margin-top-15">{{ __('admin-my-profile.views.change-password.button.change-password') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
