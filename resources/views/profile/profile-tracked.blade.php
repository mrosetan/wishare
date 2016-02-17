@extends('userlayouts-master.profile-master')
@section('title', 'Tracked')
@section('newcontent')
<br />

@if(isset($tracked))
    @foreach($tracked as $tr)
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="pull-left">
          <a href="#">
            <div class="user stream image-circle">
              <img class="user stream img-circle" src="{!! $user['imageurl'] !!}">
            </div>
          </a>
          <p class="profile-header">
            <b>{{ $user['firstname'] }} {{ $user['lastname'] }}</b> tracked a wish: <b><a href="{!! action('SoloWishController@wish', $tr->wish['id'] ) !!}">{{ $tr->wish['title'] }}</a></b>
            <br />
            <b>Date: </b>{!! date('F d, Y g:i A', strtotime($tr['updated_at']))  !!}
          </p>
        </div>
        <br/><br /><br />
        <hr />
        @if(empty($tr->wish['wishimageurl']))
          <div></div>
        @endif
        @if(!empty($tr->wish['wishimageurl']))
        <div class="wish-image-container">
          <img src="{!! $tr->wish['wishimageurl'] !!}" class="wish-image" />
        </div>
        <hr />
        @endif
        <br />
        <div class="wish-icons pull-right">
          <!-- <a href="#"><span class="fa fa-star"></span></a> -->
          <span data-wishid="{!! $tr->wish['id']!!}" data-toggle="tooltip" data-placement="top" title="Favorite" class="favorite" data-favestatus="{!! !empty($tr['favorited']) ? 'unfave' : 'favorite' !!}"><span class="fa fa-star {!! !empty($tr['favorited']) ? 'favorited-icon' : 'unfave-icon' !!}"></span> <span class="count">{!! $tr['faves'] !!}</span> </span>
          &nbsp;&nbsp;
          <!-- <a href="#"><span class="fa fa-bookmark"></span></a> -->
          <span data-wishid="{!! $tr->wish['id']!!}" data-toggle="tooltip" data-placement="top" title="Track Wish" class="trackwish" data-trackstatus="{!! !empty($tr['tracked']) ? 'untrack' : 'trackwish' !!}"><span class="fa fa-bookmark {!! !empty($tr['tracked']) ? 'tracked-icon' : 'untracked-icon' !!}"></span> <span class="count">{!! $tr['tracks'] !!}</span> </span>
          &nbsp;&nbsp;
          <a href="{!! action('UserController@rewishDetails', $tr->wish['id']) !!}" data-toggle="tooltip" data-placement="top" title="Rewish"><span class="fa fa-retweet"></span></a>
          &nbsp;&nbsp;
          @if($tr->wish['granterid'] == 0 AND $tr->wish['date_granted'] == '0000-00-00 00:00:00')
            <span data-toggle="tooltip" data-placement="top" title="Grant"><a data-toggle="modal" data-target="#modal_grant{!! $tr->wish['id'] !!}"><span class="fa fa-magic"></span></a></span>
          @endif
        </div>
      </div>
      <!-- end of panel body -->
    </div>
    @endforeach
@endif
@if(count($tracked) == 0)
<div class="panel panel-default">
  <div class="panel-body">
    No tracked wishes.
  </div>
</div>
@endif

@foreach($tracked as $tr)
<div class="modal" id="modal_grant{!! $tr->wish['id'] !!}" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4>Grant Wish</h4>
            </div>
            <div class="modal-body">
              @foreach($errors->all() as $error)
                  <p class="alert alert-danger"> {{ $error }}</p>
              @endforeach
              {!! Form::open(array('action'=>array('UserController@grantWish', $tr->wish['id']), 'class' => 'form', 'files'=>true)) !!}
              <div class="form-group">
                <div class="row">
                  <div class="col-sm-12">
                    <label>Wish</label>
                    {!! Form::text('wish', $tr->wish['title'], array('class'=>'form-control', 'placeholder'=>'', 'disabled'=>'disabled')) !!}
                  </div>
                </div>
                <br />
                <div class="row">
                  <div class="col-sm-12">
                    {!! Form::text('granteddetails', null, array('class'=>'form-control', 'placeholder'=>'Caption'))!!}
                  </div>
                </div>
                <br />
                <div class="row">
                  {!! Form::file('grantedimageurl', array('class'=>'fileinput btn btn-info'))!!}
                </div>
                <br />
                <div class="row">
                  <div class="col-md-12">
                    <div class="pull-right">
                      {!! Form::submit('Grant', array('class'=>'btn btn-info')) !!}
                      {!! Form::reset('Cancel', array('class'=>'btn btn-default')) !!}
                    </div>
                  </div>
                </div>
              </div>
              {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endforeach


@endsection
