@extends('master.master')
@section('title', 'Registration')
@section('content')

<div class="reg-content-header">Create an Account</div>
<div class="reg-content-container">

  @foreach($errors->all() as $error)
      <p class="alert alert-danger"> {{ $error }}</p>
  @endforeach

  {!! Form::open(array(
                'action' => 'UserController@store',
                'class' => 'form')) !!}

  <div class="form-group">
    <div class="row">
      <div class="col-md-12">
        {!! Form::text('lastname', null,
                      array('required',
                      'class'=>'form-control',
                      'placeholder'=>'Last Name')) !!}
      </div>
    </div>
    <br />
    <div class="row">
      <div class="col-md-12">
        {!! Form::text('firstname', null,
                      array('required',
                      'class'=>'form-control',
                      'placeholder'=>'First Name')) !!}
      </div>
    </div>
    <br />
    <div class="row">
      <div class="col-md-12">
        {!! Form::text('username', null,
                      array('required',
                      'class'=>'form-control',
                      'placeholder'=>'Username')) !!}
      </div>
    </div>
    <br />
    <div class="row">
      <div class="col-md-12">
        {!! Form::password('password',
                          array('required',
                          'class'=>'form-control',
                          'placeholder'=>'Password')) !!}
      </div>
    </div>
    <br />
    <div class="row">
      <div class="col-md-12">
        {!! Form::email('email', null,
                        array(
                        'required','class'=>'form-control',
                        'placeholder'=>'E-mail')) !!}
      </div>
    </div>
    <br />
    <div class="row">
      <div class="col-md-12">
        {!! Form::submit('Sign Up',
                        array('class'=>'btn btn-info btn-lg btn-block btn-signup')) !!}
      </div>
    </div>
    <br />
    <div class="row">
      <div class="col-md-12">
        <div class="terms-of-use">By signing up, you agree to Wishare's <a href="#">Terms of Use and Privacy</a></div>
      </div>
    </div>
  </div>
  {!! Form::close() !!}
</div>
@stop
