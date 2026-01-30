@isset($action)
    <div class="padding-top-15" style="background-color:#eee;">
        <div class="row margin-left-25 margin-right-25">
            <div id="response-msg"></div>
            <form
                id="contactProfileForm"
                action="{{ $action }}"
                method="POST"
                class="woocommerce"
            >
                <div class="row">
                    <div class="col-md-12">
                        <input
                            type="text"
                            id="subject"
                            name="subject"
                            size="40"
                            placeholder="{{ __('components.views.contact.form.span.subject') }}"
                            required />
                    </div>
                    <div class="col-md-12">
                        <textarea
                            name="message"
                            cols="40" rows="10"
                            placeholder="{{ __('components.views.contact.form.span.message') }}"
                            required></textarea>
                    </div>
                    <div class="col-md-12 margin-bottom-10">
                        <button
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
                $("#contactProfileForm input,#contactProfileForm textarea").jqBootstrapValidation({
                    preventSubmit: true,
                    submitError: function($form, event, errors) {
                        // something to have when submit produces an error ?
                        // Not decided if I need it yet
                    },
                    submitSuccess: function($form, event) {
                        event.preventDefault();
                        var subject   = $("input#subject").val();
                        var message   = jQuery('textarea[name="message"]').val();

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: $('#contactProfileForm').attr('action'),
                            type: "POST",
                            data: {
                                subject: subject,
                                message: message
                            },
                            cache: false,
                            success: function(data) {
                                $('#response-msg').html(data.view);
                                $('#contactProfileForm').trigger("reset");
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
                                $('#contactProfileForm').trigger("reset");
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

                $("#contactProfileForm input,#contactProfileForm textarea").focus(function() {
                    $('#response-msg').html('');
                });
            });
        </script>
    @endpush
@endisset