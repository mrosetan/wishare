@extends('userlayouts-master.other-master')
@section('title', 'Given')
@section('newcontent')
<br />
@if(count($given) > 0)
    @foreach($given as $gi)
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="pull-left">
          <a href="#">
            <div class="user stream image-circle">
              <img class="user stream img-circle" src="{!! $otherUser['imageurl'] !!}">
            </div>
          </a>
          <p class="profile-header">
            <b>{{ $otherUser['firstname'] }} {{ $otherUser['lastname'] }}</b> granted <a href="{!! action('UserProfilesController@profile', $gi->user['id']) !!}"><b>{{ $gi->user['firstname'] }} {{ $gi->user['lastname'] }}</b> ({{ $gi->user['username'] }})</a>'s wish: <b><a href="{!! action('SoloWishController@wish', $gi['id'] ) !!}">{{ $gi['title'] }}</a></b>
            <br />
              <b>Date: </b>{!! date('F d, Y g:i A', strtotime($gi['updated_at']))  !!}
            <br />
              <b>Wishlist: </b>{{ $gi->wishlist['title'] }}
            </p>
        </div>
        <br/><br /><br />
        <hr />
        <h4>{{ $gi['granteddetails'] }}</h4>
        @if(empty($gi['grantedimageurl']))
          <div></div>
        @endif
        @if(!empty($gi['grantedimageurl']))
        <div class="wish-image-container">
          <img src="{!! $gi['grantedimageurl'] !!}" class="wish-image" />
        </div>
        <hr />
        @endif
        <br />
        @if(!empty($user))
        <div class="wish-icons pull-right">
          <!-- <a href="#"><span class="fa fa-star"></span></a> -->
          <span data-wishid="{!! $gi['id']!!}" data-toggle="tooltip" data-placement="top" title="Favorite" class="favorite" data-favestatus="{!! !empty($gi['favorited']) ? 'unfave' : 'favorite' !!}"><span class="fa fa-star {!! !empty($gi['favorited']) ? 'favorited-icon' : 'unfave-icon' !!}"></span> <span class="count">{!! $gi['faves'] !!}</span> </span>
          &nbsp;&nbsp;
          <a href="{!! action('UserController@rewishDetails', $gi['id']) !!}" data-toggle="tooltip" data-placement="top" title="Rewish"><span class="fa fa-retweet"></span></a>
          <!-- &nbsp;&nbsp;
          <a href="#" class="mb-control" data-box="#mb-deletewish{!! $gi['id'] !!}" data-toggle="tooltip" data-placement="top" title="Delete"><span class="glyphicon glyphicon-trash"></span></a> -->
        </div>
        @else
        <div class="wishaction-btns pull-right">
          <div class="favetrack-count pull-right">
            <span class="count">{!! $gi['faves'] !!} Favorited</span>
            &nbsp;&nbsp;
             <span class="count">{!! $gi['tracks'] !!} Tracked</span>
          </div>
          <br/>
        </div>
        @endif
      </div>
      <!-- end of panel body -->
    </div>
    @endforeach
@else
<div class="panel panel-default">
  <div class="panel-body">
    No wishes given.
  </div>
</div>
@endif

<!-- message box-->
@if(isset($given))
  @foreach($given as $g)
    <div class="message-box animated fadeIn" data-sound="alert" id="mb-deletewish{!! $g->id !!}">
        <div class="mb-container">
            <div class="mb-middle">
                <div class="mb-title"><span class="glyphicon glyphicon-trash"></span>Delete Wish</div>
                <div class="mb-content">
                    <p>Are you sure you want to delete this wish?</p>
                </div>
                <div class="mb-footer">
                    @if(!empty($g))
                    <div class="pull-right">
                        <a href="{!! action('UserController@deleteWish', $g->id) !!}" class="btn btn-success btn-lg">Yes</a>
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
@endsection
