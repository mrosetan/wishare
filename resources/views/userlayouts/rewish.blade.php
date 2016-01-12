@extends('userlayouts-master.user-master')
@section('title', 'Rewish')
@section('content')
<div class="page-content-wrap">
  <div class="row">
    <div class="rewish-container">
      <h5><a href="javascript:history.go(-1)"><span class="fa fa-arrow-circle-o-left"></span>&nbsp;Back</a></h5>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4>Re-wish</h4>
          @foreach($errors->all() as $error)
              <p class="alert alert-danger"> {{ $error }}</p>
          @endforeach
          @if(isset($wishlists) and count($wish) > 0)
          {!! Form::open(array('action'=>array('UserController@reWish', $wish['id']), 'class' => 'form', 'files'=>true)) !!}
          <div class="form-group">
            <div class="row">
              <div class="col-md-12">
                {!! Form::select('wishlist', $wishlists, null, array('class'=>'form-control'))!!}
              </div>
            </div>
            <br />
            <div class="row">
              <div class="col-md-12">
                {!! Form::text('title', $wish['title'], array('class'=>'form-control', 'placeholder'=>'Wish', 'disabled'=>'true', 'value'=>$wish['title'])) !!}
              </div>
            </div>
            <br />
            <div class="row">
              <div class="col-md-12">
                {!! Form::textarea('details', null, ['class'=>'form-control ', 'placeholder'=>'Details or specifics about the wish', 'size'=>'102x5']) !!}
              </div>
            </div>
            <br />
            <div class="row">
              <div class="col-md-12">
                {!! Form::textarea('alternatives', null, ['class'=>'form-control ', 'placeholder'=>'Wish alternatives', 'size'=>'102x5']) !!}
              </div>
            </div>
            <br />
            <div class="row">
              <div class="col-sm-12">
                <label>Due Date:</label>
                {!! Form::text('due_date', date('Y-m-d'), array('class'=>'calendar form-control', 'id'=>'datepicker')) !!}
              </div>
            </div>
            <br />
            <div class="row">
              <div class="col-sm-12">
                <label>Upload:</label><br />
                {!! Form::file('wishimageurl', array('class'=>'fileinput btn btn-info')) !!}
              </div>
            </div>
            <br />
            <div class="row">
              <div class="col-md-12">
                <label>Tag:</label>
                <select class="my-select" name="tags[]" multiple="multiple">
                  @foreach($friends as $f)
                    <option value="{!! $f->id !!}">{!! $f->firstname !!} {!! $f->lastname !!} ({!! $f->username !!})</option>

                  @endforeach
                </select>


              </div>
            </div>

            <br />
            <div class="row">
              <div class="col-md-12">
                {!! Form::checkbox('flag', '1', ['class'=>'form-control ']) !!}
                <label><span class="glyphicon glyphicon-flag"></span> Flag </label>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="pull-right">
                  {!! Form::submit('Add', array('class'=>'btn btn-info')) !!}
                  {!! Form::button('Cancel', array('class'=>'btn btn-default mb-control-close')) !!}
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
