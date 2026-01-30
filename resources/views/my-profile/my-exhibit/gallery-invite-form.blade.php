
<dialog id="invite_gallery" class="woocommerce col-md-12 margin-top-10" style="position: fixed; background: #fff; padding: 20px;
border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); z-index: 1100;"
>
    <h2>Invite Gallery</h2>
    <form id="invGallery" class="register" action="" method="post">
        @csrf
        
        <div class="form-row col-md-3">
            <label for="gallery_name">Gallery Name<span class="required">*</span></label>
            <input
                type="text"
                class="input-text form-control @if ($errors->has('gallery_name')) invalid @endif"
                name="gallery_name"
                id="gallery_name"
                required
            >
            @if ($errors->has('gallery_name'))
                <span class="text-danger">{{ $errors->first('gallery_name') }}</span>
            @endif
        </div>
        
        <div class="form-row col-md-3">
            <label for="first_name">Representative {{ __('my-group-member.views.create.form.p.label.first-name') }} <span class="required">*</span></label>
            <input
                type="text"
                class="input-text form-control @if ($errors->has('first_name')) invalid @endif"
                name="first_name"
                id="first_name"
                required
            >
            @if ($errors->has('first_name'))
                <span class="text-danger">{{ $errors->first('first_name') }}</span>
            @endif
        </div>
        <div class="form-row col-md-3">
            <label for="last_name">Representative {{ __('my-group-member.views.create.form.p.label.last-name') }} <span class="required">*</span></label>
            <input
                type="text"
                class="input-text form-control @if ($errors->has('last_name')) invalid @endif"
                name="last_name"
                id="last_name"
                required
            >
            @if ($errors->has('last_name'))
                <span class="text-danger">{{ $errors->first('last_name') }}</span>
            @endif
        </div>
        <div class="form-row col-md-3">
            <label for="email">Representative {{ __('my-group-member.views.create.form.p.label.email') }} <span class="required">*</span></label>
            <input
                type="email"
                class="input-text form-control @if ($errors->has('email')) invalid @endif"
                name="email"
                id="email"
                required
            >
            @if ($errors->has('email'))
                <span class="text-danger" id="error-email">{{ $errors->first('email') }}</span>
            @endif
        </div>
        <div class="form-row col-md-12">
            <input type="submit" class="button" name="send" value="Invite" id ="submit_button">
            <span class="text-danger" id="error_message"></span>
        </div>
                
    </form>
	<div class="form-row col-md-12">
            <button class="button woocommerce-button" name="cancel" value="Cancel" id="cancel_button" onclick="closeInviteGallery()">Cancel</button>
    </div>
</dialog>

@push('scripts')
<script>
    function invGallery() {

        let form = $('#invGallery');

        $.post("{{route('invite-gallery.create', ['inviter'=>$myProfile->user_id])}}", form.serialize())
            .done(function(response) {				
                console.log()
                @isset($gallery_select_output)
                    let selected = new Option(response["gallery-name"], response["gallery-id"], true, true);
                    $('{{ $gallery_select_output }}').append(selected).trigger('change');
                @endisset

                @isset($gallery_id_output)
                    $('{{ $gallery_id_output }}').val(response["gallery-id"]);
                @endisset
                
                closeInviteGallery();
            })
            .fail(function(error) {
                console.log(error)
                response = error.responseJSON;
                //if(response?.email) $("#error-email").text(response.email);
                if(response?.message) $("#error_message").text(response.message);
                console.error(response.message);
            });
    }

    // Intercept the form submission
    $('#invGallery').on("submit",function (event) {
			event.preventDefault(); // Prevent the form from submitting normally        
            // AJAX Submit the form
            invGallery();        
    });
</script>
@endpush