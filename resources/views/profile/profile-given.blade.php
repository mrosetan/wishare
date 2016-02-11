@extends('userlayouts-master.profile-master')
@section('title', 'Given')
@section('newcontent')
<br />
@if(count($given) > 0)
    @foreach($given as $gi)
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="pull-left">
          <a href="#">
            <img class="user stream img-circle" src="{!! $user['imageurl'] !!}">
          </a>
          <b>{{ $user['firstname'] }} {{ $user['lastname'] }}</b> granted <a href="{!! action('UserProfilesController@profile', $gi->user['id']) !!}"><b>{{ $gi->user['firstname'] }} {{ $gi->user['lastname'] }}</b> ({{ $gi->user['username'] }})</a>'s wish: <b><a href="{!! action('SoloWishController@wish', $gi['id'] ) !!}">{{ $gi['title'] }}</a></b>
          <br />
            <b>Date: </b>{!! date('F d, Y g:i A', strtotime($gi['updated_at']))  !!}
          <br />
            <b>Wishlist: </b><a href="{!! action('WishlistController@wishes', $gi->wishlist['id']) !!}">{{ $gi->wishlist['title'] }}</a>
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
        <div class="wish-icons pull-right">
          <!-- <a href="#"><span class="fa fa-star"></span></a> -->
          <span data-wishid="{!! $gi['id']!!}" data-toggle="tooltip" data-placement="top" title="Favorite" class="favorite" data-favestatus="{!! !empty($gi['favorited']) ? 'unfave' : 'favorite' !!}"><span class="fa fa-star {!! !empty($gi['favorited']) ? 'favorited-icon' : 'unfave-icon' !!}"></span> <span class="count">{!! $gi['faves'] !!}</span> </span>
          &nbsp;&nbsp;
          <a href="{!! action('UserController@rewishDetails', $gi['id']) !!}" data-toggle="tooltip" data-placement="top" title="Rewish"><span class="fa fa-retweet"></span></a>
          &nbsp;&nbsp;
          <a href="#" class="mb-control" data-box="#mb-deletewish{!! $gi['id'] !!}" data-toggle="tooltip" data-placement="top" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
        </div>
      </div>
      <!-- end of panel body -->
    </div>
    @endforeach
@endif

<!-- message box-->
@if(isset($given))
  @foreach($given as $gi)
    <div class="message-box animated fadeIn" data-sound="alert" id="mb-deletewish{!! $gi['id'] !!}">
        <div class="mb-container">
            <div class="mb-middle">
                <div class="mb-title"><span class="glyphicon glyphicon-trash"></span>Delete Wish</div>
                <div class="mb-content">
                    <p>Are you sure you want to delete this wish?</p>
                </div>
                <div class="mb-footer">
                    @if(!empty($gi))
                    <div class="pull-right">
                        <a href="{!! action('UserController@deleteWish', $gi['id']) !!}" class="btn btn-success btn-lg">Yes</a>
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
