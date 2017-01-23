@extends('layouts.secondmaster')


@section('title')
    {{ trans('front/site.title') }}
@endsection


@section('style')
    <link rel="stylesheet" type="text/css" id="theme" href="{{asset('css/themefirstpage.css')}}"/>
    <link rel="stylesheet" type="text/css" id="theme" href="{{asset('js/angular/jquery.fullPage.css')}}"/>
@endsection


<?php

if(\Illuminate\Support\Facades\Auth::check())
{
    $conversations = Auth::user()->conversations()->get();
    $counter = 0;

    foreach($conversations as $conversation)
    {
        if($conversation->messagesNotifications()->count() != 0)
            $counter++;
    }
}
?>


@section('contenu')

    <div ng-app="fileUpload" ng-controller="MyCtrl" >
        <div class="page-container" id="fullpage">


            <!-- PAGE CONTENT -->
            <div class="page-content section fp-auto-height-responsive" >

                @if($isConnected)
                @include('partials/navbar2', ['isConnected' => $isConnected, 'conversations' => $conversations, 'counter' => $counter, 'firstname' => Auth::user()->firstname,
                                          'lastname' => Auth::user()->lastname, 'page' => 'Search', 'profilePic' => Auth::user()->image_path])
                @else
                @include('partials/navbar2', ['page' => 'Search', 'isConnected' => $isConnected])
                @endif






                        <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap slide" id="main">

                    <div class="content-frame picRange">

                        <div class="content-frame-body"  ng-cloak>

                            <div class="hint" ng-if="hint">
                                Selectionnez vos images pour commencer la création de piideo !!

                            </div>

                            <div class="gallery" id="links" resize-container>

                                <a ng-repeat="f in files track by $index" class="gallery-item" ngf-src= "f"   data-gallery >
                                    <div class="image">
                                        <img ngf-src= "f" ngf-resize="{ ratio: '1:1', centerCrop: true, quality: 0.8}"    ngf-no-object-url= true/>
                                        <ul class="gallery-item-controls">
                                            <li><span class="gallery-item-remove" ng-click="deleteFile($index)"><i class="fa fa-times"></i></span></li>
                                        </ul>

                                    </div>
                                    <div class="meta">
                                        <strong ng-cloak>[[ f.name ]]</strong>
                                    </div>
                                </a>

                            </div>

                        </div>

                    </div>


                    <div id="footer" ng-style="{'width': width}"  ng-cloak>

                        <ul class="footer">

                            <li>
                                <button ngf-select ="show()" ng-show="showme"  ng-model="files" multiple  accept="image/*" type="button"
                                        class="btn btn-default btn-lg btn-pideo hidden-xs hidden-sm">
                                    <span class="fa  fa-camera fa-3x"></span> Selectionnez vos images
                                </button>
                            </li>

                            <li>
                                <button ng-hide="showme"  ngf-select ng-model="myFiles2" ngf-change="addFile(myFiles2)" accept="image/*" multiple type="button" class="btn btn-default btn-lg btn-pideo hidden-xs hidden-sm">
                                    <span class="fa  fa-plus fa-3x"></span> Ajoutez une image
                                </button>
                            </li>

                            <li>
                                <button ng-hide="showme"  ng-click="next()"  type="button" class="btn btn-default btn-lg btn-pideo hidden-xs hidden-sm">
                                    <span class="fa fa-arrow-right"></span> Suivant
                                </button>
                            </li>



                            <li>
                                <button type="button"  ngf-select ="show()" ng-show="showme"  ng-model="files" multiple  ngf-capture="'camera'" accept="image/*"
                                        class="btn-round green hidden-lg hidden-md">
                                    <div class="content">
                                        <span class="fa fa-camera"></span>
                                    </div>
                                </button>
                            </li>

                            <li>
                                <button type="button"   ng-hide="showme"  ngf-select ng-model="myFiles" ngf-change="addFile(myFiles)" accept="image/*" multiple = "multiple" class="btn-round orange hidden-lg hidden-md">
                                    <div class="content">
                                        <span class="fa fa-plus"></span>
                                    </div>
                                </button>
                            </li>

                            <li>
                                <button type="button" ng-hide="showme"  ng-click="next()"  class="btn-round blue hidden-lg hidden-md">
                                    <div class="content">
                                        <span class="fa fa-arrow-right"></span>
                                    </div>
                                </button>
                            </li>

                        </ul>



                    </div>


                </div>

                <div ng-style = "{ 'display' : style }" class=" page-content-wrap  slide" ng-repeat="file in files track by $index"  ng-cloak>

                    <div class="rang" ng-cloak> [[ $index + 1 ]] </div>
                    <div class="content-frame picRange">

                        <div class="content-frame-body">

                            <div class="gallery" id="links">

                                <a  class="gallery-item" style="width:100%" ngf-src= "file"   data-gallery>
                                    <div class="image fix-image" style="width: 100%; margin-top: -73px;margin: auto; text-align : center; cursor: auto;">
                                        <img ngf-src= "file" style="width: [[ large ]]; " resize-test ngf-no-object-url= true/>
                                    </div>
                                </a>

                            </div>

                        </div>
                    </div>

                    <div class="footerSlide">

                        <ul class="footer" ng-cloak>

                            <ng-audio-recorder id="audio[[ $index ]]" audio-model="recorded" show-player="false" on-record-complete = 'countAudioObj($index)' >

                                <div ng-if="recorder.isAvailable">

                                    <div ng-if="recorder.status.isDenied === true" style="color: red;">
                                        You need to grant permission for this application to USE your microphone.
                                    </div>

                                    <li>
                                        <button  type="button" class="btn btn-default btn-lg btn-pideo hidden-xs hidden-sm" ng-click="recorder.status.isRecording ? recorder.stopRecord() : recorder.startRecord()" type="button" ng-disabled="recorder.status.isDenied === true ">
                                            <span class="fa fa-microphone"></span> [[ recorder.status.isRecording ? 'Stop' : 'Enregistrez' ]]
                                        </button>
                                    </li>
                                    <li>

                                        <button type="button" class="btn btn-default btn-lg btn-pideo hidden-xs hidden-sm" ng-if="recorder.audioModel" ng-click="recorder.status.isPlaying ? recorder.playbackPause() : recorder.playbackResume()"
                                                ng-disabled="recorder.status.isRecording || !recorder.audioModel">
                                            [[ recorder.status.isStopped || recorder.status.isPaused ? 'Play' : 'Pause' ]]
                                        </button>

                                    </li>

                                    <li>
                                        <button  type="button" class=" [[ recorder.status.isRecording ? 'btn-round white hidden-lg hidden-md' : 'btn-round green hidden-lg hidden-md' ]]" ng-click="recorder.status.isRecording ? recorder.stopRecord() : recorder.startRecord()"   ng-disabled="recorder.status.isDenied === true ">
                                            <span  class="[[ recorder.status.isRecording ? 'fa fa-circle ctrlrecording ' : 'fa fa-microphone ctrlrecord' ]]"></span>
                                        </button>

                                    </li>

                                    <li>
                                        <button type="button" class="btn-round  hidden-lg hidden-md" ng-if="recorder.audioModel" ng-click="recorder.status.isPlaying ? recorder.playbackPause() : recorder.playbackResume()"
                                                ng-disabled="recorder.status.isRecording || !recorder.audioModel">
                                            <span  class="[[ recorder.status.isStopped || recorder.status.isPaused ? 'fa fa-play ctrlplay' : 'fa fa-pause ctrlplay' ]]"></span>

                                        </button>

                                    </li>


                                </div>

                                <div ng-if="!recorder.isAvailable">
                                    Your browser does not support this feature natively, please use latest version of <a
                                            href="https://www.google.com/chrome/browser" target="_blank">Google Chrome</a> or <a
                                            href="https://www.mozilla.org/en-US/firefox/new/" target="_blank">Mozilla Firefox</a>. If you're on
                                    Safari or Internet Explorer, you can install <a href="https://get.adobe.com/flashplayer/">Adobe Flash</a> to
                                    use this feature.
                                </div>

                            </ng-audio-recorder>


                        </ul>

                    </div>

                </div>

                <div ng-show = 'showGenerate' class=" page-content-wrap  slide " ng-class="ajust"  ng-cloak>

                    <div style="text-align: center;">

                        <div class="row" ng-if="youtube">
                            <div class="title">
                                <span class="fa fa-info-circle"></span> Succès !!
                                <div class="l" style="font-size: 14px;">
                                    Vous pouvez la partager avec le lien ci-dessous ou en cliquant sur l'icone <span class="glyphicon glyphicon-share-alt"></span> du lecteur
                                </div>
                            </div>
                        </div>

                        <div class="row width-fix" ng-if="youtube" style="margin: auto;">
                            <div class="video" >
                                <iframe width="560" height="315" ng-src="[[result]]" frameborder="0" allowfullscreen></iframe>
                            </div>
                        </div>

                        <div class="row" ng-if="youtube">
                            <div class="link">
                                <input type="text" class="youtube-link" ng-model = "youtubelink">
                            </div>
                        </div>



                        <div class="row loading" ng-if="loading">
                            <span class="fa fa-spin fa-spinner"></span> Generation en cours ...
                        </div>

                        <form name="form">

                            <div class="form-content" ng-if="formInfo">

                                <div class="row">
                                    <label class="pideo-form-title"> Entrez les informations relatives à la Piideo:</label>
                                </div>



                                @if(!$isConnected)
                                    <div class="row">
                                        <input required type="text"  class="[[ form.username.$dirty && form.username.$invalid ? 'invalid input' : 'input' ]]" name = "username" ng-model="username" placeholder="Pseudonyme...">
                      <span style="color:red" ng-show="form.username.$dirty && form.username.$invalid">
                      <span ng-show="form.username.$error.required">Le champ "Pseudonyme" est requis</span>
                      </span>
                                    </div>
                                @endif

                                <div class="row">
                                    <input  type="text" name="school"  class="[[ form.school.$dirty && form.school.$invalid ? 'invalid input' : 'input' ]]"   ng-model="school" placeholder="Votre Ecole..." required>
                      <span style="color:red" ng-show="form.school.$dirty && form.school.$invalid">
                      <span ng-show="form.school.$error.required">Le champ "Ecole" est requis</span>
                      </span>
                                </div>

                                <div class="row">
                                    <input required type="text" class="[[ form.subject.$dirty && form.subject.$invalid ? 'invalid input' : 'input' ]]" name = "subject" ng-model="subject" placeholder="Le thème/matière que traite la piideo...">

                        <span style="color:red" ng-show="form.subject.$dirty && form.subject.$invalid">
                      <span ng-show="form.subject.$error.required">Le champ "Categorie" est requis</span>
                      </span>
                                </div>

                                <div class="row">
                                    <input  required type="text" class="[[ form.title.$dirty && form.title.$invalid ? 'invalid input' : 'input' ]]" name = "title" ng-model="title" placeholder="Titre...">
                      <span style="color:red" ng-show="form.title.$dirty && form.title.$invalid">
                      <span ng-show="form.title.$error.required">Le champ "Titre" est requis</span>
                      </span>
                                </div>



                            </div>

                            <div class="row"   ng-if="formInfo">

                                <button type="button"  ng-disabled = "form.$dirty && form.$invalid || form.$pristine" class="btn btn-info btn-pideo btn-lg hidden-xs hidden-sm" ng-click = "save()"> Generate piideo </button>

                                <button type="button"  ng-disabled = "form.$dirty && form.$invalid || form.$pristine" class="btn-round blue hidden-lg hidden-md" ng-click = "save()"> <span class="glyphicon glyphicon-cloud-upload ctrlpiideo"></span> </button>

                            </div>

                        </form>

                        <!-- END PAGE CONTENT -->
                    </div>
                    <!-- END PAGE CONTAINER -->





                </div>
            </div>
        </div>

        @endsection


        @section('script')

            <script type="text/javascript" src="js/plugins/jquery/jquery-ui.min.js"></script>

            <!-- START THIS PAGE PLUGINS-->
            <script type="text/javascript" src="{{asset('js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js')}}"></script>
            <script type="text/javascript" src="{{asset('js/plugins/scrolltotop/scrolltopcontrol.js')}}"></script>



            <script type="text/javascript" src="{{asset('js/plugins/blueimp/jquery.blueimp-gallery.min.js')}}"></script>
            <!-- END THIS PAGE PLUGINS-->

            <!-- START TEMPLATE -->
            <script type="text/javascript" src="{{asset('js/settings.js')}}"></script>

            <script type="text/javascript" src="{{asset('js/plugins.js')}}"></script>
            <script type="text/javascript" src="{{asset('js/actions.js')}}"></script>

            <script src="{{asset('js/jquery.backstretch.min.js')}}"></script>

            <script>
                // To attach Backstrech as the body's background
                $("body").backstretch("img/bg.jpg");
            </script>

            <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.4/angular.js"></script>
            <script src="{{asset('js/angular/ng-file-upload-shim.js')}}"></script> <!-- for no html5 browsers support -->
            <script src="{{asset('js/angular/ng-file-upload.js')}}"></script>

            <script src="{{asset('js/angular/jquery.fullPage.min.js')}}"></script>
            <script src="{{asset('js/angular/wavesurfer.min.js')}}"></script>
            <script src="{{asset('js/angular/angular-audio-recorder.min.js')}}"></script>


            <script src="{{asset('js/angular/uploadPicture.js')}}"></script>

@endsection

