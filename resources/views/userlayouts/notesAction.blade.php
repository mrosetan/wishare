@extends('userlayouts-master.user-master')
@section('title', 'Send Note')

@section('content')
<div class="page-content-wrap">
  <div class="row">
    <div class="actions-container">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4>Send Note</h4>
          @if(session('noteStatus'))
            <div class="alert alert-success">
                {{ session('noteStatus') }}
            </div>
          @endif
          @foreach($errors->all() as $error)
              <p class="alert alert-danger"> {{ $error }}</p>
          @endforeach
          {!! Form::open(array(
                        'action' => array('UserController@createNote'),
                        'class' => 'form')) !!}
          <div class="form-group">
            <div class="row">
              <div class="col-md-12">
                <label>Recipient:</label>
                <br />
                  {!! Form::select('recipient', $recipient, null, array('class'=>'form-control select')) !!}
              </div>
            </div>
            <br />
            <div class="row">
              <div class="col-md-12">
                {!! Form::textarea('message', null, ['class'=>'form-control', 'placeholder'=>'Note', 'size'=>'50x5']) !!}
              </div>
            </div>
            <br />
            <div class="row">
              <div class="col-md-12">
                <div class="pull-right">
                  {!! Form::submit('Send', array('class'=>'btn btn-info')) !!}
                  {!! Form::reset('Cancel', array('class'=>'btn btn-default')) !!}
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
