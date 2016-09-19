<ul class="x-navigation x-navigation-horizontal x-navigation-panel">
    <!-- TOGGLE NAVIGATION -->
    <li class="xn-icon-button">
        <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
    </li>
    <!-- END TOGGLE NAVIGATION -->
    <!-- SEARCH -->
    <li class="xn-search">
        <form role="form">
            <input type="text" name="search" placeholder="Search..."/>
        </form>
    </li>
    <!-- END SEARCH -->
    <!-- SIGN OUT -->
    <li class="xn-icon-button pull-right">
        <a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span></a>
    </li>
    <!-- END SIGN OUT -->
    <!-- MESSAGES -->
    <li class="xn-icon-button pull-right">
        <a href="#"><span class="fa fa-comments"></span></a>
        @if($counter != 0)
        <div class="informer informer-danger">{{ $counter }}</div>
        @endif

        <div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
            <div class="panel-heading">
                <h3 class="panel-title"><span class="fa fa-comments"></span> Messages</h3>
                <div class="pull-right">
                    @if($counter != 0)
                    <span class="label label-danger">{{ $counter }} new</span>
                    @endif
                </div>
            </div>
            <div class="panel-body list-group list-group-contacts scroll" style="height: 200px;">

                @foreach($conversations as $conversation)
                    <a href="/messages/?conversation={{$conversation->name}}" class="list-group-item">
                        <div class="list-group-status status-online"></div>
                        <img src="{{ $conversation->users->first()->image_path }}" class="pull-left" alt="{{ $conversation->users->first()->firstname }} {{ $conversation->users->first()->lastname }}"/>
                        <span class="contacts-title">{{ $conversation->users->first()->firstname }} {{ $conversation->users->first()->lastname }}</span>

                        <p>{{ Str::words($conversation->messages->last()->body, 5) }}
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
    <!-- TASKS -->
    <li class="xn-icon-button pull-right">
        <a href="#"><span class="fa fa-bell"></span></a>
        <div class="informer informer-warning">3</div>
        <div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
            <div class="panel-heading">
                <h3 class="panel-title"><span class="fa fa-tasks"></span> Tasks</h3>
                <div class="pull-right">
                    <span class="label label-warning">3 active</span>
                </div>
            </div>
            <div class="panel-body list-group scroll" style="height: 200px;">
                <a class="list-group-item" href="#">
                    <strong>Phasellus augue arcu, elementum</strong>
                    <div class="progress progress-small progress-striped active">
                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;">50%</div>
                    </div>
                    <small class="text-muted">John Doe, 25 Sep 2014 / 50%</small>
                </a>
                <a class="list-group-item" href="#">
                    <strong>Aenean ac cursus</strong>
                    <div class="progress progress-small progress-striped active">
                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;">80%</div>
                    </div>
                    <small class="text-muted">Dmitry Ivaniuk, 24 Sep 2014 / 80%</small>
                </a>
                <a class="list-group-item" href="#">
                    <strong>Lorem ipsum dolor</strong>
                    <div class="progress progress-small progress-striped active">
                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 95%;">95%</div>
                    </div>
                    <small class="text-muted">John Doe, 23 Sep 2014 / 95%</small>
                </a>
                <a class="list-group-item" href="#">
                    <strong>Cras suscipit ac quam at tincidunt.</strong>
                    <div class="progress progress-small">
                        <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">100%</div>
                    </div>
                    <small class="text-muted">John Doe, 21 Sep 2014 /</small><small class="text-success"> Done</small>
                </a>
            </div>
            <div class="panel-footer text-center">
                <a href= {{ URL::to('notifications') }} >Show all tasks</a>
            </div>
        </div>
    </li>
    <!-- END TASKS -->
</ul>

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