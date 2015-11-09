@extends('userlayouts-master.user-master')
@section('title', 'Change Password')

@section('content')
<div class="page-content-wrap">
  <div class="row">
    <div class="settings-container">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4>Change Password</h4>
          @if(session('passwordStatus'))
            <div class="alert alert-success">
                {{ session('passwordStatus') }}
            </div>
          @endif
          @if(session('passwordError'))
            <div class="alert alert-danger">
                {{ session('passwordError') }}
            </div>
          @endif
          @foreach($errors->all() as $error)
              <p class="alert alert-danger"> {{ $error }}</p>
          @endforeach
          {!! Form::open(array(
                        'action' => array('UserController@changeAccountPassword'),
                        'class' => 'form')) !!}
          <div class="row">
            <div class="col-md-12">
              {!! Form::password('oldpassword', array('required', 'class'=>'form-control', 'placeholder'=>'Current Password')) !!}
            </div>
          </div>
          <br />
          <div class="row">
            <div class="col-md-12">
              {!! Form::password('password', array('required', 'class'=>'form-control', 'placeholder'=>'New Password')) !!}
            </div>
          </div>
          <br />
          <div class="row">
            <div class="col-md-12">
                {!! Form::password('password_confirmation', array('class'=>'form-control', 'placeholder'=>'Confirm New Password')) !!}
            </div>
          </div>
          <hr />
          <div class="row">
            <div class="col-md-12">
              <div class="pull-right">
                {!! Form::submit('Save', array('class'=>'btn btn-info btn-settings')) !!}
              </div>
            </div>
          </div>
          {!! Form::close()!!}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
