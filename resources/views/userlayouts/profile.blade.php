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
              @if(session('wishStatus'))
                <div class="alert alert-success">
                    {{ session('wishStatus') }}
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
                        <a href="#" data-toggle="modal" data-target="#modal_addwish{!! $wishlist->id !!}"><span class="fa fa-plus"></span></a>
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
                          <!-- {!! $wishlist->wishes !!} -->
                          @foreach($wishlist->wishes as $wish)
                          <div class="panel panel-wishes">
                            <a href="{{ action('UserController@wish', $wish->id ) }}" class="wish-name">{!! $wish->title !!}</a>
                            <div class="wish-icons pull-right">
                              <a href="#"><span class="fa fa-star"></span></a>
                              &nbsp;&nbsp;
                              <a href="#"><span class="fa fa-bookmark"></span></a>
                              &nbsp;&nbsp;
                              <a href="#" data-toggle="modal" data-target="#modal_rewish{!! $wish->id !!}"><span class="fa fa-retweet"></span></a>
                              &nbsp;&nbsp;
                              <!-- <a href="#"><span class="glyphicon glyphicon-edit"></span></a> -->
                              <a href="#" data-toggle="modal" data-target="#modalwish{!! $wish->id !!}"><span class="glyphicon glyphicon-edit"></span></a>
                              &nbsp;&nbsp;
                              <a href="{!! url('user/edit/tags', $wish->id) !!}"><span class="glyphicon glyphicon-tag"></span></a>
                              <!-- <a href="#" data-toggle="modal" data-target="#tagwish{!! $wish->id !!}"><span class="glyphicon glyphicon-tag"></span></a> -->
                              &nbsp;&nbsp;
                              <a href="#" class="mb-control" data-box="#mb-deletewish{!! $wish->id !!}"><span class="glyphicon glyphicon-trash"></span></a>
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
                  @if(isset($tynotes) and $tynotes->count())
                    @foreach($tynotes as $tyid => $ty)
                    <div class="panel-group accordion accordion-dc">
                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <h6 class="panel-title">
                            <a href="#tynote-content{!! $tyid !!}">
                              <h6>From {!! $ty->firstname!!} {!! $ty->lastname !!} - {!! date('m/d/y g:i A', strtotime($ty->pivot->updated_at)) !!}</h6>
                            </a>
                          </h6>
                          <div class="pull-right">
                            <a href="#" class="mb-control" data-box="#mb-deletetynote{!! $tyid !!}"><span class="glyphicon glyphicon-trash"></span></a>
                          </div>
                        </div>
                        <div class="panel-body" id="tynote-content{!! $tyid !!}">
                          <h5>{!! $ty->pivot->message !!}</h5>
                          <b>Sender:</b> {!! $ty->firstname !!} {!! $ty->lastname !!} <br />
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
                          <div class="pull-right">
                            <a href="#" class="mb-control" data-box="#mb-deletetynote{!! $tyid !!}"><button class="btn btn-info">Delete</button></a>
                          </div>
                        </div>
                      </div>
                    </div>
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

      <!-- =================================== WISHLIST =================================== -->

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

      <!-- =================================== WISHLIST =================================== -->



      <!-- =================================== WISHES =================================== -->

        <!-- message box-->
        @if(isset($wishlists))
          @foreach($wishlists as $wishlist)
            @if(count($wishlist->wishes)>0)
              @foreach($wishlist->wishes as $wish)
                <div class="message-box animated fadeIn" data-sound="alert" id="mb-deletewish{!! $wish->id !!}">
                    <div class="mb-container">
                        <div class="mb-middle">
                            <div class="mb-title"><span class="glyphicon glyphicon-trash"></span>Delete Wish</div>
                            <div class="mb-content">
                                <p>Are you sure you want to delete this wish?</p>
                            </div>
                            <div class="mb-footer">
                                @if(!empty($wishlist))
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
          @endforeach
        @endif
        <!--end of message box-->

        <!-- modal -->
        @if(isset($wishlists))
          @foreach($wishlists as $wishlist)
            @if(count($wishlist->wishes)>0)
              @foreach($wishlist->wishes as $wish)
                <div class="modal" id="modalwish{!! $wish->id !!}" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                          <h4>Edit Wish</h4>
                        </div>
                        <div class="modal-body">
                          @if(session('wishStatus'))
                            <div class="alert alert-success">
                                {{ session('wishStatus') }}
                            </div>
                          @endif
                          @foreach($errors->all() as $error)
                              <p class="alert alert-danger"> {{ $error }}</p>
                          @endforeach
                          {!! Form::open(array( 'action' => array('UserController@updateWish', $wish->id),
                                                'class' => 'form',
                                                'files'=>true,
                                                'enctype'=>'multipart/form-data')) !!}
                          <div class="form-group">
                            <div class="row">
                              <div class="col-md-12">
                                {!! Form::select('wishlist', $wishlistsList, $wish->wishlistid, array('class'=>'form-control'))!!}
                              </div>
                            </div>
                            <br />
                            <div class="row">
                              <div class="col-md-12">
                                {!! Form::text('title', $wish->title, array('class'=>'form-control', 'placeholder'=>'Wish')) !!}
                              </div>
                            </div>
                            <br />
                            <div class="row">
                              <div class="col-md-12">
                                {!! Form::textarea('description', $wish->details, ['class'=>'form-control ', 'placeholder'=>'Details or specifics about the wish', 'size'=>'102x5']) !!}
                              </div>
                            </div>
                            <br />
                            <div class="row">
                              <div class="col-md-12">
                                {!! Form::textarea('alternatives', $wish->alternatives, ['class'=>'form-control ', 'placeholder'=>'Wish alternatives', 'size'=>'102x5']) !!}
                              </div>
                            </div>
                            <br />
                            <div class="row">
                              <div class="col-sm-12">
                                <label>Due Date</label>
                                {!! Form::text('due_date', $wish->due_date, array('id'=>'datepicker', 'class'=>'form-control')) !!}
                              </div>
                            </div>
                            <br />
                            <div class="row">
                              <div class="col-sm-12">
                                {!! Form::file('wishimageurl', array('class'=>'fileinput btn btn-info')) !!}
                              </div>
                            </div>
                            <br />
                            <div class="row">
                              <div class="col-md-12">
                                @if($wish->flagged ==  1)
                                  {!! Form::checkbox('flag', '1', true) !!}
                                @else
                                  {!! Form::checkbox('flag', '1') !!}
                                @endif
                                <label><span class="glyphicon glyphicon-flag"></span> Flag </label>
                                <!-- <span class="glyphicon glyphicon-flag"></span><a href="#"><span class="xn-text">&nbsp;Flag wish</span></a> -->
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-12">
                                <div class="pull-right">
                                  {!! Form::submit('Update', array('class'=>'btn btn-info')) !!}
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
          @endif
        @endforeach
      @endif

      <!--  ======================================ADD WISH MODAL=============================-->
      @if(isset($wishlists))
        @foreach($wishlists as $id => $wishlist)
          @foreach($wishlist->wishes as $wish)
          <div class="modal" id="modal_addwish{!! $wishlist->id !!}" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4>Add Wish</h4>
                  </div>
                  <div class="modal-body">
                    @if(session('wishStatus'))
                      <div class="alert alert-success">
                          {{ session('wishStatus') }}
                      </div>
                    @endif
                    @foreach($errors->all() as $error)
                        <p class="alert alert-danger"> {{ $error }}</p>
                    @endforeach
                    {!! Form::open(array( 'action' => array('UserController@addWishModal', $wishlist->id), 'class' => 'form', 'files'=>true)) !!}
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-12">
                          {!! Form::text('wishlist', $wishlist->title, array('class'=>'form-control', 'disabled'=>'true')) !!}
                        </div>
                      </div>
                      <br />
                      <div class="row">
                        <div class="col-md-12">
                          {!! Form::text('title', null, array('class'=>'form-control', 'placeholder'=>'Wish')) !!}
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
                      <div class="row">
                        <div class="col-sm-12">
                          <label>Due Date:</label>
                          {!! Form::text('due_date', date('Y-m-d'), array('id'=>'datepicker', 'class'=>'form-control')) !!}
                        </div>
                      </div>
                      <br />
                      <div class="row">
                        <div class="col-sm-12">
                          <label>Upload:</label><br />
                          {!! Form::file('wishimageurl', array('class'=>'fileinput btn btn-info')) !!}
                        </div>
                      </div>
                      <br />
                      <div class="row">
                        <div class="col-md-12">
                          <label>Tag:</label>
                          <select class="my-select" name="tags[]" multiple="multiple">
                            @foreach($friends as $f)
                              <option value="{!! $f->id !!}">{!! $f->firstname !!} {!! $f->lastname !!} ({!! $f->username !!})</option>

                            @endforeach
                          </select>
                        </div>
                      </div>
                      <br />
                      <div class="row">
                        <div class="col-md-12">
                          {!! Form::checkbox('flag', '1', ['class'=>'form-control ']) !!}
                          <label><span class="glyphicon glyphicon-flag"></span> Flag </label>
                          <!-- <span class="glyphicon glyphicon-flag"></span><a href="#"><span class="xn-text">&nbsp;Flag wish</span></a> -->
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="pull-right">
                            {!! Form::submit('Add', array('class'=>'btn btn-info')) !!}
                            {!! Form::button('Cancel', array('class'=>'btn btn-default mb-control-close')) !!}
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
      @endforeach
    @endif

    @if(count($wishlistsRewish)>0)
      <div class="modal" id="modal_rewish{!!$wish->id!!}" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
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

                    {!! Form::open(array('action'=>array('UserController@reWish', $wish->id), 'class' => 'form', 'files'=>true)) !!}

                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-12">
                          {!! Form::select('wishlist', $wishlistsRewish
                          , null, array('class'=>'form-control'))!!}
                        </div>
                      </div>
                      <br />
                      <div class="row">
                        <div class="col-md-12">
                          {!! Form::text('title', $wish->title, array('class'=>'form-control', 'placeholder'=>'Wish', 'disabled'=>'true')) !!}
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
                      <div class="row">
                        <div class="col-sm-12">
                          <label>Due Date:</label>
                          {!! Form::text('due_date', date('Y-m-d'), array('id'=>'datepicker', 'class'=>'form-control')) !!}
                        </div>
                      </div>
                      <br />
                      <div class="row">
                        <div class="col-sm-12">
                          <label>Upload:</label><br />
                          {!! Form::file('wishimageurl', array('class'=>'fileinput btn btn-info')) !!}
                        </div>
                      </div>
                      <br />
                      <div class="row">
                        <div class="col-md-12">
                          <label>Tag:</label>
                          <select class="my-select" name="tags[]" multiple="multiple">
                            @foreach($friends as $f)
                              <option value="{!! $f->id !!}">{!! $f->firstname !!} {!! $f->lastname !!} ({!! $f->username !!})</option>

                            @endforeach
                          </select>


                        </div>
                      </div>

                      <br />
                      <div class="row">
                        <div class="col-md-12">
                          {!! Form::checkbox('flag', '1', ['class'=>'form-control ']) !!}
                          <label><span class="glyphicon glyphicon-flag"></span> Flag </label>

                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="pull-right">
                            {!! Form::submit('Add', array('class'=>'btn btn-info')) !!}
                            {!! Form::button('Cancel', array('class'=>'btn btn-default mb-control-close')) !!}
                          </div>
                        </div>
                      </div>
                    </div>



                    {!! Form::close() !!}


                  </div>
              </div>
          </div>
      </div>

    @else
      <div class="message-box animated fadeIn open" id="mb-wishlist">
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
                          <!-- <button class="btn btn-default btn-lg mb-control-close">No</button> -->
                      </div>
                  </div>
              </div>
          </div>
      </div>

    @endif
    <!--  Rewish  -->
    </div>
  </div>
</div>
@endsection
