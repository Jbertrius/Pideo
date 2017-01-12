<!-- START X-NAVIGATION VERTICAL -->
<ul class="x-navigation x-navigation-horizontal x-navigation-panel" id="head">
    <!-- TOGGLE NAVIGATION -->
    <li class="xn-logo  hidden-xs " >
        <a  style = "padding-top: 4px;" href = {{ URL::to('/') }} ><img src="{{asset('img/logo2.png')}}"></a>
    </li>
    <li class="xn-logo hidden-lg hidden-md hidden-sm" >
        <a  style = "padding-top: 0px;" href = {{ URL::to('/') }} ><img src="{{asset('img/mini-logo.png')}}"></a>
    </li>
    <!-- END TOGGLE NAVIGATION -->
    <!-- SEARCH -->
    <li class="xn-search">
        <form role="form">
            <input type="text" name="search" placeholder="Search..."/>
        </form>
    </li>

    <li>
        <button type="button" class="btn btn-primary xn-btn-search" style="margin-left: -6px;">Go</button>
    </li>

    <!-- END SEARCH -->
    <!-- SIGN OUT -->
    @if($isConnected)
    <li class = "xn-avatar pull-right dropdown">
        <a href="#" class="dropdown-toggle avatar" data-toggle="dropdown" aria-expanded="false" >
           <img src="{!! $profilePic !!}" alt="{!!$firstname!!}  {!!$lastname!!}"/>
        </a>

        <ul class="dropdown-menu">
            <li>
                <a href= {{ URL::to('home') }}><span class="fa fa-upload"></span> Post a problem</a>
            </li>

            <li>
                <a  href= {{ URL::to('map') }}><span class="glyphicon glyphicon-map-marker"></span> Find a tutor</a>
            </li>

            <li>
                <a href= {{ URL::to('myrequest') }} ><span class="fa fa-share-square"></span> My requests</a>
            </li>

            <li class="separator">
                <hr>
            </li>

            <li>
                <a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span>  Logout</a>
            </li>
        </ul>
    </li>

        <!-- END SIGN OUT -->
        <!-- MESSAGES -->
        <li class="xn-icon-button pull-right messages" id="counter1">
            <a href="#"><span class="fa fa-comments"></span></a>
            @if($counter != 0)
                <div class="informer informer-danger" >{{ $counter }}</div>
            @endif

            <div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
                <div class="panel-heading">
                    <h3 class="panel-title"><span class="fa fa-comments"></span> Messages</h3>
                    <div class="pull-right" id="counter2">
                        @if($counter != 0)
                            <span class="label label-danger">{{ $counter }} new</span>
                        @endif
                    </div>
                </div>
                <div class="panel-body list-group list-group-contacts scroll" id="msgNotif" style="height: 200px;">

                    @foreach($conversations as $conversation)
                        <a href="/messages/?conversation={{$conversation->name}}" id = "{{ $conversation->id }}" class="list-group-item">
                            <div class="list-group-status status-online"></div>
                            <img src="{{ $conversation->users->first()->image_path }}" class="pull-left" alt="{{ $conversation->users->first()->firstname }} {{ $conversation->users->first()->lastname }}"/>
                            <span class="contacts-title">{{ $conversation->users->first()->firstname }} {{ $conversation->users->first()->lastname }}</span>

                            <p>

                                <?php $last = $conversation->messages->last();?>

                                @if( $last->type == 'text')
                                    {{ Str::words($last->body, 5) }}
                                @elseif($last->type == 'pideo')
                                    Pideo : {{ \App\Models\Pideo::where('id', '=', $last->body)->firstOrFail()->title }}
                                @else
                                    {{ \App\Models\Fileentry::where('id', '=', $last->body)->firstOrFail()->original_filename }}
                                @endif


                                @if($conversation->messagesNotifications()->count() != 0)
                                    <span class="label label-danger">{{ $conversation->messagesNotifications()->count() }}</span>
                                @endif
                            </p>
                        </a>
                    @endforeach

                </div>
                <div class="panel-footer text-center">
                    <a href= {{ URL::to('messages') }} >Show all messages</a>
                </div>
            </div>
        </li>
        <!-- END MESSAGES -->
        <?php
        $posts = Auth::user()->postNotification();
        $postCounter = 0;

        foreach($posts as $post)
        {
            if($post->read == 0)
                $postCounter++;
        }

        ?>
                <!-- TASKS -->
        <li class="xn-icon-button pull-right tasks" id="post_counter1">
            <a href="#"><span class="fa fa-exclamation-circle"></span></a>

            @if($postCounter != 0)
                <div class="informer informer-warning" >{{ $postCounter }}</div>
            @endif

            <div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
                <div class="panel-heading">
                    <h3 class="panel-title"><span class="fa fa-exclamation-circle"></span>  Requests</h3>
                    <div class="pull-right">
                        @if($postCounter != 0)
                            <div class="label label-warning" >{{ $postCounter }} new</div>
                        @endif
                    </div>
                </div>
                <div class="panel-body list-group scroll" id="postNotif" style="height: 200px;">
                    @foreach($posts as $post)

                        <a class="list-group-item" href="/request/{{$post->post->id}}" @if($post->read == 0) style="background-color: #f5f5f5;" @endif>
                            <strong>{{ $post->post->description }}</strong>
                            <br>
                            <span class="label label-success">{{ $post->cat->subjects }}</span>
                            <p>
                                <small class="text-muted">{{ $post->post->users->fullname() }}, {{ $post->post->created_at}} </small>
                            </p>
                        </a>
                    @endforeach
                </div>
                <div class="panel-footer text-center">
                    <a href= {{ URL::to('request') }} >Show all requests</a>
                </div>
            </div>
        </li>
        <!-- END TASKS -->

    @else

    <div class="navbar-button">

        <li  class="xn-btn-piideo hidden-md hidden-xs hidden-sm pull-right"  ng-cloak >
                <button type="submit" onClick="location.href = '{{ URL::to('login') }}'" class="btn btn-success xn-btn-search">Connexion
                </button>
        </li>

        <li  class="xn-btn-piideo hidden-md hidden-xs hidden-sm pull-right"  ng-cloak >
                <button type="button" onClick="location.href = '{{ URL::to('register') }}'"   class="btn btn-info xn-btn-search">Inscription
                </button>
        </li>

    </div>
    @endif

    <li  class="xn-btn-piideo hidden-md hidden-xs hidden-sm pull-right"  ng-cloak ng-if = 'false'>
        <button type="button" class="btn btn-success xn-btn-search">Mettre en ligne
        </button>
    </li>



</ul>
<!-- END X-NAVIGATION VERTICAL -->

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
                    <a href= "{{ URL::to('auth/logout') }}" class="btn btn-success btn-lg">Yes</a>
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