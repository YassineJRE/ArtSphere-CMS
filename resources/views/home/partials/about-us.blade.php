<section
    class="fullwidth padding-top-75 padding-bottom-70"
    data-background-color="#f9f9f9">
    <div class="container" id="about-us">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h3 class="headline centered headline-extra-spacing">
                    <strong class="headline-with-separator">{{ __('components.views.about-us.h3.title') }}</strong>
                    <span class="margin-top-25">{!! nl2br($aboutUs) !!}</span>
                </h3>
                
                <!-- Section de donation -->
                <div class="donation-section margin-top-50">
                    <p class="donation-text centered">
                        {{ __('components.views.about-us.donation.text') }}
                    </p>
                    <div class="donation-button-container centered margin-top-30">
                        <a href="https://www.paypal.com/donate/?hosted_button_id=TON_BUTTON_ID" 
                           class="button donation-button" 
                           target="_blank"
                           rel="noopener noreferrer">
                            <i class="fa fa-heart"></i>
                            {{ __('components.views.about-us.donation.button') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
