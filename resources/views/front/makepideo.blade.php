

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Make a pideo</title>
    <meta name="description" content="Pideo" />
    <meta name="keywords" content="html, pideo, streaming, social network, web design" />
    <meta name="author" content="Jbertrius" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />


    <link rel="manifest" href="/manifest.json">
    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async></script>

    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var UserId = "{{ Auth::user()->webpushid->count()  }}";

    </script>

    <script type="text/javascript" src="{{asset('js/webpush.js')}}"></script>



    <!-- Favicons (created with http://realfavicongenerator.net/)-->
    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('img/favicons/apple-touch-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('img/favicons/apple-touch-icon-60x60.png')}}">
    <link rel="icon" type="image/png" href="{{asset('img/favicons/favicon-32x32.png" sizes="32x32')}}">
    <link rel="icon" type="image/png" href="{{asset('img/favicons/favicon-16x16.png" sizes="16x16')}}">
    <link rel="manifest" href="{{asset('img/favicons/manifest.json')}}">
    <link rel="shortcut icon" href="{{asset('img/favicons/favicon.ico')}}">
    <meta name="msapplication-TileColor" content="#00a8ff">
    <meta name="msapplication-config" content="img/favicons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">




    <!--[if lt IE 9]>
    {{ Html::style('https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js') }}
    {{ Html::style('https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js') }}
    <![endif]-->

    <!-- Styles -->

    <link rel="stylesheet" type="text/css" href="{{asset('css/normalize.css')}}">
    <!--Import Google Icon Font-->
    <link href="//fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="{{asset('css/materialize.css')}}"  media="screen,projection"/>

    <link rel="stylesheet" type="text/css" id="theme" href="{{asset('css/theme-blue.css')}}"/>
    <link rel="stylesheet" type="text/css" id="theme" href="{{asset('js/plugins/mediaelement/skin/mediaelementplayer.css')}}"/>

    <link rel="stylesheet" type="text/css"   href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>



</head>





<?php
$conversations = Auth::user()->conversations()->get();
$counter = 0;

foreach($conversations as  $conversation)
{
    if($conversation->messagesNotifications()->count() != 0)
        $counter++;
}
?>

<body>



    <div class="page-container">
            @include('partials/sidebar', ['firstname' => Auth::user()->firstname, 'lastname' => Auth::user()->lastname, 'page' => 'MakePideo', 'profilePic' => Auth::user()->image_path])
        <div class="page-content">
            @include('partials/navbar', ['conversations' => $conversations, 'counter' => $counter])

                    <!-- START BREADCRUMB -->
            <ul class="breadcrumb" style="margin-bottom: 0px;">
                <li>Home</li>
                <li class="active">Make a Pideo</li>
            </ul>
            <!-- END BREADCRUMB -->

            <div class="content-frame">
                <!-- START CONTENT FRAME TOP -->
                <div class="content-frame-top">
                    <div class="page-title">
                        <h2><span class="fa fa-film"></span> Make a Pideo</h2>
                    </div>

                    <div class="pull-right ">
                        <button type="button" id="upload" class="btn btn-primary btn-sm hidden-xs"><span class="fa fa-picture-o"></span>Upload Picture</button>
                        <button type="button" id="record" class="btn btn-primary btn-sm disabled hidden-xs" data-toggle="modal" data-target="#recording"><span class="fa fa-microphone"></span>Record Audio</button>

                        <button class="btn btn-default content-frame-right-toggle"><span class="fa fa-bars"></span><span class="badge sectionCounter red"></span></button>
                    </div>
                </div>


                <div class="content-frame-right" id="content-frame-right">

                    <div class="panel panel-current" style="width:auto;">
                        <div class="panel-body">
                            <div class="img-preview preview-lg" id="prew" ></div>

                        </div>
                    </div>

                    <div class="add" style="width:auto;">
                            <button type="button"  onclick="addsection(this);" class="btn btn-primary btn-sm"><span class="fa fa-plus"></span>Add Section</button>
                    </div>

                </div>


                <div class="content-frame-body content-frame-body-left">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <img id="image" src="/images/PideoSelectPic.jpg/0">
                        </div>
                    </div>

                    <div>

                        <input type="file" id="inputImage" accept="image/*" name="file">
                    </div>
                </div>

            </div>


        </div>
        <!-- END PAGE CONTENT WRAPPER -->

    </div>

    <div class="modal centerModal" id="recording" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="defModalHead">Audio Recording</h4>
                </div>
                <div class="modal-body">

                    <div class="col-xs-4 col-xs-offset-4 text-center">
                        <a id="start" href="#"><span class="fa fa-microphone fa-5x micro"></span></a>
                    </div>

                    <div class="row">
                        <div class="player text-center">
                        </div>
                    </div>

                    <div>
                        <canvas id="wavedisplay" width="300" height="50"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal smallcenterModal" id="pideo" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="defModalHead">Create Pideo</h4>
                </div>

                <div class="modal-body" id="generateBody">

                    <form class="form-horizontal text-center" role="form">

                    <div class="form-group">
                        <label class=" col-md-2 control-label col-md-offset-2">Title</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="title" required="required"
                                   data-validation-error-msg="Title required" name="title"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label col-md-offset-2">Category</label>
                        <div class="col-md-6">
                            <select class="form-control select" id="cat" name="category">
                                @foreach(\App\Models\Subject::all() as $subject)
                                    <option value="{!! $subject->id !!}">{!! $subject->subjects!!}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label col-md-offset-2">Tags</label>
                        <div class="col-md-6">
                            <input type="text" id="tags" class="tagsinput" required="required" name="tags" value=""/>
                        </div>
                    </div>

                    <button type="button"  id="go" onclick="" class="btn btn-primary btn-sm ">GO</button>

                    </form>


                </div>

            </div>
        </div>
    </div>

  <div class="fixed-action-btn hidden-md hidden-lg">
    <a class="btn-floating btn-large indigo" data-toggle="tooltip" data-placement="left" title="Create">
      <i class="large material-icons">mode_edit</i>
    </a>
    <ul>
        <li><a class="btn-floating red disabled" data-toggle="tooltip" id="float-generate" data-placement="left" title="Generate Pideo"><i class="material-icons">videocam</i></a></li>
        <li><a class="btn-floating green disabled" id="audioRecord" data-toggle="tooltip" data-placement="left" title="Record audio"><i class="material-icons">mic</i></a></li>

      <li><a class="btn-floating yellow darken-1 disabled" id="addsection" data-toggle="tooltip" data-placement="left" title="Add section"><i class="material-icons">add</i></a></li>

      <li><a class="btn-floating blue" id="uploadPic" data-toggle="tooltip" data-placement="left" title="Upload picture"><i class="material-icons">panorama</i></a></li>
    </ul>
  </div>
        

<input type="hidden" id='actual' value="">
    <div class="basic stopwatch"></div>






    <script type="text/javascript" src="{{asset('js/materialize.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="//js.pusher.com/3.2.0/pusher.min.js"></script>
    <script type="text/javascript" src="{{asset('js/editPic.js')}}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        Pusher.logToConsole = true; var pusher = new Pusher('{{env("PUSHER_KEY")}}', { cluster: "eu" }), user_id   = "{{ Auth::user()->id }}";
    </script>
    <script src="{{'js/notif.js'}}"></script>

    <script type="text/javascript" src="{{asset('js/plugins/jquery/jquery-ui.min.js')}}"></script>
    <script type='text/javascript' src="{{asset('js/plugins/icheck/icheck.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('js/plugins/bootstrap/bootstrap-select.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/tagsinput/jquery.tagsinput.min.js')}}"></script>
 

    <script type="text/javascript" src="{{asset('js/settings.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/actions.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/cropper/cropper.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/mediaelement/mediaelement.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/mediaelement/mediaelementplayer.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/Recorder/recorder.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/Stopwatch.js')}}"></script>
    <script>
        var
                user_id   = "{{ Auth::user()->id }}";
    </script>
    <script type="text/javascript" src="{{asset('js/makepideo.js')}}"></script>
    <script>
        function changeSize() {
            var width = parseInt($("#Width").val());
            var height = parseInt($("#Height").val());

            if(!width || isNaN(width)) {
                width = 600;
            }
            if(!height || isNaN(height)) {
                height = 400;
            }
            $("#content-frame-right").width(width).height(height);

            // update perfect scrollbar
            Ps.update(document.getElementById('content-frame-right'));
        }
        $(function() {
            Ps.initialize(document.getElementById('content-frame-right'));
        });
    </script>

    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
    <script>
        $.validate({
            modules : 'html5',
        });
    </script>



</body>
</html>