@extends('userlayouts-master.profile-master')
@section('title', 'Wishlist')
@section('newcontent')

@if(isset($wishlists))
  @foreach($wishlists as $wishlist)
  <div class="wish-gallery-container">
    <div class="page-title">
        <h3><span class="fa fa-magic"></span> {!! $wishlist['title'] !!} </h3>
      <div class="gallery" id="links">
        @foreach($wishlist->wishes as $wish)
          <div class="gallery-item">
              <a href="{!! action('UserController@wish', $wish['id'] ) !!}" title="{!! $wish['title'] !!}">
                <div class="image image-container">
                    <img src="{!! $wish['wishimageurl'] !!}" alt="{!! $wish['title'] !!}"/>
                </div>
              </a>
              <div class="meta">
                <strong>{!! $wish['title'] !!}</strong>
              </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
  @endforeach
@endif
<!-- BLUEIMP GALLERY -->
<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>
<!-- END BLUEIMP GALLERY -->

@endsection
