@extends('userlayouts-master.profile-master')
@section('title', 'Wishlists and Wishes')
@section('newcontent')
<br />
@if(isset($wishlists))
  @foreach($wishlists as $wishlist)
  <div class="panel panel-default">
    <div class="panel-body">
        <h3>
          <span class="fa fa-magic"></span>&nbsp;<a href="{!! action('WishlistController@wishes', $wishlist->id) !!}">{!! $wishlist['title'] !!}</a>
          @if($wishlist->privacy == 1)
            <span class="pull-right fa fa-lock"></span>
          @endif
        </h3>

    </div>
  </div>
  @endforeach
@endif

@endsection
