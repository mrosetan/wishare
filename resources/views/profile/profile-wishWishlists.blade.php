@extends('userlayouts-master.profile-master')
@section('title', 'Wishlists and Wishes')
@section('newcontent')
<br />
@if(isset($wishlists))
  @foreach($wishlists as $wishlist)
  <div class="panel panel-default">
    <div class="panel-body">
        <h3>
          @if($wishlist->privacy == 0)
          <span class="fa fa-magic"></span>&nbsp;<a href="{!! action('WishlistController@wishes', $wishlist['id']) !!}">{{ $wishlist['title'] }}</a>
          <div class="wishlist-icons pull-right">
            <a href="#" data-toggle="modal" data-target="#modal_{!! $wishlist['id'] !!}"><span class="glyphicon glyphicon-edit"></span></a>
            &nbsp;&nbsp;
            <a href="#" class="mb-control" data-box="#mb-delete{!! $wishlist['id'] !!}"><span class="glyphicon glyphicon-trash"></span></a>
            &nbsp;&nbsp;
            <a href="{!! action('UserController@wishAction') !!}"><span class="glyphicon glyphicon-plus"></span></a>
          </div>
          @elseif($wishlist->privacy == 1)
            <span class="fa fa-lock"></span>&nbsp;<a href="{!! action('WishlistController@wishes', $wishlist['id']) !!}">{{ $wishlist['title'] }}</a>
            <div class="wishlist-icons pull-right">
              <a href="#" data-toggle="modal" data-target="#modal_{!! $wishlist['id'] !!}"><span class="glyphicon glyphicon-edit"></span></a>
              &nbsp;&nbsp;
              <a href="#" class="mb-control" data-box="#mb-delete{!! $wishlist['id'] !!}"><span class="glyphicon glyphicon-trash"></span></a>
              &nbsp;&nbsp;
              <a href="{!! action('UserController@wishAction') !!}"><span class="glyphicon glyphicon-plus"></span></a>
            </div>
          @endif
        </h3>

    </div>
  </div>
  @endforeach
@endif

<!-- message box-->
@if(isset($wishlists))
  @foreach($wishlists as $id => $wishlist)
  <div class="message-box animated fadeIn" data-sound="alert" id="mb-delete{!! $wishlist['id'] !!}">
      <div class="mb-container">
          <div class="mb-middle">
              <div class="mb-title"><span class="glyphicon glyphicon-trash"></span>Delete Wishlist</div>
              <div class="mb-content">
                  <p>Are you sure you want to delete this wishlist?</p>
              </div>
              <div class="mb-footer">
                  @if(!empty($wishlist))
                  <div class="pull-right">
                      <a href="{!! action('UserController@deleteWishlist', $wishlist['id']) !!}" class="btn btn-success btn-lg">Yes</a>
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

@if(isset($wishlists))
  @foreach($wishlists as $id => $wishlist)
  <div class="modal" id="modal_{!! $wishlist['id'] !!}" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4>Edit Wishlist</h4>
          </div>
          <div class="modal-body">
            @if(session('wishlistSettings'))
              <div class="alert alert-success">
                  {{ session('wishlistSettings') }}
              </div>
            @endif
            @foreach($errors->all() as $error)
                <p class="alert alert-danger"> {{ $error }}</p>
            @endforeach
            {!! Form::open(array(
                          'action' => array('UserController@updateWishlist', $wishlist->id),
                          'class' => 'form')) !!}
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    {!! Form::text('title', $wishlist->title, array('required', 'class'=>'form-control', 'placeholder'=>'Title')) !!}
                  </div>
                </div>
                <br />
                <label>Privacy</label>
                <div class="row">
                  <div class="col-md-12">
                    {!! Form::radio('privacy', '0', true)!!}&nbsp;Public
                    <br />
                    {!! Form::radio('privacy', '1')!!}&nbsp;Private
                  </div>
                </div>
                <br/ >
                <div class="row">
                  <div class="col-md-12">
                    <div class="pull-right">
                      {!! Form::submit('Update', array('class'=>'btn btn-info')) !!}
                    </div>
                  </div>
                </div>
              {!! Form::close() !!}
          </div>
      </div>
    </div>
  </div>
</div>
@endforeach
@endif

@endsection
