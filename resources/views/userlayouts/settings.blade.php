@extends('userlayouts-master.user-master')
@section('title', 'Settings')

@section('content')
<div class="page-content-wrap">
  <div class="row">
    <div class="settings-container">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4>Edit Profile</h4>
          {!! Form::open(array(
                        'class' => 'form')) !!}
          <div class="row">
            <div class="col-md-12">
              {!! Form::text('firstname', null, array('class'=>'form-control', 'placeholder'=>'First Name')) !!}
            </div>
          </div>
          <br />
          <div class="row">
            <div class="col-md-12">
                {!! Form::text('lastname', null, array('class'=>'form-control', 'placeholder'=>'Last Name')) !!}
            </div>
          </div>
          <br />
          <div class="row">
            <div class="col-md-12">
                {!! Form::text('city', null, array('class'=>'form-control', 'placeholder'=>'City')) !!}
            </div>
          </div>
          <br />
          <div class="row">
            <div class="col-md-12">
                {!! Form::text('fblink', null, array('class'=>'form-control', 'placeholder'=>'Facebook')) !!}
            </div>
          </div>
          <br />
          <div class="row">
            <div class="col-md-12">
              {!! Form::text('date', null, array('id'=>'datepicker', 'class'=>'form-control', 'placeholder'=>'Birthdate')) !!}
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
