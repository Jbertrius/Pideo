@extends('layouts.master')

@section('title')
    Messages
@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('css/normalize.css')}}">
    <link rel="stylesheet" type="text/css" id="theme" href="{{elixir('css/theme-blue.css')}}"/>
    <link rel="stylesheet" type="text/css" id="theme" href="{{asset('css/pideo.css')}}"/>
    <link rel="stylesheet" type="text/css" id="theme" href="{{asset('js/plugins/mediaelement/skin/mediaelementplayer.css')}}"/>
@endsection




<?php
$counter = 0;

foreach($conversations as $conversation)
{
    if($conversation->messagesNotifications()->count() != 0)
        $counter++;
}
?>

@section('contenu')

    <div class="page-container">
        @include('partials/sidebar', ['firstname' => Auth::user()->firstname, 'lastname' => Auth::user()->lastname, 'profilePic' => Auth::user()->image_path])
        <div class="page-content">
            @include('partials/navbar', ['conversations' => $conversations, 'counter' => $counter])

                    <!-- START BREADCRUMB -->
            <ul class="breadcrumb">
                <li>Home</li>
                <li>Messages</li>
            </ul>
            <!-- END BREADCRUMB -->


            <!-- START CONTENT FRAME -->
            <div class="content-frame">
                <!-- START CONTENT FRAME TOP -->
                <div class="content-frame-top">
                    <div class="page-title">
                        <h2><span class="fa fa-comments"></span> Messages</h2>
                    </div>
                    <div class="pull-right">
                        <button class="btn btn-danger"><span class="fa fa-book"></span> Contacts</button>
                        <button class="btn btn-default content-frame-right-toggle"><span class="fa fa-bars"></span></button>
                    </div>
                </div>
                <!-- END CONTENT FRAME TOP -->

                <!-- START CONTENT FRAME RIGHT -->
                <div class="content-frame-right">

                    <div class="list-group list-group-contacts border-bottom push-down-10" >
                        <div class="input-group" style="margin-bottom: 12px">
                            <input type="text" class="form-control" placeholder="Search "/>
                                                <span class="input-group-btn">
                                                    <button class="btn btn-default" type="button"><span class="fa fa-search"></span> </button>
                                                </span>
                        </div>
                        <div id="conversationList">
                    @include('partials.conversations', array('conversations' => $conversations, 'current_conversation' => $current_conversation))
                        </div>
                    </div>

                    <div class="block">
                        <h4>Status</h4>
                        <div class="list-group list-group-simple">
                            <a href="#" class="list-group-item"><span class="fa fa-circle text-success"></span> Online</a>
                            <a href="#" class="list-group-item"><span class="fa fa-circle text-warning"></span> Away</a>
                            <a href="#" class="list-group-item"><span class="fa fa-circle text-muted"></span> Offline</a>
                        </div>
                    </div>

                </div>
                <!-- END CONTENT FRAME RIGHT -->

                <!-- START CONTENT FRAME BODY -->
                @if($current_conversation)
                <div class="content-frame-body content-frame-body-left">

                    <div id="messageList" class="messages messages-img" >
                    @include('partials.chat', array('messages' => $current_conversation->messages, 'userId' => Auth::user()->id))
                    </div>

                    <div class="panel panel-default push-up-10"  >
                        <div class="panel-body panel-body-search">

                            <div class="input-group">
                                <div class="input-group-btn">
                                    <button id="dopic" class="btn btn-default send"><span class="fa fa-camera"></span></button>
                                    <button id="dofile" class="btn btn-default send"><span class="fa fa-chain"></span></button>
                                </div>

                                <textarea id="messageBox" class="form-control" placeholder="Your message..."></textarea>
                                <div class="input-group-btn">
                                    <button id="btnSendMessage" class="btn btn-default send">Send</button>

                                     <input type="file" name="pic" id="pic" accept="image/*">
                                    <input type="file" name="file" id="file" accept=".pdf, .docx, .doc">

                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <!-- END CONTENT FRAME BODY -->
                @endif

            </div>
            <!-- END PAGE CONTENT FRAME -->



        </div>


        <!-- END PAGE CONTENT WRAPPER -->
    </div>

    <!-- END PAGE CONTAINER -->
    <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
        <div class="slides"></div>
        <h3 class="title"></h3>
        <a class="prev">‹</a>
        <a class="next">›</a>
        <a class="close">×</a>
        <a class="play-pause"></a>
        <ol class="indicator"></ol>
    </div>

    <div class="modal fade" id="modal-video" tabindex="-1" role="dialog" aria-labelledby="modal-video-label">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-video">
                        <div class="  ">
                            <video id="videoPlayer" width="640" height="360" style="width: 100%; height: 100%;"  ></video>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script type="text/javascript" src="{{asset('js/plugins/jquery/jquery-ui.min.js')}}"></script>
    <script type='text/javascript' src="{{asset('js/plugins/icheck/icheck.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/blueimp/jquery.blueimp-gallery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/settings.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/actions.js')}}"></script>

    <script type="text/javascript" src="{{asset('js/plugins/mediaelement/mediaelement.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/mediaelement/mediaelementplayer.js')}}"></script>
    <script>
        Pusher.logToConsole = true;
        var
           current_conversation = "{{ Session::get('current_conversation') }}",
           user_id   = "{{ Auth::user()->id }}",
           image_path =  "{{ Auth::user()->image_path }}",
           user_name =   "{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}";
      var pusher = new Pusher('{{env("PUSHER_KEY")}}', { cluster: "eu" });
    </script>

    <script src="{{ asset('js/chat.js')}}"></script>

@endsection


