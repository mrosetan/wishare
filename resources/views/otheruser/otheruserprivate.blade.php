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
          Cebu City, Philippines
        </h5>
          @if(count($requests)>0)
            @foreach($requests as $req)
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
