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
                <li class="active"><a href="#tab-notif" role="tab" data-toggle="tab">Activity <span class="badge badge-warning">3</span> </a></li>
                <li>
                  <a href="#tab-fr" role="tab" data-toggle="tab">Friend Requests
                    @if(count($requests) > 0)
                      <span class="badge badge-warning">{!! count($requests) !!}</span>
                    @endif
                  </a>
               </li>
               <li><a href="#tab-notif" role="tab" data-toggle="tab">Grant Requests <span class="badge badge-warning">3</span> </a></li>
            </ul>
            <br />
            <!--notifications-->
            <div class="panel-body tab-content">
              <div class="tab-pane active" id="tab-notif">
                @foreach($tags as $t)
                  <div class="panel panel-default">
                      <div class="panel-body">
                        <div class="pull-left">
                          {!! Html::image('' . $t->tagger->imageurl, '', array('class'=>'user-friend img-circle')) !!}
                        </div>
                        <div class="user-details">
                          <p class="user-name">
                            <a href="{!! action('UserController@otheruser', $t->tagger->id) !!}"> {!! $t->tagger->firstname !!} {!! $t->tagger->lastname !!} {!! $t->tagger->username !!} </a> tagged you in a <a href="{!! action('UserController@wish', $t->wish->id) !!}">wish</a>
                            <p>
                              {!! $t->created_at !!}
                            </p>
                          </p>

                        </div>
                      </div>
                  </div>
                @endforeach
              </div>
              <div class="modal" id="modal_acceptgrant" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                              <h4 class="modal-title" id="defModalHead">Accept Grant Request</h4>
                          </div>
                          <div class="modal-body">
                              <h5>Bobby granted your wish: Bobby</h5> <br />
                              {!! Form::open() !!}
                              {!! Form::text('caption', null, array('class'=>'form-control', 'placeholder'=>'Add a caption')) !!}
                              <br />
                              {!! Form::file('photo')!!}
                          </div>
                          <div class="modal-footer">
                            {!! Form::button('Accept', ['class'=>'btn btn-info', 'data-toggle'=>'modal', 'data-target'=>'#modal_acceptgrant'])!!}
                            {!! Form::reset('Cancel', ['class'=>'btn btn-default'])!!}
                            {!! Form::close() !!}
                          </div>
                      </div>
                  </div>
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
            </div>
        </div>
        <!---->
      </div>
    </div>
  </div>
</div>
@endsection
