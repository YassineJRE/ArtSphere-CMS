@isset($artwork)
    @auth
        <x-button.add-to-collection :item="$artwork" type="artwork" />

        <x-button.remove-from-db :item="$artwork" type="artwork" />

        <x-button.edit :item="$artwork" type="artwork" />
    @endauth

    <x-button.share :item="$artwork" type="artwork" />

    @push('scripts')
        <script type="text/javascript">
            $('.popup-row').magnificPopup({
                type: 'inline',
                fixedContentPos: false,
                fixedBgPos: true,
                overflowY: 'auto',
                closeBtnInside: true,
                preloader: false,
                midClick: true,
                removalDelay: 300,
                mainClass: 'my-mfp-zoom-in'
            });
            function copyToClipboard(id) {
                const input = document.getElementById(`inputTextToCopy-${id}`);
                if (!input) return;
                navigator.clipboard.writeText(input.value).then(() => {
                    alert("{!! __('profile.views.scripts.alert.copied-to-clipboard') !!}");
                });
            }
        </script>
    @endpush
@endisset
