@extends('userlayouts-master.user-master')
@section('title', 'Notifications')

@section('content')
<div class="page-title">
    <h2></h2>
</div>
<div class="notifications-container">
  <div class="page-content-wrap">
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default tabs">
            <ul class="nav nav-tabs nav-justified" role="tablist">
                <li class="active"><a href="#tab-notif" role="tab" data-toggle="tab">Activity</a></li>
                <li>
                  <a href="#tab-fr" role="tab" data-toggle="tab">Friend Requests
                    @if(count($requests) > 0)
                      <span class="badge badge-warning">{!! count($requests) !!}</span>
                    @endif
                  </a>
               </li>
               <li>
                 <a href="#tab-gr" role="tab" data-toggle="tab">Grant Requests
                   @if(count($grant) > 0)
                    <span class="badge badge-warning">{!! count($grant) !!}</span>
                   @endif
                 </a>
               </li>
            </ul>
            <br />
            <!--notifications-->
            <div class="panel-body tab-content">
              <div class="tab-pane active" id="tab-notif">
                @if(count($notifs)>0)
                  @foreach($notifs as $n)
                    @if($n->notificationtype == 'tagged')
                      <div class="panel panel-default">
                          <div class="panel-body">
                            <div class="pull-left">
                              {!! Html::image('' . $n->tagger->imageurl, '', array('class'=>'user-friend img-circle')) !!}
                            </div>
                            <div class="user-details">
                              <p class="user-name">
                                <a href="{!! action('UserController@otheruser', $n->tagger->id) !!}"> {!! $n->tagger->firstname !!} {!! $n->tagger->lastname !!} </a> tagged you in a <a href="{!! action('UserController@wish', $n->wish->id) !!}">wish</a>
                                <br/>
                                {!! date('F d, Y g:i A', strtotime($n->created_at)) !!}
                              </p>

                            </div>
                          </div>
                      </div>
                    @else
                      @if($n->user->id != $user->id)
                        <div class="panel panel-default">
                            <div class="panel-body">
                              <div class="pull-left">
                                {!! Html::image('' . $n->user->imageurl, '', array('class'=>'user-friend img-circle')) !!}
                              </div>
                              <div class="user-details">
                                <p class="user-name">
                                  <a href="{!! action('UserController@otheruser', $n->user->id) !!}"> {!! $n->user->firstname !!} {!! $n->user->lastname !!} </a> {!! $n->notificationtype !!} your <a href="{!! action('UserController@wish', $n->wish->id) !!}">wish</a>
                                  <br/>
                                  {!! date('F d, Y g:i A', strtotime($n->created_at)) !!}
                                </p>

                              </div>
                            </div>
                        </div>
                      @endif
                    @endif
                  @endforeach
                @endif
                <!-- @if(count($tags)>0)
                  @foreach($tags as $t)
                    <div class="panel panel-default">
                        <div class="panel-body">
                          <div class="pull-left">
                            {!! Html::image('' . $t->tagger->imageurl, '', array('class'=>'user-friend img-circle')) !!}
                          </div>
                          <div class="user-details">
                            <p class="user-name">
                              <a href="{!! action('UserController@otheruser', $t->tagger->id) !!}"> {!! $t->tagger->firstname !!} {!! $t->tagger->lastname !!} </a> tagged you in a <a href="{!! action('UserController@wish', $t->wish->id) !!}">wish</a>
                              <br/>
                              {!! date('m/d/y g:i A', strtotime($t->created_at)) !!}
                            </p>

                          </div>
                        </div>
                    </div>
                  @endforeach
                @endif -->
              </div>



              <!--================================friend requests================================-->

              <div class="tab-pane" id="tab-fr">
                @if(count($requests)>0)
                  @foreach($requests as $r)
                    <div class="panel panel-default">
                        <div class="panel-body">
                          <div class="pull-left">
                              {!! Html::image('' . $r->friendRequest->imageurl, '', array('class'=>'user img-circle')) !!}
                          </div>
                          <div class="user-details">
                            <h5 class="user-name">
                              <a href="{!! action('UserController@otheruser', $r->friendRequest->id) !!}">
                              {!! $r->friendRequest->firstname !!} {!! $r->friendRequest->lastname !!}
                            </a>
                            </h5>
                            <div class="fr-buttons">
                              {!! Form::open(array(
                                            'action' => array('UserController@acceptFriendRequest', $r->id),
                                            'class' => 'form friendActions friend-action-button',
                                            'method' => 'get')) !!}
                                  {!! Form::submit('Accept', array('class'=>'btn btn-info')) !!}
                              {!! Form::close() !!}
                              {!! Form::open(array(
                                            'action' => array('UserController@declineFriendRequest', $r->id),
                                            'class' => 'form friendActions friend-action-button',
                                            'method' => 'get')) !!}
                                  {!! Form::submit('Decline', array('class'=>'btn btn-default')) !!}
                              {!! Form::close() !!}
                              <!-- <a href="{!! action('UserController@acceptFriendRequest', $r->id) !!}" class="btn btn-info">Accept</a>
                              <a href="{!! action('UserController@declineFriendRequest', $r->id) !!}" class="btn btn-default">Decline</a> -->
                            </div>
                          </div>
                        </div>
                    </div>
                  @endforeach
                @else
                  <div class="alert alert-info">
                      No Friend Request.
                  </div>
                @endif


              </div>

              <!--================================friend requests================================-->

              <!--================================grant requests================================-->
              <div class="tab-pane" id="tab-gr">
                @if(count($grant)>0)
                  @foreach($grant as $g)
                  <div class="panel panel-default">
                      <div class="panel-body">
                        <div class="pull-left">
                          {!! Html::image('' . $g->granter['imageurl'], '', array('class'=>'user img-circle')) !!}
                        </div>
                        <div class="user-details">
                          <p class="user-name">
                            {!! $g->granter['firstname'] !!} {!! $g->granter['lastname'] !!} granted your wish: <a href="{!! action('UserController@wish', $g['id']) !!}"> {!! $g['title'] !!} </a>
                            <div class="fr-buttons">
                              {!! Form::open(array(
                                            'action' => array('UserController@confirmGrantRequest', $g->id),
                                            'class' => 'form friendActions friend-action-button',
                                            'method'=> 'get')) !!}
                                  {!! Form::submit('Accept', array('class'=>'btn btn-info')) !!}
                              {!! Form::close() !!}
                              {!! Form::open(array(
                                            'action' => array('UserController@declineFriendRequest', $g->id),
                                            'class' => 'form friendActions friend-action-button',
                                            'method' => 'get')) !!}
                                  {!! Form::submit('Decline', array('class'=>'btn btn-default')) !!}
                              {!! Form::close() !!}
                            </div>
                          </p>
                        </div>
                      </div>
                  </div>
                  @endforeach
                @else
                  <div class="alert alert-info">
                    No Grant Request.
                  </div>
                @endif
              </div>
            </div>
        </div>
        <!---->
      </div>
    </div>
  </div>
</div>
@endsection
