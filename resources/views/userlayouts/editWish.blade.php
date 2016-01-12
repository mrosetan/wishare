@extends('userlayouts-master.user-master')
@section('title', 'Edit Wish')
@section('content')
<div class="page-content-wrap">
  <div class="row">
    <div class="rewish-container">
      <h5><a href="javascript:history.go(-1)"><span class="fa fa-arrow-circle-o-left"></span>&nbsp;Back</a></h5>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4>Edit Wish</h4>
          @if(session('wishStatus'))
            <div class="alert alert-success">
                {{ session('wishStatus') }}
            </div>
          @endif
          @foreach($errors->all() as $error)
              <p class="alert alert-danger"> {{ $error }}</p>
          @endforeach
          @if(isset($wishlistsList) and count($wish) > 0)
          {!! Form::open(array( 'action' => array('UserController@updateWish', $wish->id),
                                'class' => 'form',
                                'files'=>true,
                                'enctype'=>'multipart/form-data')) !!}
          <div class="form-group">
            <div class="row">
              <div class="col-md-12">
                {!! Form::select('wishlist', $wishlistsList, $wish->wishlistid, array('class'=>'form-control'))!!}
              </div>
            </div>
            <br />
            <div class="row">
              <div class="col-md-12">
                {!! Form::text('title', $wish->title, array('class'=>'form-control', 'placeholder'=>'Wish')) !!}
              </div>
            </div>
            <br />
            <div class="row">
              <div class="col-md-12">
                {!! Form::textarea('details', $wish->details, ['class'=>'form-control ', 'placeholder'=>'Details or specifics about the wish', 'size'=>'102x5']) !!}
              </div>
            </div>
            <br />
            <div class="row">
              <div class="col-md-12">
                {!! Form::textarea('alternatives', $wish->alternatives, ['class'=>'form-control ', 'placeholder'=>'Wish alternatives', 'size'=>'102x5']) !!}
              </div>
            </div>
            <br />
            <div class="row">
              <div class="col-sm-12">
                <label>Due Date</label>
                {!! Form::text('due_date', $wish->due_date, array('id'=>'datepicker', 'class'=>'form-control')) !!}
              </div>
            </div>
            <br />
            <div class="row">
              <div class="col-sm-12">
                {!! Form::file('wishimageurl', array('class'=>'fileinput btn btn-info')) !!}
              </div>
            </div>
            <br />
            <div class="row">
              <div class="col-md-12">
                @if($wish->flagged ==  1)
                  {!! Form::checkbox('flag', '1', true) !!}
                @else
                  {!! Form::checkbox('flag', '1') !!}
                @endif
                <label><span class="glyphicon glyphicon-flag"></span> Flag </label>
                <!-- <span class="glyphicon glyphicon-flag"></span><a href="#"><span class="xn-text">&nbsp;Flag wish</span></a> -->
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="pull-right">
                  {!! Form::submit('Update', array('class'=>'btn btn-info')) !!}
                </div>
              </div>
            </div>
          </div>
          {!! Form::close() !!}
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
