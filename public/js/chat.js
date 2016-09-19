$(function() {

    /***
     Initialization
     ***/
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });



    var
        socket = io('http://localhost:3000'),

        jqxhr  = $.ajax({
            url: '/users/' + user_id + '/conversations',
            type: 'GET',
            dataType: 'json'
        });

    jqxhr.done(function(data) {
        if(data.success && data.result.length > 0) {
            $.each(data.result, function(index, conversation) {
                socket.emit('join', { room:  conversation.name });
            });
        }
    });

    /***
     Socket.io Events
     ***/
    scrollToBottom();
    socket.on('welcome', function (data) {
        console.log(data.message);

        socket.emit('join', { room:  user_id });
    });

    socket.on('joined', function(data) {
        console.log(data.message);
    });

    socket.on('chat.messages', function(data) {
        var
            $messageList  = $("#messageList"),
            $msgContent = $("#mCSB_1_container"),
            $conversation = $("#" + data.room);

        var message      = data.message.body,
            from_user_id = data.message.user_id,
            conversation = data.room;

        getMessages(conversation).done(function(data) {

            $conversation.find('p').text(message);

            if(conversation === current_conversation) {
                $msgContent.html(data);
                scrollToBottom();
            }

            if(from_user_id !== user_id && conversation !== current_conversation) {
                updateConversationCounter($conversation);
            }
        });
    });

    socket.on('chat.conversations', function(data) {
        var $conversationList = $("#conversationList");

        getConversations(current_conversation).done(function(data) {
            $conversationList.html(data);
        });
    });

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
        var day = d.getDay();
        var y = d.getFullYear();
        var mm = d.getMonth();
        var h = d.getHours();
        var mn = d.getMinutes();
        var s = d.getSeconds();

        return y+'-'+mm+'-'+day+' '+h+':'+mn+':'+s;

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
            dataType: 'json'
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
            data:  pic
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
            data:  pic
        });

        return jqxhr;
    }

    function updateConversationCounter($conversation) {
        var
            $badge  = $conversation.find('.badge'),
            counter = Number($badge .text());

        if($badge.length) {
            $badge.text(counter + 1);
        } else {
            $conversation.prepend('<span class="badge">1</span>');
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
        var $messageList  = $("#mCSB_1_container");

        evt.preventDefault();
        $messageList.append('<div class="item item-visible in "><div class="image"><img src="'+ image_path +'" alt="'+user_name+'"></div><div class="text"><div class="heading"><a href="#">'+user_name+'</a><span class="date">'+date()+'</span></div>'+$messageBox.val()+'</div></div>');
        scrollToBottom();
        var msg = $messageBox.val();
        $messageBox.val('');
         
        
        sendMessage(msg, current_conversation, user_id).done(function(data) {
            console.log(data);
            $messageBox.val('');
            $messageBox.focus();
            
        });
    });

    $('#btnNewMessage').on('click', function() {
        $('#newMessageModal').modal('show');
    });

    /**
     * Shift+Enter to send message
     */
    $('#messageBox').keypress(function (event) {
        if (event.keyCode == 13 && event.shiftKey) {
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
        var $messageList  = $("#mCSB_1_container");
        $messageList.append('<div class="item item-visible in "><div class="image"><img src="'+ image_path +'" alt="'+user_name+'"></div><div class="text"><span class="fa fa-spinner fa-spin fa-5x fa-fw" style="color: white"></span></div></div>');
        var $inputFile = $('#file');
        //$('#form').submit();

        sendFile($inputFile, current_conversation, user_id);

    });

    $('#pic').change(function() {

        var $messageList  = $("#mCSB_1_container");
        $messageList.append('<div class="item item-visible in "><div class="image"><img src="'+ image_path +'" alt="'+user_name+'"></div><div class="text"><span class="fa fa-spinner fa-spin fa-5x fa-fw" style="color: white"></span></div></div>');
        var $inputPic = $('#pic');
        //$('#form').submit();

        sendPicture($inputPic, current_conversation, user_id);

    });

});


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
