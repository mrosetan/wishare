@extends('master.master')
@section('title', 'Sign In')
@section('content')
<div class="signin-content-logo"><img src="img/logo.png"></div>

<div class="signin-content-container">
  <div class="row">
    {!! Form::email('email', null, ['class'=>'form-control', 'placeholder'=>'E-mail']) !!}
  </div>
  <br />
  <div class="row">
  	{!! Form::password('password', ['class'=>'form-control', 'placeholder'=>'Password']) !!}
  </div>
  <br />
  <div class="row">
    <button type="button" class="btn btn-info btn-lg btn-signin" href="#">Sign In</button>
  </div>
</div>
@stop
