@extends('userlayouts-master.wishlists-master')
@section('title', 'Wishlist')
@section('content')
<br />
<div class="">
  <div class="row">
    <div class=" col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-body">
          @if(isset($wishlists))
            @foreach($wishlists as $wishlist)
            <div class="wish-gallery-container">
              <div class="page-title">
                  <h3><span class="fa fa-magic"></span> {!! $wishlist['title'] !!} </h3>
                  <b>Created by:</b> {!! $wishlist->user['firstname']!!} {!! $wishlist->user['lastname'] !!}
                  <br />
                  <div class="fb-share-button" data-href="http://www.wishare.net/wishlist/{!! $wishlist['id'] !!}" data-layout="icon"></div>
              </div>

              <div class="gallery" id="links">
                @foreach($wishlist->wishes as $wish)
                @if($wish['wishimageurl'] != null)
                  <div class="gallery-item">
                      <a href="{!! action('SoloWishController@wish', $wish['id'] ) !!}" title="{!! $wish['title'] !!}">
                        <div class="image image-container">
                            <img src="{!! $wish['wishimageurl'] !!}" alt="{!! $wish['title'] !!}" class="wishes-image"/>
                        </div>
                      </a>
                      <div class="meta">
                        <strong>{!! $wish['title'] !!}</strong>
                      </div>
                  </div>
                  @endif
                  @if($wish['wishimageurl'] == null)
                  <div class="gallery-item">
                      <a href="{!! action('SoloWishController@wish', $wish['id'] ) !!}" title="{!! $wish['title'] !!}">
                        <div class="image image-container">
                            <img src="{{ URL::asset('img/default/default.jpg') }}" alt="{!! $wish['title'] !!}" class="wishes-image"/>
                        </div>
                      </a>
                      <div class="meta">
                        <strong>{!! $wish['title'] !!}</strong>
                      </div>
                  </div>
                  @endif
                @endforeach
              </div>
            </div>
            @endforeach
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
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
