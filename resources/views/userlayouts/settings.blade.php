@extends('userlayouts-master.user-master')
@section('title', 'Settings')

@section('content')
<div class="page-content-wrap">
  <div class="row">
    <div class="settings-container">
      <!-- <div class="panel panel-default">
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
                        'class' => 'form', 'files'=>true)) !!}
          <div class="form-group">
            <div class="row">
              <label>Set Profile Picture:</label>
              {!! Form::file('imageurl') !!}
            </div>
            <br />
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
                {!! Form::text('birthdate', $user->birthdate, array('id'=>'datepicker', 'class'=>'form-control')) !!}
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
      </div> -->
      <div class="panel panel-default tabs">
        <ul class="nav nav-tabs nav-justified" role="tablist" id="myTab">
          <li class="active"><a href="#tab-profile" role="tab" data-toggle="tab">Profile Details</a></li>
          <li><a href="#tab-pic" role="tab" data-toggle="tab">Profile Picture</a></li>
        </ul>
        <div class="panel-body tab-content">
          <div class="tab-pane active" id="tab-profile">
            @if(session('status'))
              <div class="alert alert-success">
                  {{ session('status') }}
              </div>
            @endif
            @foreach($errors->all() as $error)
                <p class="alert alert-danger"> {{ $error }}</p>
            @endforeach
            {!! Form::open(array(
                          'action' => array('UserController@updateUserSettings'),
                          'class' => 'form')) !!}
            <div class="form-group">
              <!-- <div class="row">
                <label>Set Profile Picture:</label>
                {!! Form::file('imageurl') !!}
              </div>
              <br /> -->
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
                  {!! Form::text('birthdate', $user->birthdate, array('id'=>'datepicker', 'class'=>'form-control')) !!}
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
          <div class="tab-pane" id="tab-pic">
            @if(session('status'))
              <div class="alert alert-success">
                  {{ session('status') }}
              </div>
            @endif
            @foreach($errors->all() as $error)
                <p class="alert alert-danger"> {{ $error }}</p>
            @endforeach
            {!! Form::open(array(
                          'action' => array('UserController@updateProfilePic', $user->id),
                          'class' => 'form', 'files'=>true)) !!}
            <div class="form-group">
              <div class="row">
                <label>Set Profile Picture:</label>
                {!! Form::file('imageurl') !!}
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
</div>
@endsection
