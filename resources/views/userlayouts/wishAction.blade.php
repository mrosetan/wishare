@extends('userlayouts-master.user-master')
@section('title', 'Add Wish')

@section('content')
<div class="page-content-wrap">
  <div class="row">
    <div class="actions-container">

      @if(count($wishlists)>0)
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4>Add Wish</h4>
            @if(session('wishStatus'))
              <div class="alert alert-success">
                  {{ session('wishStatus') }}
              </div>
            @endif
            @foreach($errors->all() as $error)
                <p class="alert alert-danger"> {{ $error }}</p>
            @endforeach
            {!! Form::open(array( 'action' => 'UserController@addWish',
                                  'class' => 'form',
                                  'files'=>true)) !!}
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  {!! Form::select('wishlist', $wishlists, null, array('class'=>'form-control'))!!}
                </div>
              </div>
              <br />
              <div class="row">
                <div class="col-md-12">
                  {!! Form::text('title', null, array('class'=>'form-control', 'placeholder'=>'Wish')) !!}
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
                  {!! Form::text('due_date', "Select a date you want to have this wish", array('class'=>'calendar form-control', 'id'=>'datepicker')) !!}
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
                      <option value="{!! $f->id !!}">{{ $f->firstname }} {{ $f->lastname }} ({{ $f->username }})</option>

                    @endforeach
                  </select>
                  <!-- ============= TAGS v2 ============ -->
                  <!-- <div class="form-group">
                      <div class="col-sm-10">
                          <select id="example-post" name="multiselect[]" multiple="multiple">
                            @foreach($friends as $f)
                              <option value="{!! $f->id !!}">{!! $f->firstname !!} {!! $f->lastname !!} ({!! $f->username !!})</option>

                            @endforeach
                          </select>
                      </div>
                  </div> -->
                  <!-- ============= TAGS ============ -->

                </div>
              </div>
              <!-- <div class="row">
                <div class="col-md-12">
                  <label>Add Wish Photo:</label>
                  <br />
                  {!! Form::file('wishimageurl', array('class'=>'fileinput btn btn-info')) !!}
                </div>
              </div> -->
              <br />
              <div class="row">
                <div class="col-md-12">
                  {!! Form::checkbox('flag', '1', ['class'=>'form-control ']) !!}
                  <label><span class="glyphicon glyphicon-flag"></span> Flag </label>
                  <!-- <span class="glyphicon glyphicon-flag"></span><a href="#"><span class="xn-text">&nbsp;Flag wish</span></a> -->
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
          </div>
        </div>
      @else
        <div class="message-box animated fadeIn open" id="mb-wishlist">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="glyphicon glyphicon-pencil"></span> You don't have wishlists.</div>
                    <div class="mb-content">
                        <p>You need to create a wishlist.</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href="{{ url('/user/action/wishlist') }}" class="btn btn-success btn-lg">Create Wishlist</a>
                            <a href="{{ url('/user/home') }}" class="btn btn-success btn-lg">Go back to home</a>
                            <!-- <button class="btn btn-default btn-lg mb-control-close">No</button> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

      @endif
    </div>
  </div>
</div>
@endsection
