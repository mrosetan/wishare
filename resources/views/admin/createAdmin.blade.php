@extends('admin.master')
@section('title', 'Add Admin')
@section('content')
<div class="row">

  <div class="container col-md-6 col-md-offset-3">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2> Add New Admin </h2>
            {!! Form::open(array(
                          'action' => array('AdminController@storeAdmin'),
                          'class' => 'form')) !!}


            <div class="form-group">
                {!! Form::label('Input First Name') !!}
                {!! Form::text('firstname', null,
                                array('required',
                                'class'=>'form-control')) !!}
            </div>

            <div class="form-group">
                {!! Form::label('Input Last Name') !!}
                {!! Form::text('lastname', null,
                                array('required',
                                'class'=>'form-control')) !!}
            </div>

            <div class="form-group">
                {!! Form::label('Input Username') !!}
                {!! Form::text('username', null,
                                array('required',
                                'class'=>'form-control')) !!}
            </div>

            <div class="form-group">
                {!! Form::label('Input Email') !!}
                {!! Form::email('email', null,
                                array('required',
                                'class'=>'form-control')) !!}
            </div>

            <div class="form-group">
                {!! Form::label('Input Password') !!}
                {!! Form::password('password',
                                array('required',
                                'class'=>'form-control')) !!}
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

        </div>


    </div>
  </div>

</div>
@stop
