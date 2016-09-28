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
    <li class="xn-icon-button pull-right" id="counter1">
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
    <!-- TASKS -->
    <li class="xn-icon-button pull-right">
        <a href="#"><span class="fa fa-bell"></span></a>
        <div class="informer informer-warning"></div>
        <div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
            <div class="panel-heading">
                <h3 class="panel-title"><span class="fa fa-bell"></span> Notifications</h3>
                <div class="pull-right">

                </div>
            </div>
            <div class="panel-body list-group scroll" style="height: 200px;">

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