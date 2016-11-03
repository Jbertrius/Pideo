@extends('layouts.master')

@section('title')
    {{ trans('front/site.register') }}
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
                <a class="navbar-brand" href="/">Pideo</a>
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
                        <h1><strong> {!! trans('front/site.registerTitle') !!}</strong> </h1>
                        <div class="description">
                            <p>
                            @if ($errors->has('email') || $errors->has('firstname') || $errors->has('lastname') || $errors->has('password')  || $errors->has('number')  || $errors->has('lat')  || $errors->has('city')  || $errors->has('sub1') || $errors->has('sub2'))
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>{{ $errors->first('email') }}</strong>
                                <strong>{{ $errors->first('firstname') }}</strong>
                                <strong>{{ $errors->first('lastname') }}</strong>
                                <strong>{{ $errors->first('password') }}</strong>
                                <strong>{{ $errors->first('number') }}</strong>
                                <strong>{{ ($errors->has('lat'))?'Location is not define':'' }}</strong>
                                <strong>{{ $errors->first('city') }}</strong>
                                <strong>{{ ($errors->has('sub1'))?'You must choose 2 subjects':'' }}</strong>
                                <strong>{{ ($errors->has('sub2'))?'You must choose 2 subjects':'' }}</strong>
                            </div>
                            @endif
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3 form-box">

                        <form role="form" action="{!! url('register') !!}" accept-charset="UTF-8" method="post" class="registration-form">


                            <fieldset>
                                {!! csrf_field() !!}
                                    <div class="form-top">
                                        <div class="form-top-left">
                                            <h3>Step 1 / 3</h3>
                                            <p>Tell us who you are:</p>
                                        </div>
                                        <div class="form-top-right">
                                            <i class="fa fa-user"></i>
                                        </div>
                                    </div>
                                    <div class="form-bottom">
                                        <div class="form-group">
                                            <label class="sr-only" for="firstname">First name</label>
                                            <input type="text" name="firstname" placeholder="First name..." required="required" data-validation="alphanumeric" data-validation-allowing="-"
                                                   data-validation-error-msg="First name required" class="firstname form-control require" value="{{ old('firstname') }}" id="firstname">
                                        </div>

                                        <div class="form-group">
                                            <label class="sr-only" for="lastname">Last name</label>
                                            <input type="text" name="lastname" placeholder="Last name..." required="required" data-validation="alphanumeric"
                                                   data-validation-error-msg="Last name required" class="lastname form-control require" value="{{ old('lastname') }}" id="lastname" >
                                        </div>

                                        <div class="form-group">
                                            <label class="sr-only" for="email">Email</label>
                                            <input type="email" name="email" placeholder="Email..." required="required" data-validation="email"
                                                   data-validation-error-msg="Email required" class="email form-control require" value="{{ old('email') }}" id="email">
                                        </div>

                                        <div class="form-group">
                                            <label class="sr-only" for="number">Phone Number</label>
                                            <input type="text" name="number" placeholder="Phone Number..."  required="required" data-validation-error-msg="Number required"
                                                   class=" form-control require" value="{{ old('number') }}" id="number">
                                        </div>
 
                                         
                                        <button type="button" class="btn btn-next">Next</button>
                                         
                                    </div>
                                </fieldset>
                                
                                <fieldset>
                                    <div class="form-top">
                                        <div class="form-top-left">
                                            <h3>Step 2 / 3</h3>
                                            <p>Set up your account:</p>
                                        </div>
                                        <div class="form-top-right">
                                            <i class="fa fa-key"></i>
                                        </div>
                                    </div>
                                    <div class="form-bottom">

                                        <div class="form-group">
                                            <label class="sr-only" for="password">Password</label>
                                            <input type="password" name="password" data-validation="length" data-validation-length="min8"
                                                   placeholder="Password..." class="password form-control require" id="password">
                                        </div>

                                        <div class="form-group">
                                            <label class="sr-only" for="repeat-password">Repeat password</label>
                                            <input type="password" name="repeat-password" data-validation="confirmation" data-validation-confirm="password"
                                                   placeholder="Repeat password..."
                                            class="repeat-password form-control require" id="repeat-password">
                                        </div>

                                        <div class="form-group">
                                            <label class="sr-only" for="city">City</label>
                                            <input type="text" name="city" placeholder="City..." required="required"  data-validation-error-msg="City required"
                                                   class="city form-control require" id="city">
                                        </div>

                                        <div class="form-group pop"  data-content="Select your language" rel="popover" data-placement="right"   data-trigger="hover">
                                            <label class="sr-only" for="lang">Subject</label>
                                            <select  class="selectpicker form-control" name="lang" id="lang" >
                                                <option value="Français">Français</option>
                                                <option value="English">English</option>
                                            </select>
                                        </div>


                                        <div class="form-group pop" data-content="Select 2 subjects you master the most" rel="popover" data-placement="right"   data-trigger="hover">
                                        <label class="sr-only" for="form-subject">Subject</label>
                                        <select  class="selectpicker form-control" name="form-subject" id="select" multiple data-max-options="2"  dropupAuto="false" dropup>

                                            @foreach(\App\Models\Subject::all() as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->subjects }}</option>
                                            @endforeach


                                        </select>
                                        </div>

                                        <div id="newsub" class="form-group hidden input-group">
                                            <label class="sr-only" for="form-newsub">Enter new subject</label>
                                            <input type="text" name="form-newsub" placeholder="Enter new subject..." class="lastname form-control" value="{{ old('form-newsub') }}" id="form-newsub">
                                            <span class="input-group-btn">
                                            <button class="btn btn-secondary"  id="plus" type="button"><i class="glyphicon glyphicon-plus"></i></button>
                                          </span>
                                        </div>

                                         <div id="newsub2" class="form-group hidden input-group">
                                            <label class="sr-only" for="form-newsub2">Enter new subject</label>
                                            <input type="text" name="form-newsub2" placeholder="Enter another subject..." class="lastname form-control" value="{{ old('form-newsub2') }}" id="form-newsub2">
                                            <span class="input-group-btn">
                                            <button class="btn btn-secondary" id="moins" type="button"><i class="glyphicon glyphicon-minus"></i></button>
                                          </span>
                                        </div>

                                        <input type="text" id="sub1" name="sub1" class="hidden sub">
                                        <input type="text" id="sub2" name="sub2" class="hidden sub">

                                        <button type="button" class="btn btn-previous">Previous</button>
                                        <button type="button" id="next2" class="btn btn-next">Next</button>
                                    </div>
                                </fieldset>

                            <fieldset>
                                <div class="form-top">
                                    <div class="form-top-left">
                                        <h3>Step 3 / 3</h3>
                                        <p> Drag cursor
                                            <span class="fa fa-map-marker"></span> to where you live <br>
                                            Zoom in <span class="fa fa-plus-square"></span> to get your precise address

                                        </p>
                                    </div>
                                    <div class="form-top-right">
                                        <i class="fa fa-twitter"></i>
                                    </div>
                                </div>

                                <div class="form-bottom">


                                <div class="form-group row">

                                    <div class="form-group" id="map-canvas">
 
                                    </div>
                                </div>

                                            <input type="hidden" class="hidden" name="lat" id="lat" value="0" />
                                            <input type="hidden" class="hidden"  name="lng" id="lng" value="0" />

                                 <button type="button" class="btn btn-previous">Previous</button>
                                 <button  type="submit" class="btn">Sign me up!</button>
                                
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
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPqF6eRkqctYMhsqU5OEzDj1kweuNUfq0&libraries=places"></script>
    <script src="{{asset('js/jquery.backstretch.min.js')}}"></script>
    <script src="{{asset('js/maps.js')}}"></script>
    <script src="{{asset('js/retina-1.1.0.min.js')}}"></script>
    <script src="{{asset('js/scripts.js')}}"></script>
    <script src="{{asset('js/bootstrap-select.min.js')}}"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
    <script>
        $.validate({
            modules : 'html5',
            modules : 'security',
            onModulesLoaded : function() {
                var optionalConfig = {
                    fontSize: '12pt',
                    padding: '4px',
                    bad : 'Very bad',
                    weak : 'Weak',
                    good : 'Good',
                    strong : 'Strong'
                };

                $('input[name="password"]').displayPasswordStrength(optionalConfig);
            }
        });

        $('.pop').popover({
            container: 'body'
        });
    </script>

@endsection
