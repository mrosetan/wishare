@extends('userlayouts-master.other-master')
@section('title', 'Home')
@section('newcontent')
<br />
@if(isset($wishes))
    @foreach($wishes as $wish)
      @if($wish->wishlist['privacy'] == 0)
        @if($wish->wishlist['status'] == 1)
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="pull-left">
              <a href="#">
                <div class="user stream image-circle">
                  <img class="user stream img-circle" src="{!! $otherUser['imageurl'] !!}">
                </div>
              </a>
              <p class="profile-header">
                <b>{{ $otherUser['firstname'] }} {{ $otherUser['lastname'] }}</b> added a new wish: <b><a href="{!! action('SoloWishController@wish', $wish['id'] ) !!}">{{ $wish['title'] }}</a></b>
                <br />
                  <b>Date: </b>{!! date('F d, Y g:i A', strtotime($wish['updated_at']))  !!}
                <br />
                  <b>Wishlist: </b> <a href="{!! action('WishlistController@wishes', [$otherUser['id'], $wish->wishlist['id']]) !!}">{{ $wish->wishlist['title'] }}</a>
              </p>
            </div>
            <br/><br /><br />
            <hr />
            @if(empty($wish['wishimageurl']))
              <div></div>
            @endif
            @if(!empty($wish['wishimageurl']))
            <div class="wish-image-container">
              <img src="{!! $wish['wishimageurl'] !!}" class="wish-image" />
            </div>
            <hr />
            @endif
            <br />
            @if($user != null)
              <div class="wish-icons pull-right">
                <!-- <a href="#"><span class="fa fa-star"></span></a> -->
                <span data-wishid="{!! $wish['id']!!}" data-toggle="tooltip" data-placement="top" title="Favorite" class="favorite" data-favestatus="{!! !empty($wish['favorited']) ? 'unfave' : 'favorite' !!}"><span class="fa fa-star {!! !empty($wish['favorited']) ? 'favorited-icon' : 'unfave-icon' !!}"></span> <span class="count">{!! $wish['faves'] !!}</span> </span>
                &nbsp;&nbsp;
                <!-- <a href="#"><span class="fa fa-bookmark"></span></a> -->
                <span data-wishid="{!! $wish['id']!!}" data-toggle="tooltip" data-placement="top" title="Track Wish" class="trackwish" data-trackstatus="{!! !empty($wish['tracked']) ? 'untrack' : 'trackwish' !!}"><span class="fa fa-bookmark {!! !empty($wish['tracked']) ? 'tracked-icon' : 'untracked-icon' !!}"></span> <span class="count">{!! $wish['tracks'] !!}</span> </span>
                &nbsp;&nbsp;
                <span data-toggle="tooltip" data-placement="top" title="Grant"><a data-toggle="modal" data-target="#modal_grant{!! $wish['id'] !!}"><span class="fa fa-magic"></span></a></span>
                &nbsp;&nbsp;
                <a href="{!! action('UserController@rewishDetails', $wish['id']) !!}" data-toggle="tooltip" data-placement="top" title="Rewish"><span class="fa fa-retweet"></span></a>
                <!-- &nbsp;&nbsp;
                <a href="#" data-toggle="modal" data-target="#modalwish{!! $wish->id !!}"><span class="fa fa-edit"></span></a>
                &nbsp;&nbsp;
                <a href="{!! url('user/edit/tags', $wish->id) !!}" data-toggle="tooltip" data-placement="top" title="Tag"><span class="fa fa-tag"></span></a>
                &nbsp;&nbsp;
                <a href="#" class="mb-control" data-box="#mb-deletewish{!! $wish['id'] !!}" data-toggle="tooltip" data-placement="top" title="Delete"><span class="glyphicon glyphicon-trash"></span></a> -->
              </div>
            @else
              <div class="wishaction-btns pull-right">
                <div class="favetrack-count pull-right">
                  <span class="count">{!! $wish['faves'] !!} Favorited</span>
                  &nbsp;&nbsp;
                   <span class="count">{!! $wish['tracks'] !!} Tracked</span>
                </div>
                <br/>
              </div>
            @endif
          <!-- end of panel body -->
          </div>
        </div>
        @endif
      @endif
    @endforeach
@endif
@if(count($wishes) == 0)
<div class="panel panel-default">
  <div class="panel-body">
    No wishes.
  </div>
</div>
@endif
<!-- modal -->
@if(isset($wishes))
  @foreach($wishes as $wish)
    <div class="modal" id="modalwish{!! $wish->id !!}" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4>Edit Wish</h4>
            </div>
            <div class="modal-body">
              @if(session('wishStatus'))
                <div class="alert alert-success">
                    {{ session('wishStatus') }}
                </div>
              @endif
              @foreach($errors->all() as $error)
                  <p class="alert alert-danger"> {{ $error }}</p>
              @endforeach
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
            </div>
        </div>
      </div>
    </div>
  @endforeach
@endif

<!-- end of modal -->

<!-- message box-->
@if(isset($wishes))
  @foreach($wishes as $wish)
    <div class="message-box animated fadeIn" data-sound="alert" id="mb-deletewish{!! $wish->id !!}">
        <div class="mb-container">
            <div class="mb-middle">
                <div class="mb-title"><span class="glyphicon glyphicon-trash"></span>Delete Wish</div>
                <div class="mb-content">
                    <p>Are you sure you want to delete this wish?</p>
                </div>
                <div class="mb-footer">
                    @if(!empty($wishes))
                    <div class="pull-right">
                        <a href="{!! action('UserController@deleteWish', $wish->id) !!}" class="btn btn-success btn-lg">Yes</a>
                        <button class="btn btn-default btn-lg mb-control-close">No</button>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
  @endforeach
@endif
<!--end of message box-->

@if(isset($wishes))
  @foreach($wishes as $wish)
<div class="modal" id="modal_grant{!! $wish['id'] !!}" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
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
              {!! Form::open(array('action'=>array('UserController@grantWish', $wish['id']), 'class' => 'form', 'files'=>true)) !!}
              <div class="form-group">
                <div class="row">
                  <div class="col-sm-12">
                    <label>Wish</label>
                    {!! Form::text('wish', $wish['title'], array('class'=>'form-control', 'placeholder'=>'', 'disabled'=>'disabled')) !!}
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
@endif



@endsection
