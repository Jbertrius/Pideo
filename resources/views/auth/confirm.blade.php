@extends('layouts.secondmaster')

@section('title')
    {{ trans('front/site.confirm') }}
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
								<a href="https://www.facebook.com/pideomewebsite"><i class="fa fa-facebook"></i></a>
								<a href="#"><i class="fa fa-twitter"></i></a>
								<a href="#"><i class="fa fa-envelope"></i></a>

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
                        <h1><strong> {!! trans('front/login.confirm') !!}</strong> </h1>
                        <div class="description">

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-body">
                              {!! session('ok')   !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection



@section('script')
    <script src="{{asset('js/jquery.backstretch.min.js')}}"></script>
    <script src="{{asset('js/maps.js')}}"></script>
    <script src="{{asset('js/retina-1.1.0.min.js')}}"></script>
    <script src="{{asset('js/scripts.js')}}"></script>
    <script src="{{asset('js/bootstrap-select.min.js')}}"></script>
@endsection