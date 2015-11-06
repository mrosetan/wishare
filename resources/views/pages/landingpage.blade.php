@extends('master.master')
@section('title', 'Home')
@section('content')
<div class="lp-content-logo"><img src="img/logo.png"></div>

<div class="lp-content-container">
  <div class="row">
    <!-- <button type="button" class="btn btn-default btn-lg button-fb">Connect with Facebook</button> -->
    <a class="btn btn-info btn-lg btn-block button-fb" href="{!! action('AuthController@redirectToProvider') !!}">Connect with Facebook</a>
  </div>
  <br />
  <div class="row">
  	<!-- <button type="button" class="btn btn-info btn-lg btn-signin" href="{{ URL::to('pages/signin')}}">Sign In</button> -->
  	<a class="btn btn-info btn-lg btn-signin" href="{{ URL::to('signin')}}">Sign In</a>
  </div>
  <br />
  <div class="row">
    <!-- <button type="button" class="btn btn-info btn-lg btn-signup" href="{{ URL::to('pages/signup')}}">Sign Up</button> -->
    <a type="button" class="btn btn-info btn-lg btn-signup" href="{{ URL::to('signup')}}">Sign Up</a>
  </div>
</div>

@stop
