@extends('master.master')
@section('title', 'Sign In')
@section('content')
<div class="signin-content-logo"><a href="{{ URL::to('/')}}"><img src="img/logo.png"></a></div>



<div class="signin-content-container">
  <div class="row">
    <!-- <button type="button" class="btn btn-default btn-lg button-fb">Connect with Facebook</button> -->
    <a class="btn btn-info btn-lg btn-block button-fb" href="{!! action('AuthController@redirectToProvider') !!}">Connect with Facebook</a>
  </div>
  <br />
  <hr />
  @foreach($errors->all() as $error)
      <p class="alert alert-danger"> {{ $error }}</p>
  @endforeach

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
  <br />
  <hr />
  <div class="row">
    <div class="col-md-12">
      <div class="terms-of-use">Don't have an account? <a href="{{ URL::to('signup')}}">Sign Up Here</a></div>
    </div>
  </div>

</div>
@stop
