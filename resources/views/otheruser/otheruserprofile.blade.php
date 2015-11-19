@extends('userlayouts-master.user-master')
@section('title', 'Other User Profile')

@section('content')
<div class="page-content-wrap">
  <div class="row">
    <div class="profile-header">
      <div class="pull-left">
        <img class="profile-img img-circle" src="{{ URL::asset('img/test2.jpg') }}">
      </div>
      <div class="userprofile-details">
        <h4 class="userprofile-name">
          <b>{!! $otherUser->id!!} {!! $otherUser->firstname!!} {!! $otherUser->lastname!!}</b>
          <br />
        </h4>
        <h5 class="userprofile-addr">
          Cebu City, Philippines
        </h5>
          @if(count($friend) == 0)
            <a href="{!! action('UserController@addFriend', $otherUser->id) !!}" class="btn btn-info btn-default">Add as Friend</a>
          @else
            @if($status == 0)
              <a href="{!! action('UserController@unfriend', $otherUser->id) !!}" class="btn btn-info btn-default">Cancel Friend Request</a>
            @endif
            @if($status == 1)
              <a href="{!! action('UserController@unfriend', $otherUser->id) !!}" class="btn btn-info btn-default">Unfriend</a>
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
                <div class="panel-group accordion accordion-dc">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a href="#accOneColOne">
                                Birthday
                            </a>
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
                    </div>
                    <!--  Rewish  -->
                    <div class="modal" id="modal_rewish" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
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
                    </div>
                    <!--  Grant  -->
                    <div class="modal" id="modal_grant" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
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
                </div>
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
                <div class="tab-pane" id="tab-friends">
                  <div class="panel-group accordion accordion-dc">
                      <div class="panel panel-default">
                          <div class="panel-heading">
                              <p class="panel-title">
                                  <a href="#accTwoColTwo">
                                    <div class="pull-left">
                                      <img class="user-friend img-circle" src="{{ URL::asset('img/test.jpg') }}">
                                    </div>
                                  </a>
                                  <div class="user-details">
                                    <p class="user-name">
                                      <a href="#">Brenda</a>
                                      <br />
                                      Wishes: 3&nbsp;Granted: 1&nbsp;Given: 1&nbsp;Friends: 2 &nbsp;Tracked: 2 &nbsp;Thank You Notes: 2
                                    </p>
                                  </div>
                              </p>
                          </div>
                      </div>
                    </div>
                </div>
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
                      <div class="panel panel-default">
                          <div class="panel-heading">
                            <h4 class="panel-title">
                                <a href="#accTwoColThree">
                                    Sent by Brenda
                                </a>
                            </h4>
                          </div>
                          <div class="panel-body" id="accTwoColThree">
                            <h4>Sprikitik! <3 ;)</h4>
                            <img src="{{ URL::asset('img/test.jpg') }}">
                          </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END TABS -->
    </div>
  </div>
</div>
@endsection
