@extends('userlayouts-master.other-master')
@section('title', 'Granted')
@section('newcontent')
<br />
@if(count($granted) > 0)
    @foreach($granted as $gr)
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="pull-left">
          <a href="#">
            <img class="user stream img-circle" src="{!! $otherUser['imageurl'] !!}">
          </a>
          <b>{!! $otherUser['firstname'] !!} {!! $otherUser['lastname'] !!}</b>'s wish has been granted: <b><a href="{!! action('UserController@wish', $gr['id'] ) !!}">{!! $gr['title'] !!}</a></b>
          <br />
            <b>Date: </b>{!! date('F d, Y g:i A', strtotime($gr['updated_at']))  !!}
          <br />
            <b>Wishlist: </b> <a href="{!! action('ProfileController@wishes', $gr->wishlist['id']) !!}">{!! $gr->wishlist['title'] !!}</a>
          <br />
            <b>Granted by: </b><a href="{!! action('UserController@otheruser', $gr->granter['id']) !!}">{!! $gr->granter['firstname'] !!}  {!! $gr->granter['lastname'] !!}</a>
        </div>
        <br/><br /><br />
        <hr />
        <h4>{!! $gr['granteddetails'] !!}</h4>
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
          <!-- <a href="#"><span class="fa fa-bookmark"></span></a> -->
          <span data-wishid="{!! $gr['id']!!}" data-toggle="tooltip" data-placement="top" title="Track Wish" class="trackwish" data-trackstatus="{!! !empty($gr['tracked']) ? 'untrack' : 'trackwish' !!}"><span class="fa fa-bookmark {!! !empty($gr['tracked']) ? 'tracked-icon' : 'untracked-icon' !!}"></span> <span class="count">{!! $gr['tracks'] !!}</span> </span>
          &nbsp;&nbsp;
          <a href="{!! action('UserController@rewishDetails', $gr['id']) !!}" data-toggle="tooltip" data-placement="top" title="Rewish"><span class="fa fa-retweet"></span></a>
          <!-- &nbsp;&nbsp;
          <a href="#" class="mb-control" data-box="#mb-deletewish{!! $gr['id'] !!}" data-toggle="tooltip" data-placement="top" title="Delete"><span class="glyphicon glyphicon-trash"></span></a> -->
        </div>
      </div>
      <!-- end of panel body -->
    </div>
    @endforeach
@endif

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

@endsection
