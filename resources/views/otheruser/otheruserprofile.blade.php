@extends('userlayouts-master.user-master')
@section('title', 'Other User Profile')

@section('content')
<div class="page-content-wrap">
  <div class="row">
    <div class="profile-header">
      <div class="pull-left">
        {!! Html::image('' . $otherUser->imageurl, '', array('class'=>'profile-img img-circle')) !!}
      </div>
      <div class="userprofile-details">
        <h4 class="userprofile-name">
          <b>{!! $otherUser->id!!} {!! $otherUser->firstname!!} {!! $otherUser->lastname!!}</b>
          <br />
        </h4>
        <h5 class="userprofile-addr">
          {!! $otherUser->city!!}
        </h5>
        @if(count($requests)>0)
          @foreach($requests as $req)
            <div class="accept-or-decline">
              {!! Form::open(array(
                            'action' => array('UserController@acceptFriendRequest', $req->id),
                            'class' => 'form friendActions friend-action-button',
                            'method' => 'get')) !!}
                  {!! Form::submit('Accept', array('class'=>'btn btn-info btn-default')) !!}
              {!! Form::close() !!}
              {!! Form::open(array(
                            'action' => array('UserController@declineFriendRequest', $req->id),
                            'class' => 'form friendActions friend-action-button',
                            'method' => 'get')) !!}
                  {!! Form::submit('Decline', array('class'=>'btn btn-info btn-default')) !!}
              {!! Form::close() !!}
              <!-- <a href="{!! action('UserController@acceptFriendRequest', $req->id) !!}" class="btn btn-info">Accept</a>
              <a href="{!! action('UserController@declineFriendRequest', $req->id) !!}" class="btn btn-default">Decline</a> -->
            </div>
          @endforeach
        @else
          @if(isset($status) and ($status == 0 || $status == 1))

            @if($status == 0)
              {!! Form::open(array(
                            'action' => array('UserController@cancelFriendRequest', $otherUser->id),
                            'class' => 'form friendActions',
                            'method' => 'get')) !!}
                  {!! Form::submit('Cancel Friend Request', array('class'=>'btn btn-info btn-default')) !!}
              {!! Form::close() !!}
              <!-- <a href="{!! action('UserController@cancelFriendRequest', $otherUser->id) !!}" class="btn btn-info btn-default">Cancel Friend Request</a> -->
            @endif
            @if($status == 1)
              {!! Form::open(array(
                            'action' => array('UserController@unfriend', $otherUser->id),
                            'class' => 'form friendActions',
                            'method' => 'get')) !!}
                  {!! Form::submit('Unfriend', array('class'=>'btn btn-info btn-default')) !!}
              {!! Form::close() !!}
              <!-- <a href="{!! action('UserController@unfriend', $otherUser->id) !!}" class="btn btn-info btn-default">Unfriend</a> -->
            @endif
          @else
            {!! Form::open(array(
                          'action' => array('UserController@addFriend', $otherUser->id),
                          'class' => 'form friendActions',
                          'method' => 'get')) !!}
                {!! Form::submit('Add as Friend', array('class'=>'btn btn-info btn-default')) !!}
            {!! Form::close() !!}
            <!-- <a href="{!! action('UserController@addFriend', $otherUser->id) !!}" class="btn btn-info btn-default">Add as Friend</a> -->

          @endif
        @endif
      </div>
    </div>
  </div>
  <div class="row">
    <br /><br />
    <div class="col-md-12">
        <!-- START TABS -->
        <div class="panel panel-default tabs">
            <ul class="nav nav-tabs nav-justified" role="tablist">
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
              @if(session('wishDelete'))
                <div class="alert alert-success">
                    {{ session('wishDelete') }}
                </div>
              @endif
              @if(session('tagStatus'))
                <div class="alert alert-success">
                    {{ session('tagStatus') }}
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
                        <!-- @if($wishlist->privacy == 0)
                          <div class="fb-share-button" data-href="http://www.9gag.com" data-layout="icon"></div>
                        @endif -->
                      </div>
                    </div>
                    @if(count($wishlist->wishes)>0)
                      @if($wishlist->privacy == 0)
                        <div class="panel-body" id="accOneColOne{!! $wishlist->id !!}">
                          <!-- {!! $wishlist->wishes !!} -->
                          @foreach($wishlist->wishes as $wish)
                          <div class="panel panel-wishes">
                            <a href="{{ action('UserController@wish', $wish->id ) }}" class="wish-name">{!! $wish->title !!}</a>
                            <div class="wish-icons pull-right">
                              <a href="#"><span class="fa fa-star"></span></a>
                              &nbsp;&nbsp;
                              <a href="#"><span class="fa fa-bookmark"></span></a>
                              &nbsp;&nbsp;
                              <a href="{!! action('UserController@reWish', $wish->id) !!}"><span class="fa fa-retweet"></span></a>
                              &nbsp;&nbsp;
                              <a data-toggle="modal" data-target="#modal_grant{!!$wish->id!!}"><span class="fa fa-magic"></span></a>
                            </div>
                          </div>
                            <!-- <div class="message-box animated fadeIn open" id="mb-wishlist">
                                <div class="mb-container">
                                    <div class="mb-middle">
                                        <div class="mb-title"><span class="glyphicon glyphicon-pencil"></span> You don't have wishlists.</div>
                                        <div class="mb-content">
                                            <p>You need to create a wishlist.</p>
                                        </div>
                                        <div class="mb-footer">
                                            <div class="pull-right">
                                                <a href="{{ url('/user/action/wishlist') }}" class="btn btn-success btn-lg">Create Wishlist</a>
                                                <a href="{{ url('/user/home') }}" class="btn btn-success btn-lg">Go back to home</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->


                          <div class="modal" id="modal_grant{!!$wish->id!!}" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
                              <div class="modal-dialog">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4>Grant Wish</h4>
                                      </div>
                                      <div class="modal-body">
                                        @foreach($errors->all() as $error)
                                            <p class="alert alert-danger"> {{ $error }}</p>
                                        @endforeach
                                        {!! Form::open(array( 'class' => 'form')) !!}
                                        <div class="form-group">
                                          <div class="row">
                                            <div class="col-sm-12">
                                              <label>Wish</label>
                                              {!! Form::text('wish', null, array('class'=>'form-control', 'placeholder'=>'Bobby', 'disabled'=>'disabled')) !!}
                                            </div>
                                          </div>
                                          <br />
                                          <div class="row">
                                            <div class="col-sm-12">
                                              {!! Form::text('caption', null, array('class'=>'form-control', 'placeholder'=>'Caption'))!!}
                                            </div>
                                          </div>
                                          <br />
                                          <div class="row">
                                            {!! Form::file('photo')!!}
                                          </div>
                                          <br />
                                          <div class="row">
                                            <div class="col-md-12">
                                              <div class="pull-right">
                                                {!! Form::submit('Add', array('class'=>'btn btn-info')) !!}
                                                {!! Form::reset('Cancel', array('class'=>'btn btn-default')) !!}
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        {!! Form::close() !!}
                                      </div>
                                  </div>
                              </div>
                          </div>


                          @endforeach
                        </div>
                      @endif


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



                <!-- <div class="tab-pane active" id="tab-wishes">
                  @if(count($wishlists) > 0)
                    @foreach($wishlists as $id => $wishlist)
                      <div class="panel-group accordion accordion-dc">
                        <div class="panel panel-default">
                          <div class="panel-heading">
                              <h4 class="panel-title">
                                @if($wishlist->privacy == 0)
                                  <a href="#accOneColOne{!! $wishlist->id !!}">
                                    {!! $wishlist->title !!}
                                  </a>
                                @else
                                  <a href="#accOneColOne{!! $wishlist->id !!}">
                                    <span class="fa fa-lock"></span> {!! $wishlist->title !!}
                                  </a>
                                @endif
                              </h4>
                              <div class="wishlist-icons pull-right">
                                <a href="#"><span class="fa fa-plus"></span></a>
                                &nbsp;&nbsp;
                                <a href="#"><span class="fa fa-gear"></span></a>
                                &nbsp;&nbsp;
                                <a href="#"><span class="glyphicon glyphicon-trash"></span></a>
                              </div>
                          </div>
                          <div class="panel-body" id="accOneColOne">
                            <a href="{{ url('user/wish') }}" class="wish-name">Brenda</a>
                            <div class="wish-icons pull-right">
                              <a href="#"><span class="fa fa-star"></span></a>
                              &nbsp;&nbsp;
                              <a href="#"><span class="fa fa-bookmark"></span></a>
                              &nbsp;&nbsp;
                              <a data-toggle="modal" data-target="#modal_rewish"><span class="fa fa-retweet"></span></a>
                              &nbsp;&nbsp;
                              <a data-toggle="modal" data-target="#modal_grant"><span class="fa fa-magic"></span></a>
                            </div>
                          </div> -->
                          <!--  Rewish  -->
                          <!-- <div class="modal" id="modal_rewish" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
                              <div class="modal-dialog">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4>Re-Wish</h4>
                                      </div>
                                      <div class="modal-body">
                                        @foreach($errors->all() as $error)
                                            <p class="alert alert-danger"> {{ $error }}</p>
                                        @endforeach
                                        {!! Form::open(array( 'class' => 'form')) !!}
                                        <div class="form-group">
                                          <div class="row">
                                            <div class="col-md-12">
                                              {!! Form::select('wishlist', ['null'=>'-Wishlist-', 'Christmas', 'Personal', 'Birthday'], null, array('class'=>'form-control'))!!}
                                            </div>
                                          </div>
                                          <br />
                                          <div class="row">
                                            <div class="col-md-12">
                                              {!! Form::text('wish', null, array('class'=>'form-control', 'placeholder'=>'Bobby', 'disabled'=>'disabled')) !!}
                                            </div>
                                          </div>
                                          <br />
                                          <div class="row">
                                            <div class="col-md-12">
                                              {!! Form::textarea('description', null, ['class'=>'form-control ', 'placeholder'=>'Details or specifics about the wish', 'size'=>'102x5']) !!}
                                            </div>
                                          </div>
                                          <br />
                                          <div class="row">
                                            <div class="col-md-12">
                                              {!! Form::textarea('alternatives', null, ['class'=>'form-control ', 'placeholder'=>'Wish alternatives', 'size'=>'102x5']) !!}
                                            </div>
                                          </div>
                                          <br />
                                          <label>Tag</label>
                                          <div class="row">
                                            <div class="col-md-12">
                                              <div class="tag-container">
                                                {!! Form::checkbox('tag', 'tagged') !!}&nbsp;Bobby Baratheon
                                                <br>
                                                {!! Form::checkbox('tag', 'tagged') !!}&nbsp;Rosie Lannister
                                                <br>
                                                {!! Form::checkbox('tag', 'tagged') !!}&nbsp;Bobrys
                                              </div>
                                            </div>
                                          </div>
                                          <br />
                                          <div class="row">
                                            <span class="glyphicon glyphicon-flag"></span><a href="#"><span class="xn-text">&nbsp;Flag wish</span></a>
                                          </div>
                                          <div class="row">
                                            <div class="col-md-12">
                                              <div class="pull-right">
                                                {!! Form::submit('Add', array('class'=>'btn btn-info')) !!}
                                                {!! Form::reset('Cancel', array('class'=>'btn btn-default mb-control-close')) !!}
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        {!! Form::close() !!}
                                      </div>
                                  </div>
                              </div>
                          </div> -->
                          <!--  Grant  -->
                          <!-- <div class="modal" id="modal_grant" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
                              <div class="modal-dialog">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4>Grant Wish</h4>
                                      </div>
                                      <div class="modal-body">
                                        @foreach($errors->all() as $error)
                                            <p class="alert alert-danger"> {{ $error }}</p>
                                        @endforeach
                                        {!! Form::open(array( 'class' => 'form')) !!}
                                        <div class="form-group">
                                          <div class="row">
                                            <div class="col-sm-12">
                                              <label>Wish</label>
                                              {!! Form::text('wish', null, array('class'=>'form-control', 'placeholder'=>'Bobby', 'disabled'=>'disabled')) !!}
                                            </div>
                                          </div>
                                          <br />
                                          <div class="row">
                                            <div class="col-sm-12">
                                              {!! Form::text('caption', null, array('class'=>'form-control', 'placeholder'=>'Caption'))!!}
                                            </div>
                                          </div>
                                          <br />
                                          <div class="row">
                                            {!! Form::file('photo')!!}
                                          </div>
                                          <br />
                                          <div class="row">
                                            <div class="col-md-12">
                                              <div class="pull-right">
                                                {!! Form::submit('Add', array('class'=>'btn btn-info')) !!}
                                                {!! Form::reset('Cancel', array('class'=>'btn btn-default')) !!}
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        {!! Form::close() !!}
                                      </div>
                                  </div>
                              </div>
                          </div>
                        </div>
                      </div>
                      @endforeach
                    @else
                    @endif
                </div> -->







                <div class="tab-pane" id="tab-granted">
                  <div class="panel-group accordion accordion-dc">
                      <div class="panel panel-default">
                          <div class="panel-heading">
                              <h4 class="panel-title">
                                  <a href="#accTwoColOne">
                                      Brenda's Attention
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
                                    Bobby granted Brenda Mage's wish of: Bobby's Heart
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

                <!-- ================FRIENDS================== -->

                <div class="tab-pane" id="tab-friends">
                  @if(count($friends) > 0)

                    @foreach($friends as $friend)
                      <div class="panel-group accordion accordion-dc">
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

                <!-- ================FRIENDS================== -->

                <div class="tab-pane" id="tab-tracked">
                  <div class="panel-group accordion accordion-dc">
                      <div class="panel panel-default">
                          <div class="panel-heading">
                              <p class="panel-title">
                                <p href="#accTwoColTwo">
                                  <p class="user-given">Bobby's Answer</p> <br />
                                  Wished by: Brenda Mage
                                </p>
                              </p>
                          </div>
                      </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab-ty">
                  <div class="panel-group accordion accordion-dc">
                    @if(isset($tynotes) and $tynotes->count())
                      @foreach($tynotes as $tyid => $ty)
                      @foreach($friends as $fr)
                      <div class="panel-group accordion accordion-dc">
                        <div class="panel panel-default">
                          <div class="panel-heading">
                            <h6 class="panel-title">
                              <a href="#tynote-content{!! $tyid !!}">
                                <h6>From {!! $fr->firstname!!} {!! $fr->lastname !!} - {!! date('m/d/y g:i A', strtotime($ty->pivot->updated_at)) !!}</h6>
                              </a>
                            </h6>
                          </div>
                          <div class="panel-body" id="tynote-content{!! $tyid !!}">
                            <h5>{!! $ty->pivot->message !!}</h5>
                            <b>Sender:</b> {!! $fr->firstname !!} {!! $fr->lastname !!} <br />
                            <b>Received:</b> {!! date('F d, Y g:i A', strtotime($ty->pivot->updated_at)) !!}
                            <hr />
                            @if($ty->pivot->imageurl == 'null' and $ty->pivot->sticker == 'null')
                              <div></div>
                            @else
                              @if($ty->pivot->imageurl != 'null')
                                <div class="tynote-image-container">
                                  <img src="{!! $ty->pivot->imageurl!!}" class="tynote-image" />
                                </div>
                                <hr />
                              @elseif($ty->pivot->sticker != 'null')
                                <div class="tynote-sticker-container">
                                  <img src="{!! $ty->pivot->sticker !!}" class="tynote-sticker" />
                                </div>
                                <hr />
                              @else
                                <hr />
                              @endif
                            @endif
                          </div>
                        </div>
                      </div>
                      @endforeach
                      @endforeach

                      @else
                      <div class="alert alert-danger">
                          No Thank You Notes.
                      </div>
                      @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- END TABS -->
    </div>
  </div>
</div>
@endsection
