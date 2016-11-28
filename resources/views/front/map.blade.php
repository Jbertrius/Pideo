
@extends('layouts.master')

@section('title')
    {{ trans('front/site.title') }}
@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('css/normalize.css')}}">
    <link rel="stylesheet" type="text/css" id="theme" href="{{elixir('css/theme-blue.css')}}"/>
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
            @include('partials/sidebar', ['firstname' => Auth::user()->firstname, 'lastname' => Auth::user()->lastname, 'page' => 'Map', 'profilePic' => Auth::user()->image_path])
        <div class="page-content">
            @include('partials/navbar', ['conversations' => $conversations, 'counter' => $counter])

            <!-- START BREADCRUMB -->
            <ul class="breadcrumb">
                <li>Home</li>
                <li class="active">Map</li>
            </ul>
            <!-- END BREADCRUMB -->

            <!-- PAGE CONTENT WRAPPER -->
            <div class="page-content-wrap">
                <div class="col-md-12">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Google Map Search</h3>

                            <button class="btn pull-right btn-default content-toggle"><span class="fa fa-search"></span></button>

                            <form class="pull-right form-inline content" >

                                <div class="form-group">
                                    <span id="amount" style="color: #30bee6; font-weight: bold"></span>
                                    &nbsp;
                                </div>

                                    <div class="form-group">
                                            <select class="form-control select" id="lang">
                                                <option value = "all"> All </option>
                                                <option value = "Français"> Français </option>
                                                <option value = "English"> English </option>
                                            </select>
                                    </div>

                                <div class="form-group">
                                    <select class="form-control select" id="sub">
                                        <option value = "all"> All </option>
                                        @foreach(\App\Models\Subject::all() as $subject)
                                            <option value="{{ $subject->id }}">{{ $subject->subjects }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                    <div class="form-group">
                                        <div class="col-md-4">
                                            <input type="text" id="search" class="form-control" placeholder="location..."/>
                                        </div>
                                    </div>

                                <div class="form-group">
                                    <label class="col-xs-4 control-label text-left" style="margin-top: 7px;">Online</label>
                                    <div class="col-xs-3">
                                        <label class="switch">
                                            <input type="checkbox" class="switch" value="1" checked/>
                                            <span></span>
                                        </label>
                                    </div>
                                </div>

                            </form>

                        </div>


                        <div class="panel-body panel-body-map">
                            <div id="google_search_map" style="width: 100%; height: 500px;"></div>
                        </div>
                    </div>

                </div>


            </div>
            <!-- END PAGE CONTENT WRAPPER -->
        </div>


    @include('partials/footer')
       </div>
       <!-- END PAGE CONTAINER -->
       <div class="modal" id="new_message" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">

       </div>
   @if(isset($data))
       {!! $data !!}
       @endif

       @endsection


       @section('script')
           <script>
               Pusher.logToConsole = true; var pusher = new Pusher('{{env("PUSHER_KEY")}}', { cluster: "eu" }), user_id   = "{{ Auth::user()->id }}";
           </script>
           <script src="{{'js/notif.js'}}"></script>
           <script type="text/javascript" src="{{asset('js/plugins/jquery/jquery-ui.min.js')}}"></script>
           <script type='text/javascript' src="{{asset('js/plugins/icheck/icheck.min.js')}}"></script>
           <script type="text/javascript" src="{{asset('js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js')}}"></script>
           <script type="text/javascript" src="{{asset('js/plugins/scrolltotop/scrolltopcontrol.js')}}"></script>
           <script type="text/javascript" src="{{asset('js/settings.js')}}"></script>
           <script type="text/javascript" src="{{asset('js/plugins.js')}}"></script>
           <script type="text/javascript" src="{{asset('js/actions.js')}}"></script>
           <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPqF6eRkqctYMhsqU5OEzDj1kweuNUfq0&libraries=places"></script>
           <script>
               var
                       user_id   = "{{ Auth::user()->id }}",
                       image_path = "{{ Auth::user()->image_path }}";

           </script>
           <script type="text/javascript" src="{{asset('js/studentsMap.js')}}"></script>
           <script type="text/javascript" src="{{asset('js/plugins/bootstrap/bootstrap-select.js')}}"></script>
       @endsection