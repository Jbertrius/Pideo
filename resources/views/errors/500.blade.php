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
        <div class="error-code">500</div>
        <div class="error-text">Internal server error</div>
        <div class="error-subtext">The server encountered an internal error or misconfiguration and was unable to complete your request.</div>
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