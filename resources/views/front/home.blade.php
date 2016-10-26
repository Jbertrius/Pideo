@extends('layouts.master')

@section('title')
    {{ trans('front/site.title') }}
@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('css/normalize.css')}}">
    <link rel="stylesheet" type="text/css" id="theme" href="{{asset('css/theme-blue.css')}}"/>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
    <style>
        .breadcrumb{
            margin-bottom: 0px !important;
        }
        .modal-backdrop {
            z-index: -1;
        }
    </style>
@endsection

<?php
$conversations = Auth::user()->conversations()->get();
$counter = 0;

foreach($conversations as $conversation)
{
    if($conversation->messagesNotifications()->count() != 0)
        $counter++;
}
?>


@section('contenu')

    <div class="page-container">
        @include('partials/sidebar', ['firstname' => Auth::user()->firstname, 'lastname' => Auth::user()->lastname, 'page' => 'Search', 'profilePic' => Auth::user()->image_path])
        <div class="page-content">
            @include('partials/navbar', ['conversations' => $conversations, 'counter' => $counter])



            <!-- PAGE CONTENT WRAPPER -->
            <div class="page-content-wrap" style="height:100%;">
                <div class="col-md-12" id="post">

                    <div class="post">
                        <h3 class="fix-shadow"><span class="fa fa-upload fix-shadow" ></span> Post your problem</h3>

                        <p>Add your image or file in the dropzone box or Write your problem in the text area</p>
                    <div class="row">

                        <button class="btn btn-primary images"><span class="fa fa-image"></span> Images/Files</button>

                        <button class="btn btn-default texts"><span class="glyphicon glyphicon-pencil"></span>Text</button>
                    </div>

                        <form action="#" id = "drop" class="dropzone"></form>


                        <div class="col-md-12 text-area hidden">
                            <textarea class="form-control" id="summernote" style=" height: 125px;" placeholder="Ex : Hi everyone, I'm looking for a solution for my C++ problem ...">


                            </textarea>

                        </div>

                        <p>
                            <button type="button" class="btn-post">Post</button>
                        </p>
                    </div>
                    </div>




                </div>
            </div>
            <!-- END PAGE CONTENT WRAPPER -->
        </div>

    <!-- END PAGE CONTAINER -->
    <div class="modal" id="postmsg" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true" style="top:20%">

    </div>
@endsection


@section('script')
    <script>
        Pusher.logToConsole = true; var pusher = new Pusher('{{env("PUSHER_KEY")}}', { cluster: "eu" }), user_id   = "{{ Auth::user()->id }}";
    </script>
    <script src="{{'js/notif.js'}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/jquery/jquery-ui.min.js')}}"></script>
    <script type='text/javascript' src="{{asset('js/plugins/icheck/icheck.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/dropzone/dropzone.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/scrolltotop/scrolltopcontrol.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/backstretch/jquery.backstretch.min.js')}}"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>

    <script type="text/javascript" src="{{asset('js/settings.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/actions.js')}}"></script>
    <script>
        $(".post").backstretch("img/backgrounds/back_3.jpeg");
        var
                user_id   = "{{ Auth::user()->id }}",
                image_path = "{{ Auth::user()->image_path }}";

    </script>
     <script type="text/javascript" src="{{asset('js/plugins/bootstrap/bootstrap-select.js')}}"></script>

    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>

    <script>
        $(".page-container").addClass("page-navigation-toggled");
        $(".x-navigation-minimize").trigger("click");
    </script>
    <script type="text/javascript" src="{{asset('js/sendproblem.js')}}"></script>
@endsection
