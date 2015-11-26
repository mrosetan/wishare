@extends('userlayouts-master.user-master')
@section('title', '')

@section('content')
<div class="page-content-wrap">
  <div class="row">
    <div class="actions-container">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4>Add Wish</h4>
          {!! Form::open(array( 'action' => 'UserController@addWish',
                                'class' => 'form')) !!}
          <div class="form-group">
            <div class="row">
              <div class="col-md-12">
                {!! Form::select('wishlist', ['null'=>'-Wishlist-', 'Christmas', 'Personal', 'Birthday'], null, array('class'=>'form-control'))!!}
              </div>
            </div>
            <br />
            <div class="row">
              <div class="col-md-12">
                {!! Form::text('wish', null, array('class'=>'form-control', 'placeholder'=>'Wish')) !!}
              </div>
            </div>
            <br />
            <div class="row">
              <div class="col-md-12">
                {!! Form::textarea('description', null, ['class'=>'form-control ', 'placeholder'=>'Details or specifics about the wish', 'size'=>'102x5']) !!}
              </div>
            </div>
            <br />
            <div class="row">
              <div class="col-md-12">
                {!! Form::textarea('alternatives', null, ['class'=>'form-control ', 'placeholder'=>'Wish alternatives', 'size'=>'102x5']) !!}
              </div>
            </div>
            <br />
            <label>Tag</label>
            <div class="row">
              <div class="col-md-12">
                <div class="tag-container">
                  <!-- {!! Form::checkbox('tag', 'tagged') !!}&nbsp;Bobby Baratheon
                  <br>
                  {!! Form::checkbox('tag', 'tagged') !!}&nbsp;Rosie Lannister
                  <br>
                  {!! Form::checkbox('tag', 'tagged') !!}&nbsp;Bobrys -->
                  <select id="my-select" name="tags[]" multiple="multiple">
                    @foreach($friends as $f)
                      <option value="{!! $f->id !!}">{!! $f->firstname !!} {!! $f->lastname !!} ({!! $f->username !!})</option>

                    @endforeach
                  </select>
                </div>

                <!-- ============= TAGS ============ -->
                <div class="form-group">
                    <!-- <label class="col-sm-2 control-label">Multiselect</label> -->
                    <div class="col-sm-10">
                        <select id="example-post" name="multiselect[]" multiple="multiple">
                          @foreach($friends as $f)
                            <option value="{!! $f->id !!}">{!! $f->firstname !!} {!! $f->lastname !!} ({!! $f->username !!})</option>

                          @endforeach
                        </select>
                    </div>
                </div>

              </div>
            </div>
            <br />
            <div class="row">
              {!! Form::file('photo')!!}
            </div>
            <br />
            <div class="row">
              <span class="glyphicon glyphicon-flag"></span><a href="#"><span class="xn-text">&nbsp;Flag wish</span></a>
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
    </div>
  </div>
</div>
@endsection
