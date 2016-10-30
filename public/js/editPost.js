$(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $('.btn-delete').on('click', function () {
        $post_id = $(this).parent().data('id');

        $('.alert-delete').data('id', $post_id);

    });
    
    $('.alert-delete').on('click', function () {
        
        $post_id = $(this).data('id');

        window.location.replace('/post/delete/' + $post_id);

    });


    $('.btn-edit').on('click', function () {

        $($(this).parent()).parent().find('.postxt').summernote({
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontname', 'fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['insert', ['link']]
            ],
            height: 300,
            minHeight: null,
            maxHeight: null,
            focus: true
        });
        $(this).html('Ok');
        $(this).parent().find('.btn-delete').css('display: none');
        $('.note-toolbar').removeClass('panel-heading');
    });

});