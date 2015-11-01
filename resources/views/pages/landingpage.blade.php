@extends('master.master')
@section('title', 'Home')
@section('content')
<div class="lp-content-logo"><img src="img/logo.png"></div>

<div class="lp-content-container">
  <div class="row">
    <button type="button" class="btn btn-default btn-lg button-fb">Connect with Facebook</button>
  </div>
  <br />
  <div class="row">
  	<button type="button" class="btn btn-info btn-lg btn-signin" href="#">Sign In</button>
  </div>
  <br />
  <div class="row">
    <button type="button" class="btn btn-info btn-lg btn-signup" href="#">Sign Up</button>
  </div>
</div>
@stop
