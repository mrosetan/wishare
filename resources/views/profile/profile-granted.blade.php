@extends('userlayouts-master.profile-master')
@section('title', 'Granted')
@section('newcontent')
<br />
@if(count($granted) > 0)
    @foreach($granted as $gr)
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="pull-left">
          <a href="#">
            <div class="user stream image-circle">
              <img class="user stream img-circle" src="{!! $user['imageurl'] !!}">
            </div>
          </a>
          <p class="profile-header">
          <b>{{ $user['firstname'] }} {{ $user['lastname'] }}</b>'s wish has been granted: <b><a href="{!! action('SoloWishController@wish', $gr['id'] ) !!}">{{ $gr['title'] }}</a></b>
          <br />
            <b>Date: </b>{!! date('F d, Y g:i A', strtotime($gr['updated_at']))  !!}
          <br />
            <b>Wishlist: </b> <a href="{!! action('WishlistController@wishes', $gr->wishlist['id']) !!}">{{ $gr->wishlist['title'] }}</a>
          <br />
            <b>Granted by: </b><a href="{!! action('UserProfilesController@profile', $gr->granter['id']) !!}">{{ $gr->granter['firstname'] }}  {{ $gr->granter['lastname'] }}</a>
          </p>
        </div>
        <br/><br /><br />
        <hr />
        <h4>{{ $gr['granteddetails'] }}</h4>
        @if(empty($gr['grantedimageurl']))
          <div></div>
        @endif
        @if(!empty($gr['grantedimageurl']))
        <div class="wish-image-container">
          <img src="{!! $gr['grantedimageurl'] !!}" class="wish-image" />
        </div>
        <hr />
        @endif
        <br />
        <div class="wish-icons pull-right">
          <!-- <a href="#"><span class="fa fa-star"></span></a> -->
          <span data-wishid="{!! $gr['id']!!}" data-toggle="tooltip" data-placement="top" title="Favorite" class="favorite" data-favestatus="{!! !empty($gr['favorited']) ? 'unfave' : 'favorite' !!}"><span class="fa fa-star {!! !empty($gr['favorited']) ? 'favorited-icon' : 'unfave-icon' !!}"></span> <span class="count">{!! $gr['faves'] !!}</span> </span>
          &nbsp;&nbsp;
          <a href="{!! action('UserController@rewishDetails', $gr['id']) !!}" data-toggle="tooltip" data-placement="top" title="Rewish"><span class="fa fa-retweet"></span></a>
          &nbsp;&nbsp;
          <a href="#" class="mb-control" data-box="#mb-deletewish{!! $gr['id'] !!}" data-toggle="tooltip" data-placement="top" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
        </div>
      </div>
      <!-- end of panel body -->
    </div>
    @endforeach
@else
<div class="panel panel-default">
  <div class="panel-body">
    No granted wishes.
  </div>
</div>
@endif

<!-- message box-->
@if(isset($granted))
  @foreach($granted as $g)
    <div class="message-box animated fadeIn" data-sound="alert" id="mb-deletewish{!! $g->id !!}">
        <div class="mb-container">
            <div class="mb-middle">
                <div class="mb-title"><span class="glyphicon glyphicon-trash"></span>Delete Wish</div>
                <div class="mb-content">
                    <p>Are you sure you want to delete this wish?</p>
                </div>
                <div class="mb-footer">
                    @if(!empty($granted))
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
