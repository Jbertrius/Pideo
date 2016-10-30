@extends('layouts.master')

@section('title')
   {{ $title }}
@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('css/normalize.css')}}">
    <link rel="stylesheet" type="text/css" id="theme" href="{{asset('css/theme-blue.css')}}"/>
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
        @include('partials/sidebar', ['firstname' => Auth::user()->firstname, 'lastname' => Auth::user()->lastname,   'profilePic' => Auth::user()->image_path])
        <div class="page-content">
            @include('partials/navbar', ['conversations' => $conversations, 'counter' => $counter])


            <ul class="breadcrumb">
                <li>Home</li>
                <li class="active">Requests</li>
            </ul>

            <div class="page-title">
                <h2><span class="fa fa-exclamation-circle"></span> Requests</h2>
            </div>

            <div class="page-content-wrap">


            <div class="row">

                @if($onePost == true)
                <div class="col-md-9">

                    <div class="panel panel-default">
                        <div class="panel-body posts">

                            <div class="post-item">
                                <div class="post-title" >
                                    {{  $description }}

                                    <div class="pull-right"><div class="label label-warning" style="font-size: 12px">{{ $category }}</div> </div>
                                </div>
                                <div class="post-date"><span class="fa fa-calendar"></span> {{ $date }}  by {{ $users }} </div>
                                <div class="post-text @if($type == 'text') postxt @elseif($type == 'File') post-link @endif" id="links">

                                    @if($type == 'text')
                                        {!!  $content !!}
                                    @elseif($type == 'Picture')
                                        <a href="/images/{{ $filename }}/0" class="post-img"><img src="/images/{{ $filename }}/0" class="img-responsive img-text"/> </a>
                                    @elseif($type == 'File')
                                        <a href="/files/{{ $filename }}">{{ $original_filename }}</a>
                                    @endif

                                </div>
                                <div class="post-row">
                                    <button id="respond" data-id="{{ $user_id }}" class="btn btn-default btn-rounded "><span class="fa fa-envelope"></span> Respond</button>
                                    <button id="pideo-respond" class="btn btn-default btn-rounded "><span class="fa fa-film"></span> Respond with a pideo</button>
                                </div>
                            </div>


                        </div>
                    </div>

                </div>

                @else

                    @if($number > 1)<div class="col-md-9">@else<div class="col-md-9">@endif



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

                                                        <div class="post-title" >
                                                            {{  $post->post->description }}

                                                            <div class="pull-right"><div class="label label-warning" style="font-size: 12px">{{ $post->cat->subjects }}</div> </div>
                                                        </div>
                                                        <div class="post-date"><span class="fa fa-calendar"></span> {{ $post->post->created_at }}  by {{ $post->post->users->fullname() }} </div>
                                                        <div class="post-text @if($post->post->type == 'text') postxt @elseif($post->post->type == 'File') post-link @endif" id="links">


                                                            @if($post->post->type == 'text')
                                                                {!!  $post->post->content !!}
                                                            @elseif($post->post->type == 'Picture')
                                                               <a href="/images/{{ $post->post->file->filename }}/0" class="post-img"> <img src="/images/{{ $post->post->file->filename }}/0" class="img-responsive img-text"/> </a>
                                                            @elseif($type == 'File')
                                                                <a href="/files/{{ $post->post->file->filename }}">{{ $post->post->file->original_filename }}</a>
                                                            @endif

                                                        </div>
                                                        <div class="post-row">
                                                            <button id="respond" data-id = "{{  $post->post->users->id }}" class="btn btn-default btn-rounded "><span class="fa fa-envelope"></span> Respond</button>
                                                            <button id="pideo-respond" class="btn btn-default btn-rounded "><span class="fa fa-film"></span> Respond with a pideo</button>


                                                            <div class="pull-right">

                                                            </div>

                                                        </div>

                                                    </div>


                                                </div>

                                                        </div>
                                                    </div>

                                                @if($cpt%2 == 0)</div>@endif

                                            @endforeach



                            </div>


                            {{ $posts->links() }}

                                            @if(isset($category))
                                                <div class="col-md-3">
                                                    <div class="panel panel-default">
                                                        <div class="panel-body">
                                                            <h3>Categories</h3>
                                                            <div class="links">

                                                                @for($i=0; $i< count($category); $i++)
                                                                    <a href="/request/category/{{ $cat_id [$i] }}"> {{ $category [$i] }} <span class="label label-default">{{ $count_category [$i] }}</span></a>
                                                                @endfor

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            @endif
                        </div>







                @endif



             </div>

            </div>



        </div>


    </div>

        <div class="modal" id="new_message" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">

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
    <script type="text/javascript" src="{{asset('js/plugins/backstretch/jquery.backstretch.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/settings.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/actions.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/post.js')}}"></script>
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