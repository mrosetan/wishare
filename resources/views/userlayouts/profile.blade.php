@extends('userlayouts-master.user-master')
@section('title', 'Profile')

@section('content')
<div class="page-content-wrap">
  <div class="row">
    <div class="profile-header">
      <div class="pull-left">
        <!-- {!! Html::image($user->imageurl, '', array('class'=>'profile-img img-circle')) !!} -->
        <img class="profile-img img-circle" src="{!! $user->imageurl !!}" />
      </div>
      <div class="userprofile-details">
        <h4 class="userprofile-name">
          <b>{!! $user->firstname!!} {!! $user->lastname!!}</b>
        </h4>
        <h5 class="userprofile-addr">
          {!! $user->city !!}
        </h5>
      </div>
    </div>
  </div>
  <div class="row">
    <br /><br />
    <div class="col-md-12">
        <!-- START TABS -->
        <div class="panel panel-default tabs">
            <ul class="nav nav-tabs nav-justified" role="tablist" id="myTab">
              <li class="active"><a href="#tab-wishes" role="tab" data-toggle="tab">Wishes</a></li>
              <li><a href="#tab-granted" role="tab" data-toggle="tab">Granted</a></li>
              <li><a href="#tab-given" role="tab" data-toggle="tab">Given</a></li>
              <li><a href="#tab-friends" role="tab" data-toggle="tab">Friends</a></li>
              <li><a href="#tab-tracked" role="tab" data-toggle="tab">Tracked</a></li>
              <li><a href="#tab-ty" role="tab" data-toggle="tab">Thank You Notes</a></li>
            </ul>
            <br />
            <div class="panel-body tab-content">
              <div class="tab-pane active" id="tab-wishes">
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
                      <p class="panel-title">
                        @if($wishlist->privacy == 0)
                          <a href="#accOneColOne{!! $wishlist->id !!}">
                            {!! $wishlist->title !!}
                          </a>
                        @else
                          <a href="#accOneColOne{!! $wishlist->id !!}">
                            <span class="fa fa-lock"></span> {!! $wishlist->title !!}
                          </a>
                        @endif
                      </p>
                      <div class="wishlist-icons pull-right">
                        <a href="#"><span class="fa fa-plus"></span></a>
                        &nbsp;&nbsp;
                        <a href="#" data-toggle="modal" data-target="#modal_{!! $id !!}"><span class="glyphicon glyphicon-edit"></span></a>
                        &nbsp;&nbsp;
                        <a href="#" class="mb-control" data-box="#mb-delete{!! $wishlist->id !!}"><span class="glyphicon glyphicon-trash"></span></a>
                        &nbsp;&nbsp;
                        <div class="fb-share-button" data-href="http://www.9gag.com" data-layout="icon"></div> <!-- URL of site -->
                      </div>
                    </div>
                    @if(count($wishlist->wishes)>0)
                        <div class="panel-body" id="accOneColOne{!! $wishlist->id !!}">
                          @foreach($wishlist->wishes as $wish)
                          <div class="panel panel-wishes">
                            <a href="{{ action('UserController@wish', $wish->id ) }}" class="wish-name">{!! $wish->title !!}</a>
                            <div class="wish-icons pull-right">
                              <a href="#"><span class="fa fa-star"></span></a>
                              &nbsp;&nbsp;
                              <a href="#"><span class="fa fa-bookmark"></span></a>
                              &nbsp;&nbsp;
                              <a href="#"><span class="fa fa-retweet"></span></a>
                            </div>
                          </div>
                          @endforeach
                        </div>


                    @endif
                  </div>
                </div>
                @endforeach
                @else
                <div class="alert alert-danger">
                    No Wishlists.
                </div>
                @endif
              </div>
              <!--end of wishes-->
              <div class="tab-pane" id="tab-granted">
                <div class="panel-group accordion accordion-dc">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a href="#accTwoColOne">
                                    Bobby's Attention
                                </a>
                            </h4>
                            <div class="grant-icon pull-right">
                              <a href="#"><span class="fa fa-star"></span></a>
                            </div>
                        </div>
                        <div class="panel-body" id="accTwoColOne">
                          <img src="{{ URL::asset('img/test.jpg') }}">
                        </div>
                    </div>
                  </div>
              </div>
              <div class="tab-pane" id="tab-given">
                <div class="panel-group accordion accordion-dc">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a href="#accTwoColTwo">
                                  Brenda Mage granted Bobby's wish of: Razer Keyboard
                                </a>
                            </h4>
                        </div>
                        <div class="panel-body" id="accTwoColTwo">
                          <h4>Details:</h4> <br />
                          Wishlist: Personal <br />
                          Granted on: 1/1/14
                        </div>
                    </div>
                  </div>
              </div>
                <div class="tab-pane" id="tab-friends">
                  @if(isset($friends) and count($friends) > 0)
                    @foreach($friends as $friend)
                      <div class="panel-group ">
                          <div class="panel panel-default">
                              <div class="panel-heading">
                                  <p class="panel-title">
                                      <a href="#accTwoColTwo">
                                        <div class="pull-left">
                                          {!! Html::image('' . $friend['imageurl'], '', array('class'=>'user-friend img-circle')) !!}
                                        </div>
                                      </a>
                                      <a href="{!! action('UserController@otheruser', $friend['id']) !!}">
                                      <div class="user-details">
                                        <p class="user-name">
                                          {!! $friend['firstname'] !!} {!! $friend['lastname'] !!}
                                          <br />
                                            {!! $friend['username'] !!}
                                        </p>
                                      </div>
                                      </a>
                                  </p>
                              </div>
                          </div>
                        </div>
                      @endforeach
                      @else
                      <div class="alert alert-danger">
                          No Friends.
                      </div>
                      @endif
                </div>
                <div class="tab-pane" id="tab-tracked">
                  <div class="panel-group accordion accordion-dc">
                      <div class="panel panel-default">
                          <div class="panel-heading">
                              <p class="panel-title">
                                <p href="#accTwoColTwo">
                                  <p class="user-given">Razer Mouse</p> <br />
                                  Wished by: Bobby
                                </p>
                              </p>
                            </p>
                        </div>
                    </div>
                  </div>
              </div>
              <div class="tab-pane" id="tab-ty">
                <div class="panel-group accordion accordion-dc">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          <h4 class="panel-title">
                              <a href="#accTwoColThree">
                                  Sent by Bobby
                              </a>
                          </h4>
                        </div>
                        <div class="panel-body" id="accTwoColThree">
                          <h4>Thank you for this! <3 ;)</h4>
                          <img src="{{ URL::asset('img/test.jpg') }}">
                        </div>
                    </div>
                  </div>
              </div>
            </div>
        </div>
        <!-- END TABS -->
        <!-- message box-->
        @if(isset($wishlists))
        @foreach($wishlists as $id => $wishlist)
        <div class="message-box animated fadeIn" data-sound="alert" id="mb-delete{!! $wishlist->id !!}">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="glyphicon glyphicon-trash"></span>Delete Wishlist</div>
                    <div class="mb-content">
                        <p>Are you sure you want to delete this wishlist?</p>
                    </div>
                    <div class="mb-footer">
                        @if(!empty($wishlist))
                        <div class="pull-right">
                            <a href="{!! action('UserController@deleteWishlist', $wishlist->id) !!}" class="btn btn-success btn-lg">Yes</a>
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
        <!--  settings modal   -->
        @if(isset($wishlists))
        @foreach($wishlists as $id => $wishlist)
        <div class="modal" id="modal_{!! $id !!}" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
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
  </div>
</div>
@endsection
