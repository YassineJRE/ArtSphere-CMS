/* ----------------- Start Document ----------------- */
(function($){
    "use strict";

    $(document).ready(function (e) {
        $('.uz-input').change(function(){
            if (this.files.length > 0) {
                const fileSize = this.files.item(0).size;
                const fileMb = fileSize / 1024 ** 2;
                if (fileMb >= artolog_core.maxFilesize) {
                    alert(artolog_core.dictFileTooBig);
                    return false;
                }
            }
            let previewMediaUploaded = $(this).parents('.uploadzone').children('.uz-preview');
            let reader = new FileReader();
            reader.onload = (e) => {
                if ( e.target.result.includes('data:image') ) {
                    $(previewMediaUploaded).find('img').attr('src', e.target.result);
                    $(previewMediaUploaded).removeClass('hidden');
                } else if ( e.target.result.includes('data:application/pdf') ) {
                    $(previewMediaUploaded).find('img').attr('src', window.asset + 'img/documents/pdf2.png');
                    $(previewMediaUploaded).removeClass('hidden');
                } else if ( e.target.result.includes('data:application/vnd.openxmlformats-officedocument.wordprocessingml.document') || e.target.result.includes('application/msword') ) {
                    $(previewMediaUploaded).find('img').attr('src', window.asset + 'img/documents/doc.png');
                    $(previewMediaUploaded).removeClass('hidden');
                } else {
                    $(previewMediaUploaded).find('img').attr('src', '');
                    $(previewMediaUploaded).addClass('hidden');
                }
            }
            reader.readAsDataURL(this.files[0]);
        });
        $('.uz-remove').click(function(event){
            let inputMedia = $(this).parents('.uploadzone').find('.uz-input');
            let href = $(this).data('href');
            let previewMediaUploaded = $(this).parents('.uploadzone').children('.uz-preview');
            $(previewMediaUploaded).find('img').attr('src', '');
            $(previewMediaUploaded).addClass('hidden');
            $(inputMedia).val('');
            $(this).data('href','');
            if (href) {
                event.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: href,
                    type: 'DELETE',
                    success: function(result) {
                        // Do something with the result
                    }
                });
            }
        });
    });

})(this.jQuery);
// ------------------ End Document ------------------ //