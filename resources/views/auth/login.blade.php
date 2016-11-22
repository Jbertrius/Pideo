@extends('layouts.secondmaster')

@section('title')
    {{ trans('front/site.login') }}
@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('css/normalize.css')}}">
    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css')}}">
    <!-- Animate.css -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/animate.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="{{asset('fonts/fontawesome/css/font-awesome.min.css')}}">
    <!-- Elegant Icons -->
    <link rel="stylesheet" type="text/css" href="{{asset('fonts/eleganticons/et-icons.css')}}">
    <!-- Main style -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/styleform.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('css/form-elements.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-select.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-checkbox.css')}}">



@endsection

@section('contenu')

    <nav class="navbar navbar-inverse navbar-no-bg" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-navbar-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="">Piideo</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="top-navbar-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
							<span class="li-text">

							</span>
                        <a href="#"><strong> </strong></a>
							<span class="li-text">

							</span>
							<span class="li-social">
								<a href="#"><i class="fa fa-facebook"></i></a>
								<a href="#"><i class="fa fa-twitter"></i></a>
								<a href="#"><i class="fa fa-envelope"></i></a>
								<a href="#"><i class="fa fa-skype"></i></a>
							</span>
                    </li>
                </ul>
            </div>
        </div>
    </nav>



    <div class="top-content">

        <div class="inner-bg">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 text">
                        <h1><strong> {!! trans('front/login.connection') !!}</strong> </h1>
                        <div class="description">
                            <p>
                                @if(session()->has('error'))
                                    @include('partials/error', ['type' => 'danger', 'message' => session('error')])
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3 form-box">

                        <form role="form" action="{!! url('login') !!}" accept-charset="UTF-8" method="post" class="registration-form">


                            <fieldset>
                                {!! csrf_field() !!}
                                <div class="form-top">
                                    <div class="form-top-left">
                                        <h3>Sign in</h3>
                                        <p> {!! trans('front/login.text') !!}</p>
                                    </div>
                                    <div class="form-top-right">
                                        <i class="fa fa-user"></i>
                                    </div>
                                </div>
                                <div class="form-bottom">


                                    <div class="form-group">
                                        <label class="sr-only" for="email">Email</label>
                                        <input type="email" name="log" placeholder="Email..." class="email form-control require {{ $errors->has('log') ? 'input-error' : '' }}" value="{{ old('email') }}" id="log">
                                    </div>

                                    <div class="form-group">
                                        <label class="sr-only" for="password">Password</label>
                                        <input type="password" name="password" placeholder="Password..." class="password form-control require {{ $errors->has('password') ? 'input-error' : '' }}" id="password">
                                    </div>

                                    <div class="form-group">
                                        <div class="checkbox checkbox-success">
                                            <input id="memory" class="styled" value="1" type="checkbox" name="memory">
                                            <label for="memory">
                                                Remember me
                                            </label>
                                        </div>
                                    </div>


                                    <div class="form-group text-center">
                                    <button  type="submit" class="btn">Sign in</button>
                                    </div>


                                </div>
                            </fieldset>


                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>





@endsection


@section('script')
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPqF6eRkqctYMhsqU5OEzDj1kweuNUfq0"></script>
    <script src="{{asset('js/jquery.backstretch.min.js')}}"></script>
    <script src="{{asset('js/maps.js')}}"></script>
    <script src="{{asset('js/retina-1.1.0.min.js')}}"></script>
    <script src="{{asset('js/scripts.js')}}"></script>
    <script src="{{asset('js/bootstrap-select.min.js')}}"></script>
@endsection
