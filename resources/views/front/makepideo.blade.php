@extends('layouts.master')

@section('title')
    Make a Pideo
@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('css/normalize.css')}}">
    <link rel="stylesheet" type="text/css" id="theme" href="{{asset('css/theme-blue.css')}}"/>
    <link rel="stylesheet" type="text/css" id="theme" href="{{asset('js/plugins/mediaelement/skin/mediaelementplayer.css')}}"/>
@endsection


<?php $conversations = Auth::user()->conversations()->get();?>
@foreach($conversations as $conversation)
    <?php $counter = 0;?>
    @if($conversation->messagesNotifications()->count() != 0)
        <?php $counter++?>
    @endif
@endforeach


@section('contenu')

    <div class="page-container">
            @include('partials/sidebar', ['firstname' => Auth::user()->firstname, 'lastname' => Auth::user()->lastname, 'page' => 'MakePideo'])
        <div class="page-content">
            @include('partials/navbar', ['conversations' => $conversations, 'counter' => $counter])

                    <!-- START BREADCRUMB -->
            <ul class="breadcrumb">
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

                    <div class="pull-right">
                        <button type="button" id="upload" class="btn btn-primary btn-sm "><span class="fa fa-picture-o"></span>Upload Picture</button>
                        <button type="button" id="record" class="btn btn-primary btn-sm disabled" data-toggle="modal" data-target="#recording"><span class="fa fa-microphone"></span>Record Audio</button>
                       <button class="btn btn-default content-frame-right-toggle"><span class="fa fa-bars"></span></button>
                    </div>
                </div>


                <div class="content-frame-right" id="content-frame-right">

                    <div class="panel panel-current" style="width:auto;">
                        <div class="panel-body">
                            <div class="img-preview preview-lg" id="prew" ></div>

                        </div>
                    </div>

                    <div class=".add" style="width:auto;">
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
                        <a id="start"><span class="fa fa-microphone fa-5x micro"></span></a>
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

<input type="hidden" id='actual' value="">

@endsection



@section('script')
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

@endsection
