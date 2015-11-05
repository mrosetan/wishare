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
              {!! Form::open() !!}
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
              <label>Birthdate</label>
              <div class="row">
                <div class="col-md-4">
                    {!! Form::select('year', ['null'=>'-Year-', 2010, 2011, 2012, 2013, 2014, 2015], null, ['class'=>'form-control']) !!}
                </div>
                <div class="col-md-4">
                  {!! Form::select('month', ['null'=>'-Month-','January','February','March','April','May','June','July','August','Septembder','October','November','December'], null, ['class'=>'form-control']) !!}
                </div>
                <div class="col-md-4">
                  {!! Form::select('day', ['null'=>'-Day-',1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31], null, ['class'=>'form-control']) !!}
                </div>
              </div>
              <hr />
              <div class="pull-right">
                {!! Form::submit('Save', array('class'=>'btn btn-info btn-settings')) !!}
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
