@extends('userlayouts-master.user-master')
@section('title', 'Profile')

@section('content')
<div class="page-content-wrap">
  <div class="row">
    <div class="profile-header">
      <div class="pull-left">
        <img class="profile-img img-circle" src="{{ URL::asset('img/test.jpg') }}">
      </div>
      <div class="userprofile-details">
        <h4 class="userprofile-name">
          <b>{!! $user->firstname!!}&nbsp;{!! $user->lastname!!}</b>
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
            <ul class="nav nav-tabs nav-justified" role="tablist">
                <li class="active"><a href="#tab-profile" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-user"></span></a></li>
                <li><a href="#tab-wishes" role="tab" data-toggle="tab">Wishes</a></li>
                <li><a href="#tab-granted" role="tab" data-toggle="tab">Granted</a></li>
                <li><a href="#tab-given" role="tab" data-toggle="tab">Given</a></li>
                <li><a href="#tab-friends" role="tab" data-toggle="tab">Friends</a></li>
                <li><a href="#tab-tracked" role="tab" data-toggle="tab">Tracked</a></li>
                <li><a href="#tab-ty" role="tab" data-toggle="tab">Thank You Notes</a></li>
            </ul>
            <br />
            <div class="panel-body tab-content">
                <div class="tab-pane active" id="tab-profile">
                  <div class="panel panel-default">
                      <div class="panel-body">
                        <div class="pull-left">
                          <img class="user img-circle" src="{{ URL::asset('img/test.jpg') }}">
                        </div>
                        <div class="user-details">
                          <h5 class="user-name">
                            Brenda Mage
                            <br />
                            Wish: Bobby's Heart
                            <br />
                            Date: 10/2/2015
                          </h5>
                        </div>
                      </div>
                  </div>
                  <div class="panel panel-default">
                      <div class="panel-body">
                        <div class="pull-left">
                          <img class="user img-circle" src="{{ URL::asset('img/test.jpg') }}">
                        </div>
                        <div class="user-details">
                          <h5 class="user-name">
                            Brenda Mage
                            <br />
                            Wish: To date with Bobby
                            <br />
                            Date: 10/1/2015
                          </h5>
                        </div>
                      </div>
                  </div>
                </div>
                <div class="tab-pane" id="tab-wishes">
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
                                      <a href="#">Bobby</a>
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
                                  <p class="user-given">Razer Mouse</p> <br />
                                  Wished by: Bobby
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
    </div>
  </div>
</div>
@endsection
