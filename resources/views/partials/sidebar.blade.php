<div class="page-sidebar" xmlns="http://www.w3.org/1999/html">
    <!-- START X-NAVIGATION -->
    <ul class="x-navigation">
        <li class="xn-logo">
            <a href= {{ URL::to('/') }} ><img src="{{asset('img/logo2.png')}}" style="margin-top: -10px;"></a>
            <a href="#" class="x-navigation-control"></a>
        </li>
        <li class="xn-profile">
            <a href="#" class="profile-mini">
                <img src="{!! $profilePic !!}" alt="{!!$firstname!!}  {!!$lastname!!}"/>
            </a>
            <div class="profile">
                <div class="profile-image">
                    <img src="{!! $profilePic !!}"   alt="{!!$firstname!!}  {!!$lastname!!}"/>

                    <a class="edit-group" href="#">
                    <div class="edit-back" ></div>
                        <span class="fa fa-camera edit"></span>
                    <div class="edit-banner">Edit picture</div>
                    </a>

                </div>

                <div class="profile-data">
                    <div class="profile-data-name"><b>{!!$firstname!!}  {!!$lastname!!}</b></div>
                    <div class="profile-data-title"></div>
                </div>
                <div class="profile-controls">
                    <a href= {{ URL::to('profile') }} class="profile-control-left"><span class="fa fa-info"></span></a>
                    <a href= {{ URL::to('messages') }} class="profile-control-right"><span class="fa fa-envelope"></span></a>
                </div>
            </div>
        </li>

        <li @if( isset($page) && ($page == 'Map')) class="active" @endif>
            <a href= {{ URL::to('home') }} ><span class="fa fa-map-marker"></span> <span class="xn-text">Map</span></a>
        </li>


        <li @if( isset($page)&& $page == 'MakePideo') class="active" @endif>
            <a href= {{ URL::to('makepideo') }} ><span class="fa fa-film"></span> <span class="xn-text">Make a Pideo</span></a>
        </li>
    </ul>
    <input type="file" class="pp" >
    <!-- END X-NAVIGATION -->
</div>
