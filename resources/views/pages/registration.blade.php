@extends('master.master')
@section('title', 'Registration')
@section('content')
<!--
<div class="reg-header">
  <div class="row">
    <div class="col-md-6">
      <button type="button" class="btn btn-info btn-lg btn-signin" href="#">Sign In</button>
    </div>
    <div class="col-md-6">
      <button type="button" class="btn btn-info btn-lg btn-signin" href="#">Sign Up</button>
    </div>
  </div>
</div>
-->
<div class="reg-content-header">Create an Account</div>
<div class="reg-content-container">
  <div class="form-group">
    <div class="row">
      <div class="col-md-12">
        {!! Form::text('lastname', null, ['class'=>'form-control', 'placeholder'=>'Last Name']) !!}
      </div>
    </div>
    <br />
    <div class="row">
      <div class="col-md-12">
        {!! Form::text('firstname', null, ['class'=>'form-control', 'placeholder'=>'First Name']) !!}
      </div>
    </div>
    <br />
    <div class="row">
      <div class="col-md-12">
        {!! Form::text('username', null, ['class'=>'form-control', 'placeholder'=>'Username']) !!}
      </div>
    </div>
    <br />
    <div class="row">
      <div class="col-md-12">
        {!! Form::password('password', ['class'=>'form-control', 'placeholder'=>'Password']) !!}
      </div>
    </div>
    <br />
    <div class="row">
      <div class="col-md-12">
        {!! Form::email('email', null, ['class'=>'form-control', 'placeholder'=>'E-mail']) !!}
      </div>
    </div>
    <br />
    <div class="row">
      <div class="col-md-12">
        {!! Form::button('Sign Up', array('class'=>'btn btn-info btn-lg btn-signup')) !!}
      </div>
    </div>
    <br />
    <div class="row">
      <div class="col-md-12">
        <div class="terms-of-use">By signing up, you agree to Wishare's <a href="#">Terms of Use and Privacy</a></div>
      </div>
    </div>
  </div>
</div>
@stop
