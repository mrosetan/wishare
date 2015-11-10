@extends('userlayouts-master.user-master')
@section('title', '')

@section('content')
<div class="page-content-wrap">
  <div class="row">
    <div class="actions-container">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4>Send Thank You Note</h4>
          {!! Form::open(array( 'class' => 'form')) !!}
          <div class="form-group">
            <div class="row">
              <div class="col-md-12">
                {!! Form::text('search', null, array('class'=>'form-control', 'placeholder'=>'Recipient')) !!}
              </div>
            </div>
            <br />
            <div class="row">
              <div class="col-md-12">
                {!! Form::textarea('note', null, ['class'=>'form-control', 'placeholder'=>'Note', 'size'=>'50x5']) !!}
              </div>
            </div>
            <br />
            <label>Thank You Sticker</label>
            <div class="row">
              <div class="col-md-4">
                {!! Form::radio('sticker', '1') !!}&nbsp;Sticker 1
              </div>
              <div class="col-md-4">
                {!! Form::radio('sticker', '1') !!}&nbsp;Sticker 2
              </div>
              <div class="col-md-4">
                {!! Form::radio('sticker', '1') !!}&nbsp;Sticker 3
              </div>
            </div>
            <br />
            <div class="row">
              {!! Form::file('photo')!!}
            </div>
            <br />
            <div class="row">
              <div class="col-md-12">
                <div class="pull-right">
                  {!! Form::submit('Send', array('class'=>'btn btn-info')) !!}
                  {!! Form::button('Cancel', array('class'=>'btn btn-default mb-control-close')) !!}
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
