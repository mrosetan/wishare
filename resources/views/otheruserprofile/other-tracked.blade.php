@extends('userlayouts-master.other-master')
@section('title', 'Tracked')
@section('newcontent')
<br />
@if(isset($tracked))
    @foreach($tracked as $tr)
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="pull-left">
          <a href="#">
            <img class="user stream img-circle" src="{!! $otherUser['imageurl'] !!}">
          </a>
          <b>{!! $otherUser['firstname'] !!} {!! $otherUser['lastname'] !!}</b> tracked a wish: <b><a href="{!! action('SoloWishController@wish', $tr->wish['id'] ) !!}">{!! $tr->wish['title'] !!}</a></b>
          <br />
            <b>Date: </b>{!! date('F d, Y g:i A', strtotime($tr['updated_at']))  !!}
          <br />
            <!-- <b>Wishlist: </b> <a href="{!! action('ProfileController@wishes', $tr->wishlist['id']) !!}">{!! $tr->wishlist['title'] !!}</a> -->
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
          <span data-wishid="{!! $tr['id']!!}" data-toggle="tooltip" data-placement="top" title="Favorite" class="favorite" data-favestatus="{!! !empty($tr['favorited']) ? 'unfave' : 'favorite' !!}"><span class="fa fa-star {!! !empty($tr['favorited']) ? 'favorited-icon' : 'unfave-icon' !!}"></span> <span class="count">{!! $tr['faves'] !!}</span> </span>
          &nbsp;&nbsp;
          <!-- <a href="#"><span class="fa fa-bookmark"></span></a> -->
          <span data-wishid="{!! $tr['id']!!}" data-toggle="tooltip" data-placement="top" title="Track Wish" class="trackwish" data-trackstatus="{!! !empty($tr['tracked']) ? 'untrack' : 'trackwish' !!}"><span class="fa fa-bookmark {!! !empty($tr['tracked']) ? 'tracked-icon' : 'untracked-icon' !!}"></span> <span class="count">{!! $tr['tracks'] !!}</span> </span>
          &nbsp;&nbsp;
          <a href="{!! action('UserController@rewishDetails', $tr['id']) !!}" data-toggle="tooltip" data-placement="top" title="Rewish"><span class="fa fa-retweet"></span></a>
        </div>
      </div>
      <!-- end of panel body -->
    </div>
    @endforeach
@endif


@endsection
