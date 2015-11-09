@extends('userlayouts-master.user-master')
@section('title', 'Change Password')

@section('content')
<div class="page-content-wrap">
  <div class="row">
    <div class="settings-container">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4>Set Password</h4>

          @foreach($errors->all() as $error)
              <p class="alert alert-danger"> {{ $error }}</p>
          @endforeach

          {!! Form::open(array(
                        'action' => array('UserController@updateToSetPassword'),
                        'class' => 'form')) !!}
          <div class="row">
            <div class="col-md-12">
              {!! Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password')) !!}
            </div>
          </div>
          <br />
          <div class="row">
            <div class="col-md-12">
                {!! Form::password('password_confirmation', array('class'=>'form-control', 'placeholder'=>'Confirm Password')) !!}
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
