@isset($artwork)
    <div class="padding-top-15 padding-bottom-15 margin-bottom-15" style="background-color:#fafafa;">
        <div class="row margin-left-25 margin-right-25">
            <div id="response-msg"></div>
            <form
                id="commentArtworkForm"
                method="POST"
                class="woocommerce"
                @if ($artwork->exhibit->belongsToProfile())
                    action="{{ route('app.profiles.exhibits.artworks.comments.store',[
                        'profile' => $artwork->exhibit->owner_id,
                        'exhibit' => $artwork->exhibit, 
                        'artwork' => $artwork
                    ]) }}"
                @elseif ($artwork->exhibit->belongsToGroup())
                    action="{{ route('app.groups.exhibits.artworks.comments.store',[
                        'group' => $artwork->exhibit->owner_id,
                        'exhibit' => $artwork->exhibit, 
                        'artwork' => $artwork
                    ]) }}"
                @endif
            >
                <div class="row">
                    <div class="col-md-12">
                        <textarea
                            name="text"
                            cols="40" rows="5"
                            placeholder="{{ __('profile.views.send-comment.text.placeholder') }}"
                            required
                        ></textarea>
                    </div>
                    <div class="col-md-12">
                        <button 
                            id="btnSubmit"
                            type="submit" 
                            class="button"
                        >{{ __('components.views.contact.form.p.send') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script type="text/javascript">
            $(function() {
                $("#commentArtworkForm input,#commentArtworkForm textarea").jqBootstrapValidation({
                    preventSubmit: true,
                    submitError: function($form, event, errors) {
                        // something to have when submit produces an error ?
                        // Not decided if I need it yet
                    },
                    submitSuccess: function($form, event) {
                        event.preventDefault();
                        $("#btnSubmit").attr("disabled", true);
                        var text   = jQuery('textarea[name="text"]').val();
        
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: $('#commentArtworkForm').attr('action'),
                            type: "POST",
                            data: {
                                text: text
                            },
                            cache: false,
                            success: function(data) {
                                if (data.status == 'success') {
                                    $('#comments').prepend(data.view);
                                } else {
                                    var text = '{{ App::getLocale() }}' == 'fr' ? 
                                    'Désolé, il semble que notre serveur de messagerie ne réponde pas...' : 
                                    'Sorry it seems that our mail server is not responding...';
                                    $('#response-msg').html(
                                        '<div class="row">'+
                                            '<div class="col-md-12">'+
                                                '<div class="notification error closeable margin-bottom-30">'+
                                                    '<a class="close" href="#"></a>'+
                                                    '<p>'+text+'</p>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'
                                    );
                                }
                                $('#commentArtworkForm').trigger("reset");
                                $("#btnSubmit").attr("disabled", false);
                            },
                            error: function() {
                                var text = '{{ App::getLocale() }}' == 'fr' ? 
                                    'Désolé, il semble que notre serveur de messagerie ne réponde pas...' : 
                                    'Sorry it seems that our mail server is not responding...';
                                $('#response-msg').html(
                                    '<div class="row">'+
                                        '<div class="col-md-12">'+
                                            '<div class="notification error closeable margin-bottom-30">'+
                                                '<a class="close" href="#"></a>'+
                                                '<p>'+text+'</p>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'
                                );
                                $('#commentArtworkForm').trigger("reset");
                                $("#btnSubmit").attr("disabled", false);
                            },
                        })
                    },
                    filter: function() {
                        return $(this).is(":visible");
                    },
                });
        
                $("a[data-toggle=\"tab\"]").click(function(e) {
                    e.preventDefault();
                    $(this).tab("show");
                });
        
                $("#commentArtworkForm input,#commentArtworkForm textarea").focus(function() {
                    $('#response-msg').html('');
                });
            });
        </script>
    @endpush
@endisset