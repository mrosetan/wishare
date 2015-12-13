@extends('master.master')
@section('title', 'Account Reactivation')
@section('content')
<div class="signin-content-logo"><a href="{{ URL::to('/')}}"><img src="img/logo.png"></a></div>



<div class="signin-content-container">

  @if(Session::has('flash_message'))
    <div class="alert alert-danger">
      {{ Session::get('flash_message') }}
    </div>
  @endif

  <div class="row">
    <div class="col-md-12">
      <div class="terms-of-use">Would you like to reactivate your account? Send
        an email to appwishare@gmail.com with the subject Reactivate Wishare Account.</a></div>
    </div>
  </div>

  <br />
  <hr />
  <div class="row">
    <div class="col-md-12">
      <div class="terms-of-use">Don't have an account? <a href="{{ URL::to('signup')}}">Sign Up Here</a></div>
    </div>
  </div>

</div>
@stop
