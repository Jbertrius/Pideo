@extends('layouts.master')

@section('title')
    My requests
@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('css/normalize.css')}}">
    <link rel="stylesheet" type="text/css" id="theme" href="{{asset('css/theme-blue.css')}}"/>

    <link href="//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
    <style>
        .breadcrumb{
            margin-bottom: 0px !important;
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
        @include('partials/sidebar', ['firstname' => Auth::user()->firstname, 'lastname' => Auth::user()->lastname, 'page' => 'myrequest',  'profilePic' => Auth::user()->image_path])
        <div class="page-content">
            @include('partials/navbar', ['conversations' => $conversations, 'counter' => $counter])


            <ul class="breadcrumb">
                <li>Home</li>
                <li class="active">My requests</li>
            </ul>


            <div class="content-frame-top">

            <div class="page-title">
                <h2><span class="fa fa-share-square"></span> My requests</h2>
            </div>

            </div>


            <div class="row">

                <div class="col-md-12">

                    <div class="alert alert-info" role="alert">
                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <strong>Information:</strong> Once your problem is solved, mark it at solved.
                    </div>
                </div>

                @if($number > 1)<div class="col-md-12">@else<div class="col-md-6">@endif



                            <?php
                            $cpt = 0
                            ?>

                            @foreach($posts as $post )

                                    <?php
                                    $cpt++;
                                    ?>




                                @if($cpt%2 == 1)<div class="row">@endif

                                            @if($number > 1)<div class="col-md-6">@else<div class="col-md-12">@endif

                                                    <div class="panel panel-default">
                                                        <div class="panel-body posts">
                                        <div class="post-item">

                                            <div class="post-title">
                                                {{  $post->description }}

                                                <div class="pull-right"><div class="label label-success" style="font-size: 12px">{{ $post->cat->subjects }}</div> </div>
                                            </div>
                                            <div class="post-date"><span class="fa fa-calendar"></span> {{ $post->created_at }}  </div>
                                            <div class="post-text @if($post->type == 'text') postxt @elseif($post->type == 'File') post-link @endif " id="links">
                                                @if($post->type == 'text')
                                                    {!!  $post->content !!}
                                                @elseif($post->type == 'Picture')
                                                   <a href="images/{{ $post->file->filename }}/0" class="post-img"> <img src="images/{{ $post->file->filename }}/0" class="img-responsive img-text"/> </a>
                                                @elseif($post->type == 'File')
                                                    <a href="/files/{{ $post->file->filename }}">{{ $post->file->original_filename }}</a>
                                                @endif
                                            </div>
                                            <div class="post-row " data-id ="{{ $post->id }}">
                                                @if($post->type == 'text')
                                                    <button class="btn btn-info btn-rounded btn-edit"><span class="fa fa-edit"></span> Edit</button>
                                                @endif
                                                <button class="btn btn-danger btn-rounded mb-control btn-delete" data-box="#message-box-danger"><span class="fa fa-trash-o"></span> Delete</button>

                                                <div class="pull-right">
                                                    <div class="form-group">
                                                        <div class="col-md-3">
                                                            <label class="switch" data-toggle="tooltip" data-placement="top" title="Mark as Solved" >
                                                                <input type="checkbox" class="switch"  value="1" >
                                                                <span></span>
                                                            </label>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>

                                        </div>


                                    </div>

                                                    </div>
                                                </div>

                                            @if($cpt%2 == 0)</div>@endif

                                @endforeach



                </div>



             </div>

            <div class="row">
                <div class="col-md-12 ">
            {{ $posts->links() }}
                    </div>
            </div>



        </div>


    </div>

            <div class="message-box message-box-danger animated fadeIn" id="message-box-danger">
                <div class="mb-container">
                    <div class="mb-middle">
                        <div class="mb-title"><span class="fa fa-times"></span> Are you sure?</div>
                        <div class="mb-content">
                            <p>You will not be able to recover this post !</p>
                        </div>
                        <div class="mb-footer text-center">
                            <button class="btn btn-default btn-lg  mb-control-close alert-delete"  >Yes, delete it !</button>
                            <button class="btn btn-default btn-lg  mb-control-close">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="blueimp-gallery" class="blueimp-gallery">
                <div class="slides"></div>
                <h3 class="title"></h3>
                <a class="prev">‹</a>
                <a class="next">›</a>
                <a class="close">×</a>
                <a class="play-pause"></a>
                <ol class="indicator"></ol>
            </div>
@endsection



@section('script')
    <script>
        Pusher.logToConsole = true; var pusher = new Pusher('{{env("PUSHER_KEY")}}', { cluster: "eu" }), user_id   = "{{ Auth::user()->id }}";
    </script>
    <script src="{{asset('js/notif.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/jquery/jquery-ui.min.js')}}"></script>
    <script type='text/javascript' src="{{asset('js/plugins/icheck/icheck.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/dropzone/dropzone.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/scrolltotop/scrolltopcontrol.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/blueimp/jquery.blueimp-gallery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/settings.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/actions.js')}}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>
                <script type="text/javascript" src="{{asset('js/editPost.js')}}"></script>
    <script>
                    document.getElementById('links').onclick = function (event) {
                        event = event || window.event;
                        var target = event.target || event.srcElement;
                        var link = target.src ? target.parentNode : target;
                        var options = {index: link, event: event,onclosed: function(){
                            setTimeout(function(){
                                $("body").css("overflow","");
                            },200);
                        }};
                        var links = this.getElementsByTagName('a');
                        blueimp.Gallery(links, options);
                    };
                </script>


@endsection