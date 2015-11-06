@extends('userlayouts-master.user-master')
@section('title', 'Settings')

@section('content')
<div class="page-content-wrap">
  <div class="row">
    <div class="settings-container">
      <div class="panel panel-default tabs nav-tabs-vertical">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-settings" data-toggle="tab">Settings</a></li>
            <li><a href="#tab-changepassword" data-toggle="tab">Change Password</a></li>
            <li><a href="#tab-deactivate" data-toggle="tab">Deactivate Account</a></li>
        </ul>
        <div class="panel-body tab-content">
          <!-- Settings -->
            <div class="tab-pane active" id="tab-settings">
              {!! Form::open([
              ]) !!}
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
            <!-- Change Password -->
            <div class="tab-pane" id="tab-changepassword">
              {!! Form::open() !!}
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
              {!! Form::close() !!}
            </div>
            <!--Deactivate account-->
            <div class="tab-pane" id="tab-deactivate">
              To deactivate account, please type in your password.
              <br /><br />
              {!! Form::open() !!}
              <div class="row">
                <div class="col-md-12">
                  {!! Form::password('password', array('class'=>'form-control', 'placeholder'=>'New Password')) !!}
                </div>
              </div>
              <br />
              <div class="row">
                <div class="col-md-12">
                    {!! Form::password('confirmpassword', array('class'=>'form-control', 'placeholder'=>'Confirm New Password')) !!}
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
              {!! Form::close() !!}
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
