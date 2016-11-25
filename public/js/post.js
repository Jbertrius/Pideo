$(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
   
    $('.pideo-respond').on('click',function () {
        window.location.replace('/makepideo')
    });

    $('.respond').on('click',function () {
        $id = $(this).data('id');
         modal($id);
    });

    function getModal(user) {
        var jqxhr = $.ajax({
            url: '/newmsg',
            type: 'GET',
            data: { user: user },
            dataType: 'html'
        });

        return jqxhr;
    }

    function modal(id) {

        var $modal = $('#new_message');
        //$modal.html('<div id="spin"><span class="fa fa-spinner fa-spin fa-5x fa-fw" style="color: white"></span></div>');
        $modal.html('<img  style="display: block; margin: auto;" src="/img/ring.svg">');
        $modal.modal('show');
        getModal(id).done(function(data) {
            if(data.indexOf('redirect') != -1)
                window.location.replace(data.replace('redirect',''));
            else
            {
                $modal.html(data);
                $modal.modal('show');
            }

        });
    }

    function send () {
        $val = $('#messageBox').val();
        $form = $('#form');

        if($val != '')
            $form.submit();
        else
            event.preventDefault();
    }

});