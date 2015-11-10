@extends('userlayouts-master.user-master')
@section('title', '')

@section('content')
<div class="page-content-wrap">
  <div class="row">
    <div class="actions-container">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4>Create a Wishlist</h4>
            {!! Form::open(array('class' => 'form')) !!}
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  {!! Form::text('title', null, array('class'=>'form-control', 'placeholder'=>'Title')) !!}
                </div>
              </div>
              <br />
              <label>Due Date</label>
              <div class="row">
                <div class="col-md-12">
                  {!! Form::text('date', null, array('id'=>'datepicker', 'class'=>'form-control')) !!}
                </div>
              </div>
              <br />
              <label>Privacy</label>
              <div class="row">
                <div class="col-md-12">
                  {!! Form::radio('privacy', '1')!!}&nbsp;Private
                  <br>
                  {!! Form::radio('privacy', '0')!!}&nbsp;Public
                </div>
              </div>
              <br />
              <label>Tag</label>
              <div class="row">
                <div class="col-md-12">
                  <div class="tag-container">
                    {!! Form::checkbox('tag', 'tagged') !!}&nbsp;Bobby Baratheon
                    <br>
                    {!! Form::checkbox('tag', 'tagged') !!}&nbsp;Rosie Lannister
                    <br>
                    {!! Form::checkbox('tag', 'tagged') !!}&nbsp;Bobrys
                  </div>
                </div>
              </div>
              <br/ >
              <div class="row">
                <span class="fa fa-facebook-square"><a href="#"></span> <span class="xn-text">Share on Facebook</span></a>
              </div>
              <br />
              <div class="row">
                <div class="col-md-12">
                  <div class="pull-right">
                      {!! Form::submit('Create', array('class'=>'btn btn-info')) !!}
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
