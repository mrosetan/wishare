@extends('master.master')
@section('title', 'Connect with Facebook Error')
@section('content')
<div class="signin-content-logo"><a href="{{ URL::to('/')}}"><img src="img/logo.png"></a></div>

<div class="signin-content-container">

  <div class="row">
    <div class="col-md-12">
      <div class="terms-of-use alert alert-danger">
        <p>Your attempt to login/signup to wishare through Facebook has failed.</p>
        <p>Please make sure that you allow wishare to access your email.</p>
      </div>
    </div>
  </div>
  <hr />
  <div class="row">
    <div class="col-md-12">
      <div class="terms-of-use">Don't have an account? <a href="{{ URL::to('signup')}}">Sign Up Here</a></div>
    </div>
  </div>

</div>
@stop
