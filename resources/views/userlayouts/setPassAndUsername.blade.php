@extends('master.master')
@section('title', 'Account Setup')
@section('content')

<div class="reg-content-header">Account Setup</div>
<div class="reg-content-container">

  @foreach($errors->all() as $error)
      <p class="alert alert-danger"> {{ $error }}</p>
  @endforeach

  {!! Form::open(array(
                'action' => 'UserController@updateToSetPassword',
                'class' => 'form')) !!}

  <div class="form-group">

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
        {!! Form::password('password_confirmation',
                          array('required',
                          'class'=>'form-control',
                          'placeholder'=>'Confirm Password')) !!}
      </div>
    </div>

    <br />

    <div class="row">
      <div class="col-md-12">
        {!! Form::submit('Save',
                        array('class'=>'btn btn-info btn-lg btn-block btn-signup')) !!}
      </div>
    </div>
  </div>
  {!! Form::close() !!}

</div>
@stop
