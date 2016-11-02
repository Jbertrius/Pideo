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

        $postxt =  $($(this).parent()).parent().find('.postxt');

        $postxt.data('post', $postxt.html().trim() );

        $postxt.summernote({
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
            height: 150,
            minHeight: null,
            maxHeight: null,
            focus: true
        });
        $(this).css('display','none');
        $(this).parent().find('.btn-delete').css('display','none');
        $('.note-toolbar').removeClass('panel-heading');

        $(this).parent().append('<div class="validation"> <button class="btn btn-primary" id="editPost">Ok</button> <button class="btn btn-default" id="destroy"> Cancel</button> </div>');


    });


    $('body').on('click', '#destroy', function () {

        $parentValisation = $(this).parent();
        $parentPostRow = $($parentValisation).parent();
        $parentPostItem = $($parentPostRow).parent();

        $parentPostRow.find('.btn-delete').removeAttr("style");
        $parentPostRow.find('.btn-edit').removeAttr("style");

        $parentPostItem.find('.post-text').summernote('code',$parentPostItem.find('.post-text').data('post'));

        $parentPostItem.find('.post-text').summernote('destroy');

        $parentValisation.remove();



    });

    $('body').on('click', '#editPost', function (e) {

        $parentValisation = $(this).parent();
        $parentPostRow = $($parentValisation).parent();
        $parentPostItem = $($parentPostRow).parent();

        if(!$($.parseHTML($parentPostItem.find('.post-text').summernote('code'))).text().trim())
        {
            e.preventDefault();

        }
        else
        {


        $(this).html('<i class="fa fa-spinner fa-spin fa-fw"></i> Ok');
        $(this).attr('disabled','disabled');

        editpost($parentPostItem.find('.post-text').summernote('code').trim(), $parentPostRow.data('id')).done(function (data) {


            $parentPostItem.find('.post-text').summernote('code', data);

            $parentPostItem.find('.post-text').summernote('destroy');
            $parentPostRow.find('.btn-delete').removeAttr("style");
            $parentPostRow.find('.btn-edit').removeAttr("style");

            $parentValisation.remove();
        });
            }


    });

    function  editpost($text, $id){

        var jqxhr = $.ajax({
            url: '/post/edit',
            type: 'POST',
            data: { text : $text, post_id : $id},
            dataType: 'html'
        });

        return jqxhr;
    }





});