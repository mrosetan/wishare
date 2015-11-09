@extends('userlayouts-master.user-master')
@section('title', 'Settings')

@section('content')
<div class="page-content-wrap">
  <div class="row">
    <div class="settings-container">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4>Edit Profile</h4>
          @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
          @endif
          @foreach($errors->all() as $error)
              <p class="alert alert-danger"> {{ $error }}</p>
          @endforeach
          {!! Form::open(array(
                        'action' => array('UserController@updateUserSettings', $user->id),
                        'class' => 'form')) !!}
          <div class="form-group">
            <div class="row">
              <div class="col-sm-12">
                <label>First Name:</label>
                {!! Form::text('firstname', $user->firstname, array('class'=>'form-control')) !!}
              </div>
            </div>
            <br />
            <div class="row">
              <div class="col-sm-12">
                <label>Last Name:</label>
                  {!! Form::text('lastname', $user->lastname, array('class'=>'form-control')) !!}
              </div>
            </div>
            <br />
            <div class="row">
              <div class="col-sm-12">
                <label>City:</label>
                  {!! Form::text('city', $user->city, array('class'=>'form-control')) !!}
              </div>
            </div>
            <br />
            <div class="row">
              <div class="col-sm-12">
                <label>Username:</label>
                  {!! Form::text('username', $user->username, array('class'=>'form-control')) !!}
              </div>
            </div>
            <br />
            <div class="row">
              <div class="col-sm-12">
                <label>E-mail:</label>
                  {!! Form::email('email', $user->email, array('class'=>'form-control')) !!}
              </div>
            </div>
            <br/ >
            <div class="row">
              <div class="col-sm-12">
                <label>Facebook Username:</label>
                  {!! Form::text('facebook', $user->facebook, array('class'=>'form-control')) !!}
              </div>
            </div>
            <br />
            <div class="row">
              <div class="col-sm-12">
                <label>Birthdate:</label>
                {!! Form::text('birthdate', $user->birthdate, array('id'=>'datepicker', 'class'=>'form-control', 'placeholder'=>'YYYY-MM-DD')) !!}
              </div>
            </div>
            <hr />
            <div class="row">
              <div class="ccol-sm-12">
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
</div>
@endsection
