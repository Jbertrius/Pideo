@extends('layouts.master')

@section('title')
    {{ trans('front/site.title') }}
@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('css/normalize.css')}}">
    <link rel="stylesheet" type="text/css" id="theme" href="{{asset('css/theme-blue.css')}}"/>
@endsection


@section('contenu')
<div class="error-container">
    <div class="error-code">404</div>
    <div class="error-text">page not found</div>
    <div class="error-subtext">Unfortunately we're having trouble loading the page you are looking for. Please wait a moment and try again or use action below.</div>
    <div class="error-actions">
        <div class="row">
            <div class="col-md-6">
                <button class="btn btn-info btn-block btn-lg" onClick="document.location.href = '/';">Back to Home</button>
            </div>
            <div class="col-md-6">
                <button class="btn btn-primary btn-block btn-lg" onClick="history.back();">Previous page</button>
            </div>
        </div>
    </div>
</div>
@endsection