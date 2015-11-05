@extends('master.master')
@section('title', 'Sign In')
@section('content')
<div class="signin-content-logo"><img src="img/logo.png"></div>

<div class="signin-content-container">

  @if(Session::has('flash_message'))
    <div class="alert alert-danger">
      {{ Session::get('flash_message') }}
    </div>
  @endif

  {!! Form::open(array(
                'class' => 'form', 'action' => array('AuthController@signin'))) !!}
    <div class="row">
      {!! Form::email('email', null,
                      array('required',
                      'required','class'=>'form-control',
                      'placeholder'=>'E-mail')) !!}
    </div>
    <br />
    <div class="row">
      {!! Form::password('password',
                        array('required',
                        'class'=>'form-control',
                        'placeholder'=>'Password')) !!}
    </div>
    <br />
    <div class="row">
      {!! Form::submit('Sign In',
                      array('class'=>'btn btn-info btn-lg btn-block btn-signin')) !!}
    </div>
  {!! Form::close() !!}


</div>
@stop
