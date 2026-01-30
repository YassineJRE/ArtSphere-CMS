@isset($exhibit)
    @auth
        <x-button.add-to-collection :item="$exhibit" type="exhibit" />

        <x-button.remove-from-db :item="$exhibit" type="exhibit" />

        <x-button.edit :item="$exhibit" type="exhibit" />
    @endauth

    <x-button.share :item="$exhibit" type="exhibit" />

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
