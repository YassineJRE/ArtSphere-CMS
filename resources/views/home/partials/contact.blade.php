<section class="fullwidth margin-top-0 padding-top-75 padding-bottom-75" data-background-color="#f9f9f9">
    <div class="container" id="contact">
        <div class="row">
            <div class="col-md-12">
                <h3 class="headline centered margin-bottom-55">
                    <strong class="headline-with-separator">{{ __('components.views.contact.h3.title') }}</strong>
                </h3>
            </div>
        </div>

        <div class="row">
            <div id="response-msg"></div>
            <form
                id="contactForm"
                action="{{ route('app.sendemail') }}"
                method="POST"
                class="wpcf7-form init"
            >
                <div class="row">
                    <div class="col-md-6">
                        <div>
                            <span class="wpcf7-form-control-wrap name">
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    size="40"
                                    placeholder="{{ __('components.views.contact.form.span.your-name') }}"
                                    required
                                />
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            <span class="wpcf7-form-control-wrap email">
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    size="40"
                                    placeholder="{{ __('components.views.contact.form.span.email') }}"
                                    required
                                />
                            </span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div>
                            <span class="wpcf7-form-control-wrap subject">
                                <input
                                    type="text"
                                    id="subject"
                                    name="subject"
                                    size="40"
                                    placeholder="{{ __('components.views.contact.form.span.subject') }}"
                                    required
                                />
                            </span>
                        </div>
                        <div>
                            <span class="wpcf7-form-control-wrap idcomments">
                                <textarea
                                    name="message"
                                    cols="40" rows="10"
                                    placeholder="{{ __('components.views.contact.form.span.message') }}"
                                    required
                                ></textarea>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-12 margin-left-10">
                        <input 
                            type="submit" 
                            id="btnSubmit"
                            value="{{ __('components.views.contact.form.p.send') }}" 
                        >
                    <div>
                </div>
            </form>
        </div>
    </div>
</section>

@push('scripts')
<script type="text/javascript">
    $(function() {
        $("#contactForm input,#contactForm textarea").jqBootstrapValidation({
            preventSubmit: true,
            submitError: function($form, event, errors) {
                // something to have when submit produces an error ?
                // Not decided if I need it yet
            },
            submitSuccess: function($form, event) {
                event.preventDefault();
                $("#btnSubmit").attr("disabled", true);
                var name      = $("input#name").val();
                var email     = $("input#email").val();
                var subject   = $("input#subject").val();
                var message   = jQuery('textarea[name="message"]').val();
                var firstName = name;
                // Check for white space in name for Success/Fail message
                if (firstName.indexOf(' ') >= 0) {
                    firstName = name.split(' ').slice(0, -1).join(' ');
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: $('#contactForm').attr('action'),
                    type: "POST",
                    data: {
                        name: name,
                        email: email,
                        subject:subject,
                        message: message
                    },
                    cache: false,
                    success: function(data) {
                        $('#response-msg').html(data.view);
                        $('#contactForm').trigger("reset");
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
                        $('#contactForm').trigger("reset");
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

        $("#contactForm input,#contactForm textarea").focus(function() {
            $('#response-msg').html('');
        });
    });
</script>
@endpush
