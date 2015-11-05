@extends('admin.master')
@section('title', 'Edit Admin Details')
@section('content')
<div class="row">

  <div class="container col-md-6 col-md-offset-3">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2> Edit Admin </h2>

            @if(session('status'))
              <div class="alert alert-success">
                  {{ session('status') }}
              </div>
            @endif

            {!! Form::open(array(
                          'action' => array('AdminController@updateAdmin', $user->id),
                          'class' => 'form')) !!}


            <div class="form-group">
                {!! Form::label('First Name') !!}
                {!! Form::text('firstname', $user->firstname,
                                array('class'=>'form-control')) !!}
            </div>

            <div class="form-group">
                {!! Form::label('Last Name') !!}
                {!! Form::text('lastname', $user->lastname,
                                array('class'=>'form-control')) !!}
            </div>

            <div class="form-group">
                {!! Form::label('Username') !!}
                {!! Form::text('username', $user->username,
                                array('class'=>'form-control')) !!}
            </div>

            <div class="form-group">
                {!! Form::label('Email') !!}
                {!! Form::email('email', $user->email,
                                array('class'=>'form-control')) !!}
            </div>

            <div class="form-group">
                {!! Form::label('Change Password') !!}
                {!! Form::password('password',
                                array('class'=>'form-control')) !!}
            </div>

            <div class="row">
              <div class="col-sm-6 form-group ">
                  {!! Form::submit('Submit',
                                    array('class'=>'btn btn-info btn-block')) !!}
              </div>

              <div class="col-sm-6 form-group">
                  {!! Form::reset('Cancel',
                                    array('class'=>'btn btn-info btn-block')) !!}
              </div>
            </div>

            {!! Form::close() !!}

            @foreach($errors->all() as $error)
                <p class="alert alert-danger"> {{ $error }}</p>
            @endforeach
        </div>


    </div>
  </div>

</div>
@stop
