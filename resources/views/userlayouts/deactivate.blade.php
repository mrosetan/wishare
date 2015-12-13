@extends('userlayouts-master.user-master')
@section('title', 'Deactivate')

@section('content')
<div class="page-content-wrap">
  <div class="row">
    <div class="settings-container">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4>Deactivate Account</h4>
          {!! Form::open(array(
                        'class' => 'form')) !!}

          <div class="row">
            <div class="col-md-12">
              To deactivate account, please enter your password.
            </div>
            <br />
            <div class="col-md-12">
              {!! Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password')) !!}
            </div>
          </div>
          <br />
          <div class="row">
            <div class="col-md-12">
                {!! Form::password('confirmnpassword', array('class'=>'form-control', 'placeholder'=>'Confirm Password')) !!}
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
