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
        @include('partials/sidebar', ['firstname' => Auth::user()->firstname, 'lastname' => Auth::user()->lastname, 'profilePic' => Auth::user()->image_path])
        <div class="page-content">
            @include('partials/navbar', ['conversations' => $conversations, 'counter' => $counter])

                    <!-- START BREADCRUMB -->
            <ul class="breadcrumb">
                <li>Home</li>
                <li>Profile</li>
                <li class="active">Edit Profile</li>
            </ul>
            <!-- END BREADCRUMB -->

            <!-- PAGE CONTENT WRAPPER -->
            <div class="page-content-wrap">
                <div class="row">
                    <div class="col-md-12">

                          <form class="form-horizontal">
                            <div class="panel panel-default tabs">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="active"><a href="#tab-first" role="tab" data-toggle="tab">Personal Informations</a></li>
                                    <li><a href="#tab-second"  role="tab" data-toggle="tab">Location</a></li>
                                </ul>
                                <div class="panel-body tab-content">
                                    <div class="tab-pane active" id="tab-first">
                                        <p>Edit your personnal informations here</p>

                                        <div class="form-group row">
                                            <label class="col-md-3 col-xs-12 control-label">First Name</label>
                                            <div class="col-md-4 col-xs-6 edit-style" data-attr="firstname">
                                                   {!!  Auth::user()->firstname !!} <a href="#" class="simple"  data-toggle="tooltip" data-placement="top" title="Edit"><span class="fa fa-pencil edit-icon"></span></a>
                                            </div>
                                         
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 col-xs-12 control-label">Last Name</label>
                                            <div class="col-md-4 col-xs-6 edit-style" data-attr="lastname" >
                                               {!!  Auth::user()->lastname !!} <a href="#"  class="simple"    data-toggle="tooltip" data-placement="top" title="Edit"><span class="fa fa-pencil edit-icon"></span></a>
                                            </div>
                                         
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 col-xs-12 control-label">Password</label>
                                            <div class="col-md-4 col-xs-12 edit-style" data-attr="pwd">
                                                ******* <a href="#"  class="pwd" data-toggle="tooltip" data-placement="top" title="Edit"><span class="fa fa-pencil edit-icon"></span></a>
                                             </div>

                                        </div>

                                        <div class="form-group" id="groupsub">

                                            <label class="col-md-3 col-xs-12 control-label">
                                                   Subjects</label>

                                            <div class="col-md-6 col-xs-12 edit-style">
                                            @foreach( Auth::user()->subjects as $subject)
                                                <div class="row">
                                                {!! $subject->subjects !!} <a href="#"  class="subject" data-toggle="tooltip" data-placement="top" title="Edit"><span class="fa fa-pencil edit-icon"></span></a>
                                                 </div>
                                            @endforeach
                                            </div>


                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">Language</label>
                                            <div class="col-md-4 col-xs-6 edit-style" data-attr="lang">
                                                {!! Auth::user()->lang !!} <a href="#"  class="lang" data-toggle="tooltip" data-placement="top" title="Edit"><span class="fa fa-pencil edit-icon"></span></a>
                                            </div>
                                         
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">Tel</label>
                                            <div class="col-md-4 col-xs-6 edit-style" data-attr="number">
                                                {!! Auth::user()->number !!} <a href="#"  class="simple" data-toggle="tooltip" data-placement="top" title="Edit"><span class="fa fa-pencil edit-icon"></span></a>
                                            </div>
                                         
                                        </div>



                                    </div>
                                    <div class="tab-pane" id="tab-second">
                                        <p>Change your location here</p>

                                        <div class="form-group">
                                            <label class="col-md-2 col-xs-12 control-label">City</label>
                                            <div class="col-md-4 col-xs-6 edit-style" data-attr="city">
                                                 {!!  Auth::user()->city !!} <a href="#" class="city"  data-toggle="tooltip" data-placement="top" title="Edit"><span class="fa fa-pencil edit-icon"></span></a>
                                            </div>
                                         
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 col-xs-12 control-label">Location</label>
                                            <div class="col-md-6 col-xs-12">
                                                <div class="panel-body panel-body-map">
                                                    <div id="google_edit_map" style="width: 100%; height: 200px;"></div>
                                                </div>
                                                <input type="hidden" class="hidden" name="lat" id="lat" value="{!! Auth::user()->latitude!!}" />
                                                <input type="hidden" class="hidden"  name="lng" id="lng" value="{!! Auth::user()->longitude!!}" />
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>

                        </form>

                    </div>
                </div>

            </div>


        </div>
        @include('partials/footer')
        <!-- END PAGE CONTENT WRAPPER -->
    </div>

    </div>
    <!-- END PAGE CONTAINER -->


@endsection

@section('script')
          <script>
    Pusher.logToConsole = true; var pusher = new Pusher('{{env("PUSHER_KEY")}}', { cluster: "eu" }), user_id   = "{{ Auth::user()->id }}";
    </script>
     <script src="{{'js/notif.js'}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/jquery/jquery-ui.min.js')}}"></script>
    <script type='text/javascript' src="{{asset('js/plugins/icheck/icheck.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/bootstrap/bootstrap-select.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/dropzone/dropzone.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/fileinput/fileinput.min.js')}}"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPqF6eRkqctYMhsqU5OEzDj1kweuNUfq0&libraries=places"></script>
    <script type="text/javascript"> var lat = '{!!Auth::user()->latitude!!}' ; var lng = '{!!Auth::user()->longitude!!}'; </script>
    <script type="text/javascript" src="{{asset('js/edit.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/settings.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/actions.js')}}"></script>
    <script type="text/javascript">
        $("#file-simple").fileinput({
            showUpload: false,
            showCaption: false,
            browseClass: "btn btn-primary",
            fileType: "any",
            showPreview : false
        });
    </script>
@endsection


