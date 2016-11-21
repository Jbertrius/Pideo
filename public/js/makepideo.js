var Timer;

$(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });



    var console = window.console || { log: function () {} };
    var $image = $('#image');
    var $download = $('#download');
    var $dataX = $('#dataX');
    var $dataY = $('#dataY');
    var $dataHeight = $('#dataHeight');
    var $dataWidth = $('#dataWidth');
    var $dataRotate = $('#dataRotate');
    var $dataScaleX = $('#dataScaleX');
    var $dataScaleY = $('#dataScaleY');
    var options = {
        aspectRatio: 16 / 9,
        preview: '.img-preview',
        crop: function (e) {
            $dataX.val(Math.round(e.x));
            $dataY.val(Math.round(e.y));
            $dataHeight.val(Math.round(e.height));
            $dataWidth.val(Math.round(e.width));
            $dataRotate.val(e.rotate);
            $dataScaleX.val(e.scaleX);
            $dataScaleY.val(e.scaleY);
        }
    };

    $image.cropper(options);

    $("#upload").click(function() {
        $("#inputImage").click();
    });

    // Import image
    var $inputImage = $('#inputImage');
    var URL = window.URL || window.webkitURL;
    var blobURL;

    if (URL) {
        $inputImage.change(function () {
            var files = this.files;
            var file;

            if (!$image.data('cropper')) {
                return;
            }

            if (files && files.length) {
                file = files[0];

                if (/^image\/\w+$/.test(file.type)) {
                    blobURL = URL.createObjectURL(file);
                    $image.one('built.cropper', function () {

                        // Revoke when load complete
                        URL.revokeObjectURL(blobURL);
                    }).cropper('reset').cropper('replace', blobURL);
                    $inputImage.val('');
                } else {
                    window.alert('Please choose an image file.');
                }
            }
        });
    } else {
        $inputImage.prop('disabled', true).parent().addClass('disabled');
    }
});



window.AudioContext = window.AudioContext || window.webkitAudioContext;

var audioContext = new AudioContext();
var audioInput = null,
    realAudioInput = null,
    inputPoint = null,
    audioRecorder = null;
var rafID = null;
var analyserContext = null;
var canvasWidth, canvasHeight;
var recIndex = 0;

/* TODO:

 - offer mono option
 - "Monitor input" switch
 */

function saveAudio() {
    audioRecorder.exportWAV( doneEncoding );
    // could get mono instead by saying
    // audioRecorder.exportMonoWAV( doneEncoding );
}

function drawBuffer( width, height, context, data ) {
    var step = Math.ceil( data.length / width );
    var amp = height / 2;
    context.fillStyle = "silver";
    context.clearRect(0,0,width,height);
    for(var i=0; i < width; i++){
        var min = 1.0;
        var max = -1.0;
        for (j=0; j<step; j++) {
            var datum = data[(i*step)+j];
            if (datum < min)
                min = datum;
            if (datum > max)
                max = datum;
        }
        context.fillRect(i,(1+min)*amp,1,Math.max(1,(max-min)*amp));
    }
}

function gotBuffers( buffers ) {
    var canvas = document.getElementById( "wavedisplay" );

    drawBuffer( canvas.width, canvas.height, canvas.getContext('2d'), buffers[0] );

    // the ONLY time gotBuffers is called is right after a new recording is completed -
    // so here's where we should set up the download.
    audioRecorder.exportWAV( doneEncoding );
}

function doneEncoding( blob ) {
    createPlayer();
    Recorder.setupDownload( blob, "myRecording" + ((recIndex<10)?"0":"") + recIndex + ".wav" );



    recIndex++;
    var reader = new FileReader();

    reader.onload = function(e) {
        // e.targer.result will hold the base64 data.
        // Note: It includes the pre-text "data:audio/<format>;base64,<base64 data>"
        // Then do
        //audio.src = e.target.result;
        // OR
        $("#save").attr("src", e.target.result);
        $('.first').last().find('audio').attr("src",e.target.result);
    };
    reader.readAsDataURL(blob);
 
}

function toggleRecording( e ) {
    if (e.classList.contains("recording")) {
        // stop recording
        $('.progress').remove();
        Timer.stop();
        Timer.reset();
        $('.basic').html('');
        audioRecorder.stop();
        e.classList.remove("recording");
        audioRecorder.getBuffers( gotBuffers );
    } else {

        $('.content-frame-body').prepend('<div class="progress" style="background-color: #e25e5e;margin-bottom: 0px;"><span class="timer"></span><div class="indeterminate" style="background-color: #ff0a0a;"></div></div>');
        var elems = document.getElementsByClassName("basic");
        Timer =   new Stopwatch(elems[0]);

        // start recording
        if (!audioRecorder)
            return;
        e.classList.add("recording");

        audioRecorder.clear();
        Timer.start();
        audioRecorder.record();
    }
}

function convertToMono( input ) {
    var splitter = audioContext.createChannelSplitter(2);
    var merger = audioContext.createChannelMerger(2);

    input.connect( splitter );
    splitter.connect( merger, 0, 0 );
    splitter.connect( merger, 0, 1 );
    return merger;
}

function cancelAnalyserUpdates() {
    window.cancelAnimationFrame( rafID );
    rafID = null;
}

function updateAnalysers(time) {
    if (!analyserContext) {
        var canvas = document.getElementById("analyser");
        canvasWidth = canvas.width;
        canvasHeight = canvas.height;
        analyserContext = canvas.getContext('2d');
    }

    // analyzer draw code here
    {
        var SPACING = 3;
        var BAR_WIDTH = 1;
        var numBars = Math.round(canvasWidth / SPACING);
        var freqByteData = new Uint8Array(analyserNode.frequencyBinCount);

        analyserNode.getByteFrequencyData(freqByteData);

        analyserContext.clearRect(0, 0, canvasWidth, canvasHeight);
        analyserContext.fillStyle = '#F6D565';
        analyserContext.lineCap = 'round';
        var multiplier = analyserNode.frequencyBinCount / numBars;

        // Draw rectangle for each frequency bin.
        for (var i = 0; i < numBars; ++i) {
            var magnitude = 0;
            var offset = Math.floor( i * multiplier );
            // gotta sum/average the block, or we miss narrow-bandwidth spikes
            for (var j = 0; j< multiplier; j++)
                magnitude += freqByteData[offset + j];
            magnitude = magnitude / multiplier;
            var magnitude2 = freqByteData[i * multiplier];
            analyserContext.fillStyle = "hsl( " + Math.round((i*360)/numBars) + ", 100%, 50%)";
            analyserContext.fillRect(i * SPACING, canvasHeight, BAR_WIDTH, -magnitude);
        }
    }

    rafID = window.requestAnimationFrame( updateAnalysers );
}

function toggleMono() {
    if (audioInput != realAudioInput) {
        audioInput.disconnect();
        realAudioInput.disconnect();
        audioInput = realAudioInput;
    } else {
        realAudioInput.disconnect();
        audioInput = convertToMono( realAudioInput );
    }

    audioInput.connect(inputPoint);
}

function gotStream(stream) {
    inputPoint = audioContext.createGain();

    // Create an AudioNode from the stream.
    realAudioInput = audioContext.createMediaStreamSource(stream);
    audioInput = realAudioInput;
    audioInput.connect(inputPoint);

//    audioInput = convertToMono( input );

    analyserNode = audioContext.createAnalyser();
    analyserNode.fftSize = 2048;
    inputPoint.connect( analyserNode );

    audioRecorder = new Recorder( inputPoint );

    zeroGain = audioContext.createGain();
    zeroGain.gain.value = 0.0;
    inputPoint.connect( zeroGain );
    zeroGain.connect( audioContext.destination );
    //updateAnalysers();
}

function initAudio() {
    if (!navigator.getUserMedia)
        navigator.getUserMedia = navigator.webkitGetUserMedia || navigator.mozGetUserMedia;
    if (!navigator.cancelAnimationFrame)
        navigator.cancelAnimationFrame = navigator.webkitCancelAnimationFrame || navigator.mozCancelAnimationFrame;
    if (!navigator.requestAnimationFrame)
        navigator.requestAnimationFrame = navigator.webkitRequestAnimationFrame || navigator.mozRequestAnimationFrame;

    navigator.getUserMedia(
        {
            "audio": {
                "mandatory": {
                    "googEchoCancellation": "false",
                    "googAutoGainControl": "false",
                    "googNoiseSuppression": "false",
                    "googHighpassFilter": "false"
                },
                "optional": []
            },
        }, gotStream, function(e) {
            alert('Error getting audio');
            console.log(e);
        });
}

function createPlayer() {
    if($('#save').length)
        $('#save').remove();

    if($('.first').last().find('audio').length)
        $('.first').last().find('audio').remove();



    $('.player').append('<audio id="save" src="" preload="auto" controls></audio>');

    $('.first').last().append('<audio class="sectionAudio" src="" preload="auto" style="visibility: hidden" controls></audio>');

}

window.addEventListener('load', initAudio );

$("#start").click(function(e) {
    e.preventDefault();


    toggleRecording(this);
    $(this).find('span').toggleClass('shine');
});

function refreshCount(){
    $('.content-frame-right-toggle').find('.badge').text($('.content-frame-right').find('.panel-default').length);
}

 function addsection (e) {
    var result;
    var url;

    result = $("#image").cropper('getCroppedCanvas');

    var options = {
        aspectRatio: 16 / 9,
        preview: '.img-preview',
        crop: function (e) {
            $dataX.val(Math.round(e.x));
            $dataY.val(Math.round(e.y));
            $dataHeight.val(Math.round(e.height));
            $dataWidth.val(Math.round(e.width));
            $dataRotate.val(e.rotate);
            $dataScaleX.val(e.scaleX);
            $dataScaleY.val(e.scaleY);
        }
    };
     
    url = result.toDataURL("image/jpeg", 1.0);


        
        e.remove();



        $(".content-frame-right").append('<div class="panel panel-default" style="width:auto;">'+
            '<div class="panel-body">'+
            '<div class="first" style="width: 250px; height: 140.625px;">'+
            '<img src="'+ url +'" style="width: 250px;">'+
            '<span class="fa fa-play-circle-o fa-5x playsign" onclick="jouer(this);"></span>'+
            '<span class="fa fa-times closeSection" onclick="erase(this);"></span>'+
            '</div>'+
            '</div>'+
            '</div>');

        $(".content-frame-right").append(
            '<div class="add" style="width:auto;">'+
            '<button type="button"  onclick="addsection(this);" class="btn btn-primary btn-sm"><span class="fa fa-plus"></span>Add Section</button>'+
            '</div>');

        $("#image").one('built.cropper').cropper('reset').cropper('replace', '/images/PideoSelectPic.jpg/0');





     $('#record').removeClass('disabled');
     $('#audioRecord').removeClass('disabled');
     $('.player').find('audio').remove();
     
     if(!$('.content-frame-top').find('.pull-right').find('#generate').length)
     {
         $('.content-frame-top').find('.pull-right').prepend('<button type="button" id="generate" data-toggle="modal" data-target="#pideo"" class="btn btn-primary btn-sm hidden-xs"><span class="fa fa-video-camera"></span>Generate Pideo</button>');
         $('.fixed-action-btn').find('ul').prepend('<li><a class="btn-floating red" data-toggle="tooltip" id="float-generate" data-placement="left" title="Generate Pideo"><i class="material-icons">videocam</i></a></li>');
     }

     refreshCount();
 
}


function jouer(e) {
    if (e.classList.contains("fa-play-circle-o"))
    {
        e.classList.remove("fa-play-circle-o");
        e.classList.add("fa-pause");
        play_audio(e, 'play');

    }

    else if(e.classList.contains("fa-pause"))
    {
        e.classList.add("fa-play-circle-o");
        e.classList.remove("fa-pause");
        play_audio(e, 'stop');

    }
}

function play_audio(e, task) {
    $audio = $(e).parent().find('audio');
    audio = $audio[0];

    audio.addEventListener('ended', function(){
        e.classList.add("fa-play-circle-o");
        e.classList.remove("fa-pause");
    });

    if(task == 'play'){
        $audio.trigger('play');
    }
    else if(task == 'stop'){
        $audio.trigger('pause');
    }


}


function sendSection() {
    var section = new FormData();


    var title = $('#title').val();
    var cat = $('#cat').val();
    var tags = $('#tags').val();

    var nbsection = $('.first').length;
    for(i = 0; i < nbsection ; i++)
    {
        var imgUrl = $('.first').find('img')[i].src;
        var imgBlob =  dataURItoBlob(imgUrl);

        var audioUrl = $('.first').find('audio')[i].src;
        var audioBlob = dataURItoBlob(audioUrl);

        section.append('img'+i, imgBlob);
       section.append('audio'+i, audioBlob);
    }

    section.append('user_id', user_id);
    section.append('sectionNb', nbsection);
    section.append('title', title);


    section.append('category', cat);

    if(tags != "")
    section.append('tags', tags);

    var jqxhr = $.ajax({
        type: "POST",
        url: 'createpideo',
        cache: false,
        contentType: false,
        processData: false,
        data:  section
    });

    return jqxhr;
}

function deletePideo (filename) {
    var jqxhr = $.ajax({
        type: "POST",
        url: '/delete/'+filename,
        data: {userId: user_id},
        dataType: 'html'
    });

    return jqxhr;
}

function getUsersList() {
    var jqxhr = $.ajax({
        type: "GET",
        url: '/getUserList',
        dataType: 'html'
    });

    return jqxhr;
}

function sendPideo() {
    var id,conversation;
    id = $('.selectpicker').val().split('_')[0];
    conversation = $('.selectpicker').val().split('_')[1];

    var jqxhr = $.ajax({
        type: "POST",
        data : {id : id, pideo :  $('#generateBody').data('pideo'), conversation : conversation },
        url: '/pideo/send',
        dataType: 'html'
    });

    return jqxhr;
}

function getBlob(url) {
    var xhr = new XMLHttpRequest();
    var result = null;
    xhr.open('GET', url, true);
    xhr.responseType = 'blob';
    xhr.send();



}



function erase (e) {
    $(e).parent().parent().parent().remove();
    refreshCount();
}

function dataURItoBlob(dataURI) {
    // convert base64 to raw binary data held in a string
    // doesn't handle URLEncoded DataURIs - see SO answer #6850276 for code that does this
    var byteString = atob(dataURI.split(',')[1]);

    // separate out the mime component
    var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0]

    // write the bytes of the string to an ArrayBuffer
    var ab = new ArrayBuffer(byteString.length);
    var ia = new Uint8Array(ab);
    for (var i = 0; i < byteString.length; i++) {
        ia[i] = byteString.charCodeAt(i);
    }

    // write the ArrayBuffer to a blob, and you're done
    var blob = new Blob([ab], {type: mimeString});
    return blob;

    // Old code
    // var bb = new BlobBuilder();
    // bb.append(ab);
    // return bb.getBlob(mimeString);
}

$('#go').on('click',function () {

    var msg = '<div class="text-center">'+
        '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>'+
        '</div><div class="row text-center" style="font-size: large;font-weight: bold;">'+
        '<span>Generating... </span>'+
        '</div>';

    $('#title').validate(function(valid, elem) {
        state = (valid) ? false : true;
            $('#go').prop("disabled",state);

        if(!state)
        {


            sendSection()
                .done(function (data) {

                var url = '/pideos/'+data;
                    
                $('#generateBody').data('pideo', data);
                $('#generateBody').html('');

                $('#generateBody').append('<div id="video-container"></div>')
                $('#generateBody').find('div').html('<video controls="" src='+url+' width="500" height="281" style="width: 100%; height: 100%;"></video>');
                $('#generateBody').after('<div class="modal-footer">'+
                    '<button type="button" class="btn btn-primary pull-left" id="sendPideo" >Send</button>'+
                    '<button type="button" class="btn btn-primary pull-right" id="delPideo" >Delete</button>'+
                    '</div>');
                $('video').mediaelementplayer({
                    features: ['playpause','current','progress','duration','tracks','volume','fullscreen'],
                    videoVolume: 'horizontal',
                    alwaysShowControls: true
                });


            })
                .fail(function () {
                    var retry = '<div class="text-center">'+
                        '<i class="fa fa-repeat fa-3x"></i>'+
                        '</div><div class="row text-center" style="font-size: large;font-weight: bold;">'+
                        '<span>Retry </span>'+
                        '</div>';

                    $('#generateBody').html(retry);
                });




            $('#generateBody').html(msg);
        }
        
        

    });



});

$('#title').on('change', function () {
    $('#title').validate(function(valid, elem) {
        valid = (valid) ? false : true;
        $('#go').prop("disabled",valid);
    });
});

$('.modal').on('click', '#sendPideo', function () {
    var filename = $('video').attr('src').split('/')[2];

    $footer = $($(this).parent());

    if($footer.find('#users').length == 1)
    {
        $(this).attr('disabled','disabled');
        $(this).html('Sending <i class="fa fa-spinner fa-spin"></i>');

        sendPideo().done(function () {

        });

    }
    else{
        $(this).attr('disabled','disabled');
        $(this).html('Send <i class="fa fa-spinner fa-spin"></i>');
        getUsersList().done(function (data) {
            $('#sendPideo').html('Send');
            $('#sendPideo').after(data);
            $('#sendPideo').removeAttr('disabled');
            $('.selectpicker').selectpicker();
        });
    }



});

$('.modal').on('click', '#delPideo', function () {
  var filename = $('video').attr('src').split('/')[2];
    $('#delPideo').attr("disabled","disabled");
    $('#delPideo').html('Deleting <i class="fa fa-spinner fa-spin"></i>');

    deletePideo(filename).done(function (data) {
        location.reload();
    });

});

$('#uploadPic').on('click', function () {
    $('#upload').trigger('click');
});

$('#addsection').on('click', function () {
    $('.add').find('button').trigger('click');
});

$('#audioRecord').on('click', function () {
    $('#start').trigger('click');
});

$('body').on('click', '#float-generate', function () {
    $('#generate').trigger('click');
});