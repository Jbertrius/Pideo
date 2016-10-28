$(function() {


    $('#summernote').summernote({
        placeholder: "Ex : Hi everyone, I'm looking for a solution for my C++ problem ...",
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


    Dropzone.options.drop = {
        autoProcessQueue : false,
        uploadMultiple : false,
        maxFiles : 1,
        acceptedFiles : 'image/*,application/pdf,application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/msword'

    };

 /*  Dropzone.options.drop = {
        init: function() {
            this.on("addedfile", function(file){
                var myDropzone = this;

                $('.btn-post').click(function(){

                    myDropzone.processQueue(); //processes the queue
                });
            });
        }
    };
    */


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });



    $('.btn-post').on('click', function (e) {

        if($('.btn-primary').hasClass('texts'))
        {
            if(!$($.parseHTML($('#summernote').summernote('code'))).text().trim())
            {
                e.preventDefault();

            }
            else
                askModal();

        }
        else if($('.btn-primary').hasClass('images'))
        {
            var files = $('#drop').get(0).dropzone.getAcceptedFiles();

            if (files.length == 0)
                e.preventDefault();
            else
                askModal();
        }

    });

     function askModal() {
        var $modal = $('#postmsg');

         $('.btn-post').html('<i class="fa fa-spinner fa-spin fa-fw"></i> Post');

        postModal().done(function (data) {
            $('.btn-post').html('Post');
            $modal.html(data);
            $modal.modal('show');

            if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
                $('.selectpicker').selectpicker('mobile');
            }


            $('.selectpicker').selectpicker('render');

            $.validate({
                modules : 'html5',
            });
        });
    }


    $('body').on('click', '.send-post', function () {
        
       $category =  $('.selectpicker').val();
       $description = $('#title').val();

        $('.send-post').html('<i class="fa fa-spinner fa-spin fa-fw"></i> Send');

        if($('.btn-primary').hasClass('texts'))
        {
            sendProblemtext($category, $description).done(function (data) {
                $('#summernote').summernote('reset')
                $('.modal').html('');
                $('.modal').after(data);

                $('.message-box-success').show();
            });

        }
        else if($('.btn-primary').hasClass('images'))
        {
            sendProblemfile($category, $description).done(function (data) {
                $('#drop').get(0).dropzone.removeAllFiles();
                $('.modal').after(data);
                $('.modal').html('');
                $('.message-box-success').show();
            });
        }

    });





    /*String.prototype.isEmpty = function() {
        return (this.length === 0 || !this.trim());
    };*/



    function  sendProblemtext($category, $description){

        var jqxhr = $.ajax({
            url: '/post/text',
            type: 'POST',
            data: { text : $('#summernote').summernote('code'), user : user_id , cat : $category, title : $description},
            dataType: 'html'
        });

        return jqxhr;
    }

    function  sendProblemfile($category, $description){
        $inputPic = $('.dz-hidden-input');
        var file = new FormData();

        var files = $('#drop').get(0).dropzone.getAcceptedFiles();

        if (files.length > 0) {

            file.append('file',  files[0]);
            file.append('type',  files[0].type);
            file.append('cat', $category);
            file.append('title', $description);
        }

        file.append('user_id', user_id);
        
        var jqxhr = $.ajax({
            url: '/post/file',
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data:  file,
            dataType : 'html'
        });

        return jqxhr;
    }

    function postModal() {
        var jqxhr = $.ajax({
            url: '/post',
            type: 'GET',
            dataType: 'html'
        });

        return jqxhr;
    }


    $('body').on('click', '.close-success', function () {
        $('.message-box-success').hide();
    });
    

    });