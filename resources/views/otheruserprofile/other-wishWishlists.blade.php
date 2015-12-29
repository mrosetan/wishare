@extends('userlayouts-master.other-master')
@section('title', 'Wishlists and Wishes')
@section('newcontent')
<br />
@if(isset($wishlists))
  @foreach($wishlists as $wishlist)
  <div class="panel panel-default">
    <div class="panel-body">
        <h3><span class="fa fa-magic"></span>&nbsp;<a href="{!! action('OtherUserController@wishes', $wishlist->id) !!}">{!! $wishlist['title'] !!}</a></h3>
    </div>
  </div>
  @endforeach
@endif

@endsection
