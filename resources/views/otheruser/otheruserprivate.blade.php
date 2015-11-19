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
                <div class="lock-container">
                  <span class="fa fa-lock otheruser"></span><br />
                  <h4 class="text-center">Account is private</h4>
                </div>
              </div>
                <div class="tab-pane" id="tab-granted">
                  <div class="lock-container">
                    <span class="fa fa-lock otheruser"></span><br />
                    <h4 class="text-center">Account is private</h4>
                  </div>
                </div>
                <div class="tab-pane" id="tab-given">
                  <div class="lock-container">
                    <span class="fa fa-lock otheruser"></span><br />
                    <h4 class="text-center">Account is private</h4>
                  </div>
                </div>
                <div class="tab-pane" id="tab-friends">
                  <div class="lock-container">
                    <span class="fa fa-lock otheruser"></span><br />
                    <h4 class="text-center">Account is private</h4>
                  </div>
                </div>
                <div class="tab-pane" id="tab-tracked">
                  <div class="lock-container">
                    <span class="fa fa-lock otheruser"></span><br />
                    <h4 class="text-center">Account is private</h4>
                  </div>
                </div>
                <div class="tab-pane" id="tab-ty">
                  <div class="lock-container">
                    <span class="fa fa-lock otheruser"></span><br />
                    <h4 class="text-center">Account is private</h4>
                  </div>
                </div>
            </div>
        </div>
        <!-- END TABS -->
    </div>
  </div>
</div>
@endsection
