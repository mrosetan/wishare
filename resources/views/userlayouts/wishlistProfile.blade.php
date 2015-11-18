@extends('userlayouts-master.user-master')
@section('title', 'Wishlists')

@section('content')
<br />
<div class="wishlist-container">
  <div class="panel panel-default">
    <div class="panel-heading">
    <h4><b>{!! $user->firstname !!} {!! $user->lastname !!}'s Wishlists<b></h4>
      @if(session('wishlistDelete'))
        <div class="alert alert-success">
            {{ session('wishlistDelete') }}
        </div>
      @endif
      @if(count($wishlists) > 0)
      @foreach($wishlists as $id => $wishlist)
      <div class="panel-group accordion accordion-dc">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
                <a href="#accOneColOne">
                  {!! $wishlist->title !!}
                </a>
            </h4>
            <div class="wishlist-icons pull-right">
              <a href="#"><span class="fa fa-plus"></span></a>
              &nbsp;&nbsp;
              <a href="#" data-toggle="modal" data-target="#modal_{!! $id !!}"><span class="glyphicon glyphicon-edit"></span></a>
              &nbsp;&nbsp;
              <a href="{!! action('UserController@deleteWishlist', $wishlist->id) !!}"><span class="glyphicon glyphicon-trash"></span></a>
            </div>
          </div>
          <div class="panel-body" id="accOneColOne">
            <a href="{{ url('user/wish') }}" class="wish-name">Bobby</a>
            <div class="wish-icons pull-right">
              <a href="#"><span class="fa fa-star"></span></a>
              &nbsp;&nbsp;
              <a href="#"><span class="fa fa-bookmark"></span></a>
              &nbsp;&nbsp;
              <a href="#"><span class="fa fa-retweet"></span></a>
            </div>
          </div>
        </div>
      </div>
      @endforeach
      @else
      <div class="alert alert-danger">
          No Wishlists.
      </div>
      @endif
    </div>
  </div>
</div>
@endsection
