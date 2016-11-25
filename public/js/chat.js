$(function() {

    /***
     Initialization
     ***/
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
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


    var $loading = '<div class="item item-visible in"><div class="image"><img src="/img/icons/user.png" alt="Pietro MAXIMOFF"></div><div class="text" style="margin-left: 080% !important;text-align: center;">'+
        '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>'+
        '</div></div>';
    

    var channel = pusher.subscribe('channel_'+ user_id);
    
    channel.bind('message', function(data) {
        var message         = data.message.body,
            from_user_id    = data.message.user_id,
            fullname        = data.message.fullname,
            img             = data.message.img,
            conversation    = data.room,
            consId          = data.message.conserId;
        var
            $messageList  = $("#messageList"),
            $msgContent = $('#messageList').find('.item').parent(),
            $conversation = $("#" + data.room),
            $consId = $("#" + data.message.conserId);
        
        if(conversation != current_conversation)
        {

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
        
        }

        getMessages(conversation).done(function(data) {

            $conversation.find('p').text(message);
            $consId.find('p').text(message);

            if(conversation === current_conversation) {
                $msgContent.html(data);
                scrollToBottom();
            }

            if(from_user_id !== user_id && conversation !== current_conversation) {
                updateConversationCounter($conversation);
            }
        });
    });


        jqxhr  = $.ajax({
            url: '/users/' + user_id + '/conversations',
            type: 'GET',
            dataType: 'json'
        });

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




    /***
     Socket.io Events
     ***/
    scrollToBottom();

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
            $msgNotif.append(not);


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



  /*  socket.on('chat.conversations', function(data) {
        var $conversationList = $("#conversationList");

        getConversations(current_conversation).done(function(data) {
            $conversationList.html(data);
        });
    });*/

    /***
     Functions
     ***/

    function getConversations(current_conversation) {
        var jqxhr = $.ajax({
            url: '/conversations',
            type: 'GET',
            data: { conversation: current_conversation },
            dataType: 'html'
        });

        return jqxhr;
    }
    
    function date() {
        var d = new Date();
        var day = d.getDate();
        var y = d.getFullYear();
        var mm = d.getMonth()+1;
        var h = d.getHours();
        var mn = d.getMinutes();
        var s = d.getSeconds();

        return day+'/'+mm+'/'+y;

    }

    function getMessages(conversation) {
        var jqxhr = $.ajax({
            url: '/chat',
            type: 'GET',
            data: { conversation: conversation },
            dataType: 'html'
        });

        return jqxhr;
    }

    function sendMessage(body, conversation, user_id) {
        var jqxhr = $.ajax({
            url: '/messages',
            type: 'POST',
            data:  { body: body , conversation: conversation, user_id: user_id },
            dataType: 'html'
        });

        return jqxhr;
    }

    function sendPicture($inputPic, conversation, user_id) {
        
        var pic = new FormData();

        if (($inputPic)[0].files.length > 0) {
            file_size = ($inputPic)[0].files[0].size;
            pic.append('pic', ($inputPic)[0].files[0]);
        }

        pic.append('conversation', conversation);
        pic.append('user_id', user_id);

        var jqxhr = $.ajax({
            url: '/fileentry/addPic/'+user_id,
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data:  pic,
            dataType : 'html'
        });

        return jqxhr;
    }

    function sendFile($input, conversation, user_id) {
        var pic = new FormData();

        if (($input)[0].files.length > 0) {
            file_size = ($input)[0].files[0].size;
            pic.append('file', ($input)[0].files[0]);
        }

        pic.append('conversation', conversation);
        pic.append('user_id', user_id);


        var jqxhr = $.ajax({
            url: '/fileentry/addFile/'+user_id,
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data:  pic,
            dataType : 'html'
        });

        return jqxhr;
    }

    function updateConversationCounter($conversation) {
        var
            $badge  = $conversation.find('.label'),
            counter = Number($badge.text());

        if($badge.length > 0) {
            $badge.text(counter + 1);
        } else {
            $conversation.find('p').append('<span class="label label-danger">1</span>');
        }
    }

    function scrollToBottom() {
        var $messageList  = $("#messageList");
        $messageList.mCustomScrollbar("update");
        $messageList.mCustomScrollbar("scrollTo", "bottom");
    }

    /***
     Events
     ***/

    $('#btnSendMessage').on('click', function (evt) {
        var $messageBox  = $("#messageBox");
        var $messageList  =   $('#messageList').find('.item').parent();

        if($messageBox.val() === '')
            evt.preventDefault();
        else
        {  $messageList.append('<div class="item item-visible in "><div class="image"><img src="'+ image_path +'" alt="'+user_name+'"></div><div class="text"><div class="heading"><a href="#">'+user_name+'</a><span class="date">'+date()+'</span></div>'+$messageBox.val()+'</div></div>');
        scrollToBottom();
        var msg = $messageBox.val();
        $messageBox.val('');
         
        
        sendMessage(msg, current_conversation, user_id).done(function(data) {
            console.log(data);
            $messageBox.val('');
            $messageBox.focus();

            var $conversationList = $("#conversationList");
            var $notifBar = $('#msgNotif');

            getConversations(current_conversation).done(function(data) {
                $conversationList.html(data);
                $notifBar.html(data);
            });

            $messageList.children().last().remove();
            $messageList.append(data);
            
        });
        }
    });

    $('#btnNewMessage').on('click', function() {
        $('#newMessageModal').modal('show');
    });

    /**
     * Shift+Enter to send message
     */
    $('#messageBox').keypress(function (event) {
        if (event.keyCode == 13) {
            event.preventDefault();

            $('#btnSendMessage').trigger('click');
        } 
    });

    $("#dopic").click(function() {
        $("#pic").click();
    });

    $("#dofile").click(function() {
        $("#file").click();
    });

    $('#file').change(function() {

        var $messageList  =   $('#messageList').find('.item').parent();
         var $inputFile = $('#file');

        $messageList.append($loading);
        scrollToBottom();
        //$('#form').submit();

        sendFile($inputFile, current_conversation, user_id).done(function (data) {
            $messageList.children().last().remove();
            $messageList.append(data);
            scrollToBottom();

            var $conversationList = $("#conversationList");
            var $notifBar = $('#msgNotif');

            getConversations(current_conversation).done(function(data) {
                $conversationList.html(data);
                $notifBar.html(data);
            });


        });

    });

    $('#pic').change(function() {

        var $messageList  =   $('#messageList').find('.item').parent();
         var $inputPic = $('#pic');
        //$('#form').submit();
        $messageList.append($loading);
        scrollToBottom();

        sendPicture($inputPic, current_conversation, user_id).done(function (data) {
            $messageList.children().last().remove();
            $messageList.append(data);

            scrollToBottom();
            var $conversationList = $("#conversationList");
            var $notifBar = $('#msgNotif');

            getConversations(current_conversation).done(function(data) {
                $conversationList.html(data);
                $notifBar.html(data);
            });
        });


    });

});

if($('#links').length == 0 )
document.getElementById('links').onclick = function (event) {
    event = event || window.event;
    var target = event.target || event.srcElement,
        link = target.src ? target.parentNode : target,
        options = {index: link, event: event,onclosed: function(){
            setTimeout(function(){
                $("body").css("overflow","");
            },200);
        }},
        links = this.getElementsByTagName('a');
    blueimp.Gallery(links, options);
};

$('body').on('click','.playsign2',  function(e){
    e.preventDefault();
    var url = $(this).data('url');

    $( '#' + $(this).data('modal-id') ).find('video').attr('src',url);
    $('video').mediaelementplayer({
        features: ['playpause','current','progress','duration','tracks','volume','fullscreen'],
        videoVolume: 'horizontal',
        alwaysShowControls: true
    });

    $( '#' + $(this).data('modal-id') ).modal();
    setInterval(function(){checkvideo()},3000);
});

function checkvideo() {
    var height = $('.mejs-video').height();
    if(height == 0)
        $('#videoPlayer').get(0).player.load();
}

/*
$('.modal-header').on('click', 'button', function () {
   $('#videoPlayer').get(0).player.pause();
});*/