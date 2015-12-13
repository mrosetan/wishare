@extends('userlayouts-master.user-master')
@section('title', '')

@section('content')
<div class="page-content-wrap">
  <div class="row">
    <div class="actions-container">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4>Create a Wishlist</h4>
          @if(session('wishlistStatus'))
            <div class="alert alert-success">
                {{ session('wishlistStatus') }}
            </div>
          @endif
          @foreach($errors->all() as $error)
              <p class="alert alert-danger"> {{ $error }}</p>
          @endforeach
          {!! Form::open(array(
                        'action' => array('UserController@createWishlist'),
                        'class' => 'form')) !!}
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  {!! Form::text('title', null, array('required', 'class'=>'form-control', 'placeholder'=>'Title')) !!}
                </div>
              </div>
              <br />
              <!--
              <label>Due Date</label>
              <div class="row">
                <div class="col-md-12">
                  {!! Form::text('date', null, array('id'=>'datepicker', 'class'=>'form-control')) !!}
                </div>
              </div>
            -->
              <label>Privacy</label>
              <div class="row">
                <div class="col-md-12">
                  {!! Form::radio('privacy', '0', true)!!}&nbsp;Public
                  <br />
                  {!! Form::radio('privacy', '1')!!}&nbsp;Private
                </div>
              </div>
              <br/ >
              <div class="row">
                <div class="col-md-12">
                  <div class="pull-right">
                      {!! Form::submit('Create', array('class'=>'btn btn-info')) !!}
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
