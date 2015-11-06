@extends('userlayouts-master.user-master')
@section('title', 'Change Password')

@section('content')
<div class="page-content-wrap">
  <div class="row">
    <div class="settings-container">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4>Change Password</h4>
          {!! Form::open(array(
                        'class' => 'form')) !!}
          <div class="row">
            <div class="col-md-12">
              {!! Form::password('oldpass', array('class'=>'form-control', 'placeholder'=>'Old Password')) !!}
            </div>
          </div>
          <br />
          <div class="row">
            <div class="col-md-12">
              {!! Form::password('newpassword', array('class'=>'form-control', 'placeholder'=>'New Password')) !!}
            </div>
          </div>
          <br />
          <div class="row">
            <div class="col-md-12">
                {!! Form::password('confirmnewpassword', array('class'=>'form-control', 'placeholder'=>'Confirm New Password')) !!}
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
