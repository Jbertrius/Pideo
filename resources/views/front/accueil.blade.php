
@extends('layouts.master')

@section('title')
    {{ trans('front/site.title') }}
@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{'css/normalize.css'}}">
    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="{{'css/bootstrap.css'}}">
    <!-- Owl -->
    <link rel="stylesheet" type="text/css" href="{{'css/owl.css'}}">
    <!-- Animate.css -->
    <link rel="stylesheet" type="text/css" href="{{'css/animate.css'}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="{{'fonts/fontawesome/css/font-awesome.min.css'}}">
    <!-- Elegant Icons -->
    <link rel="stylesheet" type="text/css" href="{{'fonts/eleganticons/et-icons.css'}}">
    <!-- Main style -->
    <link rel="stylesheet" type="text/css" href="{{'css/cardio.css'}}">
@endsection

@section('contenu')
<div class="preloader">
		<img src="img/loader.gif" alt="Preloader image">
	</div>

	<nav class="navbar">
		<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand brand" href="#"><span>Pideo</span></a>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right main-nav">

					<li>{!! link_to('auth/register', trans('front/site.register'), ['class' => 'btn btn-blue']) !!}</li>
					<li><a href="#" data-toggle="modal" data-target="#modal1" class="btn btn-blue">Sign In</a></li>
					<li></li>
				</ul>
			</div>
			<!-- /.navbar-collapse -->
		</div>
		<!-- /.container-fluid -->
	</nav>











	<header id="intro">
		<div class="container">
			<div class="table">
				<div class="header-text">
					<div class="row">
						<div class="col-md-12 text-center">
							<h3 class="light white">Because everyone is good at something</h3>
							<h1 class="white typed">Help us Help you Help others...</h1>
							<span class="typed-cursor">|</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

	<section>
		<div class="cut cut-top"></div>
		<div class="container">
			<div class="row intro-tables">
				<div class="col-md-4">
					<div class="intro-table intro-table-first">
						<h5 class="white heading">Our Goal</h5>
                        <div class="owl-testimonials bottom">
                            <div class="item">
                                <h4 class="white heading light content">
                                    Provide instant and efficient solutions to students studying now
                                </h4>
                                <h5 class="white heading light author"> </h5>
                            </div>

                        </div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="intro-table intro-table-second">
						<h5 class="white heading">Our Vision</h5>
                        <div class="owl-testimonials bottom">
                            <div class="item">
                                <h4 class="white heading light content">
                                    A community of students and teachers linked to each others to provide solutions
                                    to every exercices
                                </h4>
                                <h5 class="white heading light author"> </h5>
                            </div>

                        </div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="intro-table intro-table-third">
						<h5 class="white heading">Our Mission</h5>
						<div class="owl-testimonials bottom">
							<div class="item">
								<h4 class="white heading light content">
                                    Attract the best experts in all subjets to make even the weakest students brillants
                                </h4>
								<h5 class="white heading light author"> </h5>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section id="services" class="section section-padded">
		<div class="container">
			<div class="row text-center title">
				<h2>Services</h2>
				<h4 class="light muted">Achieve the best results with our wide variety of training options!</h4>
			</div>
			<div class="row services">
				<div class="col-md-4">
					<div class="service">
						<div class="icon-holder">
							<img src="img/icons/heart-blue.png" alt="" class="icon">
						</div>
						<h4 class="heading">Maps</h4>
						<p class="description">
                            Find an expert in any city by searching a subject and the city
                        </p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="service">
						<div class="icon-holder">
							<img src="img/icons/guru-blue.png" alt="" class="icon">
						</div>
						<h4 class="heading">Video Streaming and Making</h4>
						<p class="description">
                            Combine images of your solution and an
                            audio explanation to form a short video
                            you can send to anyone
                        </p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="service">
						<div class="icon-holder">
							<img src="img/icons/weight-blue.png" alt="" class="icon">
						</div>
						<h4 class="heading">Messages</h4>
						<p class="description">
                            Text and Chat with your contacts on varying
                            subject matters
                        </p>
					</div>
				</div>
			</div>
		</div>
		<div class="cut cut-bottom"></div>
	</section>






	<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content modal-popup">
				<a href="#" class="close-link"><i class="icon_close_alt2"></i></a>
				<h3 class="white">Sign In</h3>

				{!! Form::open(['url' => 'auth/login', 'method' => 'post', 'role' => 'form', 'class' => 'popup-form']) !!}



                {!! Form::email('log', '', ['class' => 'form-control form-white', 'placeholder' => 'Email', 'id' => 'email']) !!}
                {!! $errors->first('email', '<small class="help-block">:message</small>') !!}

                {!! Form::password('password', ['class' => 'form-control form-white', 'placeholder' => 'Password', 'id' => 'pwd']) !!}
                {!! $errors->first('password', '<small class="help-block">:message</small>') !!}



					<div class="checkbox-holder text-left">
                        {!! Form::check('memory', 'Remember me') !!}
					</div>
                {!! Form::button('Submit', ['type' => 'submit', 'class' => 'btn btn-submit']) !!}


				{!! Form::close() !!}
			</div>
		</div>
	</div>

	<footer>
		<div class="container">
			<div class="row">
				<div class="col-sm-6 text-center-mobile">
					<h3 class="white">Join the Family Of Champions</h3>
					<h5 class="light regular light-white">If it's an exercise, then the solution is with us</h5>

					{!! link_to('auth/register', trans('front/site.register'), ['class' => 'btn btn-blue ripple trial-button']) !!}
				</div>
				<div class="col-sm-6 text-center-mobile">
					<h3 class="white"> </h3>
					<div class="row opening-hours">
						<div class="col-sm-6 text-center-mobile">
							<h5 class="light-white light"></h5>
							<h3 class="regular white"> </h3>
						</div>
						<div class="col-sm-6 text-center-mobile">
							<h5 class="light-white light"> Language</h5>

						<li class="dropdown">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#"><img width="32" height="32" alt="{{ session('locale') }}"  src="{!! asset('img/flag/' . session('locale') . '-flag.png') !!}" />&nbsp; <b class="caret"></b></a>
							<ul class="dropdown-menu">
							@foreach ( config('app.languages') as $user)
								@if($user !== config('app.locale'))
									<li><a href="{!! url('language') !!}/{{ $user }}"><img width="32" height="32" alt="{{ $user }}" src="{!! asset('img/flag/' . $user . '-flag.png') !!}"></a></li>
								@endif
							@endforeach
							</ul>
						</li>

							<h3 class="regular white"> </h3>
						</div>
					</div>
				</div>
			</div>
			<div class="row bottom-footer text-center-mobile">

				<div class="col-sm-8">
					<p>&copy; 2015 All Rights Reserved. Powered by <a href="http://www.phir.co/">Jbertrius</a> exclusively for <a href="http://tympanus.net/codrops/">Pideo</a></p>
				</div>

				<div class="col-sm-4 text-right text-center-mobile">

					<ul class="social-footer">
						<li><a href="http://www.facebook.com/pages/Codrops/159107397912"><i class="fa fa-facebook"></i></a></li>
						<li><a href="http://www.twitter.com/codrops"><i class="fa fa-twitter"></i></a></li>
						<li><a href="https://plus.google.com/101095823814290637419"><i class="fa fa-google-plus"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
	</footer>
	<!-- Holder for mobile navigation -->
	<div class="mobile-nav">
		<ul>
		</ul>
		<a href="#" class="close-link"><i class="arrow_up"></i></a>
	</div>

@endsection


@section('script')
    <script src="{{'js/owl.carousel.min.js'}}"></script>
    <script src="{{'js/wow.min.js'}}"></script>
    <script src="{{'js/typewriter.js'}}"></script>
    <script src="{{'js/jquery.onepagenav.js'}}"></script>
    <script src="{{'js/main.js'}}"></script>
@endsection
