@extends('layouts.master')

@section('title')
    {{ trans('front/site.title') }}
@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('css/normalize.css')}}">
    <link rel="stylesheet" type="text/css" id="theme" href="{{asset('css/theme-blue.css')}}"/>
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
        @include('partials/sidebar', ['firstname' => Auth::user()->firstname, 'lastname' => Auth::user()->lastname])
        <div class="page-content">
            @include('partials/navbar', ['conversations' => $conversations, 'counter' => $counter])

                    <!-- START BREADCRUMB -->
            <ul class="breadcrumb">
                <li>Home</li>
                <li class="active">Profile</li>
            </ul>
            <!-- END BREADCRUMB -->

            <!-- PAGE CONTENT WRAPPER -->
            <div class="page-content-wrap">

                <div class="col-md-4">

                    <div class="panel panel-default">
                        <div class="panel-body profile" style="background: url({{asset('img/backgrounds/back.jpg')}}) center center no-repeat;">
                            <div class="profile-image">
                                <img src="{{asset('img/icons/user.png')}}"  alt="Nadia Ali"/>
                            </div>
                            <div class="profile-data">
                                <div class="profile-data-name" style="text-shadow: 2px 0px 2px rgba(255, 255, 255, 1); color: #000">{!!Auth::user()->firstname!!}  {!!Auth::user()->lastname!!}</div>
                                <div class="profile-data-title" style="text-shadow: 2px 0px 2px rgba(255, 255, 255, 1); color: #000"> {!!Auth::user()->email!!}</div>
                            </div>
                            <div class="profile-controls">
                                <a href="#" class="profile-control-left twitter"><span class="fa fa-twitter"></span></a>
                                <a href="#" class="profile-control-right facebook"><span class="fa fa-facebook"></span></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <button onclick="location.href = '{{ URL::to('edit') }}';" class="btn btn-info btn-rounded btn-block"><span class="glyphicon glyphicon-edit"></span> Edit profile</button>
                                </div>
                                <div class="col-md-6">
                                    <button onclick="location.href = '{{ URL::to('messages') }}';" class="btn btn-primary btn-rounded btn-block"><span class="fa fa-comments"></span> Chat</button>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body list-group border-bottom">
                            <a href="#" class="list-group-item active"><span class="fa fa-location-arrow"></span> Location</a>
                            <a href="#" class="list-group-item"><span class="fa fa-bar-chart-o"></span> Activity</a>
                            <a href="#" class="list-group-item"><span class="fa fa-book"></span>Subjects
                                @foreach(Auth::user()->subjects as $subject)
                                    <span class="badge badge-default">{!! $subject->subjects !!}</span>
                                @endforeach
                            </a>
                            <a href="#" class="list-group-item"><span class="fa fa-building-o"></span> City <span class="badge badge-default">{!! Auth::user()->city !!}</span></a>
                            <a href="#" class="list-group-item"><span class="fa fa-phone"></span> Tel <span class="badge badge-default">{!! Auth::user()->number !!}</span></a>
                        </div>
                        <div class="panel-body">
                            <h4 class="text-title">Photos</h4>
                            <div class="gallery" id="links">
                                <span>Aucune photo disponible</span>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Location</h3>
                        </div>
                        <div class="panel-body panel-body-map">
                            <div id="google_ptm_map" style="width: 100%; height: 500px;"></div>
                        </div>
                    </div>
                </div>



            </div>


        </div>
        <!-- END PAGE CONTENT WRAPPER -->
    </div>
    </div>
    <!-- END PAGE CONTAINER -->

    <!-- MESSAGE BOX-->
    <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
        <div class="mb-container">
            <div class="mb-middle">
                <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
                <div class="mb-content">
                    <p>Are you sure you want to log out?</p>
                    <p>Press No if you want to continue work. Press Yes to logout current user.</p>
                </div>
                <div class="mb-footer">
                    <div class="pull-right">
                        <a href="pages-login.html" class="btn btn-success btn-lg">Yes</a>
                        <button class="btn btn-default btn-lg mb-control-close">No</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MESSAGE BOX-->

    <!-- START PRELOADS -->
    <audio id="audio-alert" src="{{asset('audio/alert.mp3')}}" preload="auto"></audio>
    <audio id="audio-fail" src="{{asset('audio/fail.mp3')}}" preload="auto"></audio>
    <!-- END PRELOADS -->

@endsection

@section('script')

    <script type="text/javascript" src="{{asset('js/plugins/jquery/jquery-ui.min.js')}}"></script>
    <script type='text/javascript' src="{{asset('js/plugins/icheck/icheck.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/scrolltotop/scrolltopcontrol.js')}}"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPqF6eRkqctYMhsqU5OEzDj1kweuNUfq0&libraries=places"></script>
    <script type="text/javascript" src="{{asset('js/settings.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/actions.js')}}"></script>
    <script type="text/javascript"> var lat = '{!!Auth::user()->latitude!!}' ; var lng = '{!!Auth::user()->longitude!!}'; </script>
    <script type="text/javascript" src="{{asset('js/profileMaps.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/blueimp/jquery.blueimp-gallery.min.js')}}"></script>
@endsection