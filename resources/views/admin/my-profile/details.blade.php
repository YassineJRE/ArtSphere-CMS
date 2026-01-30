<div class="col-lg-6 col-md-12">
    <div class="dashboard-list-box margin-top-0">
        <h4 class="gray">{{ __('admin-my-profile.views.details.h4.profile-details') }}</h4>
        <form method="post"
            class="login"
            action="{{ route('admin.my-profile.update-details') }}"
            enctype="multipart/form-data">
            <input type="hidden"
                name="_method"
                value="PUT">
            <input type="hidden"
                name="_token"
                value="{{ csrf_token() }}">

            <div class="dashboard-list-box-static">
                <!-- Avatar -->
                <div class="edit-profile-photo">
                    <img src="{{ auth()->user()->getFirstMediaUrl('avatar') }}" alt="">
                    <div class="change-photo-btn">
                        <div class="photoUpload">
                            <span>
                                <i class="fa fa-upload"></i> {{ __('admin-my-profile.views.details.span.upload-photo') }}
                            </span>
                            <input type="file" class="upload" name="avatar" />
                        </div>
                    </div>
                </div>

                <!-- Details -->
                <div class="my-profile">
                    <label>{{ __('admin-my-profile.views.details.label.first-name') }}</label>
                    <input value="{{ auth()->user()->first_name }}"
                        class="input-text @if ($errors->has('first_name')) invalid @endif"
                        name="first_name"
                        type="text"  required>
                    @if ($errors->has('first_name'))
                        <span class="text-danger">{{ $errors->first('first_name') }}</span>
                    @endif

                    <label>{{ __('admin-my-profile.views.details.label.last-name') }}</label>
                    <input value="{{ auth()->user()->last_name }}"
                        class="input-text @if ($errors->has('last_name')) invalid @endif"
                        name="last_name"
                        type="text" required>
                    @if ($errors->has('last_name'))
                        <span class="text-danger">{{ $errors->first('last_name') }}</span>
                    @endif

                    <label>{{ __('admin-my-profile.views.details.label.phone') }}</label>
                    <input value="(123) 123-456"
                        type="text" required>

                    <label>{{ __('admin-my-profile.views.details.label.email') }}</label>
                    <input value="{{ auth()->user()->email }}"
                        class="input-text @if ($errors->has('email')) invalid @endif"
                        name="email"
                        type="text" required>
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <button class="button margin-top-15">
                    {{ __('admin-my-profile.views.details.button.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
