$(function() {

    /***
     Initialization
     ***/

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    function appendNotification(conversation, imgPath, fullname, msg, consId) {

        var $counter1 = $('#counter1');
        var $counter2 = $('#counter2');
        var $conv = $('#' + consId);

        var $msgNotif = $('#msgNotif').find('a').parent();
        if($counter1.find('.informer').length > 0)
        {
            var int = parseInt($counter1.find('.informer').text(), 10) + 1;
            $counter1.find('.informer').html(int);
            $counter2.find('span').html(int+' new');

        }
        else
        {
            $counter1.append('<div class="informer informer-danger" >1</div>');
            $counter2.append('<span class="label label-danger">1 new</span>');
        }


        var not = '<a href="/messages/?conversation=' + conversation + '" id=" '+ consId+' " class="list-group-item">'+
            '<div class="list-group-status status-online"></div><img src="' + imgPath + '" class="pull-left" alt="' + fullname + '"/>'+
            '<span class="contacts-title">' + fullname + '</span><p>'+msg + '<span class="label label-danger">1</span> </p></a>';

        if($conv.length = 0)
        {
            $msgNotif.prepend(not);

        }
        else
        {
            if($($('#' + consId).find('p')).find('span').length > 0)
                $inc = Number($($('#' + consId).find('p')).find('span').html());
            else
                $inc = 0;

            document.getElementById(consId).innerHTML = '<div class="list-group-status status-online"></div><img src="' + imgPath + '" class="pull-left" alt="' + fullname + '"/><span class="contacts-title">' + fullname + '</span><p>' + msg +'  <span class="label label-danger">' + ($inc+1) + '</span></p>';
        }
    }



    var channel = pusher.subscribe('channel_'+ user_id);

    channel.bind('message', function(data) {
        var message         = data.message.body,
            from_user_id    = data.message.user_id,
            fullname        = data.message.fullname,
            img             = data.message.img,
            conversation    = data.room,
            consId          = data.message.conserId;
 

        appendNotification(conversation, img, fullname, message,consId);

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-bottom-left",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        toastr.info(fullname + ' send you a message.');
 
    });

    function appendPost(post_id, author, description, category, date) {

        var $counter1 = $('#post_counter1');
        var $counter2 = $('#post_counter2');

        var $msgNotif = $('#postNotif').find('a').parent();
        if($counter1.find('.informer').length > 0)
        {
            var int = parseInt($counter1.find('.informer').text(), 10) + 1;
            $counter1.find('.informer').html(int); 

        }
        else
        {
            $counter1.append('<div class="informer informer-warning" >1</div>');
        }


        var not = '<a class="list-group-item" href="/request/'+ post_id+'"  style="background-color: #f5f5f5;" >'+
            '<strong>'+ description +'</strong>'+
        '<br>'+
        '<span class="label label-success">'+ category +'</span>'+
        '<p>'+
        '<small class="text-muted">'+ author+', '+ date +' </small>'+
        '</p>'+
        '</a>';

        $msgNotif.prepend(not);



    }



    channel.bind('post', function(data) {
        var message         = data.message.description,
            category    = data.message.category,
            author        = data.message.author,
            date             = data.message.date,
            id = data.message.id;


        appendPost(id, author, message, category, date);

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-bottom-left",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        toastr.info('A problem has been posted !');

    });
    
    
    });
    