@extends('userlayouts-master.user-master')
@section('title', 'Notifications')

@section('content')
<div class="page-title">
    <h2></h2>
</div>
<div class="page-content-wrap">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default tabs">
          <ul class="nav nav-tabs" role="tablist">
              <li class="active"><a href="#tab-notif" role="tab" data-toggle="tab">Notifications <span class="badge badge-warning">58</span> </a></li>
              <li><a href="#tab-fr" role="tab" data-toggle="tab">Friend Requests <span class="badge badge-warning">58</span> </a></li>
          </ul>
          <br />
          <!--notifications-->
          <div class="panel-body tab-content">
            <div class="tab-pane active" id="tab-notif">
              <div class="panel panel-default">
                  <div class="panel-body">
                    <h5>Bobby granted your wish: Bobby</h5>
                    {!! Form::open()!!}
                    {!! Form::button('Accept', ['class'=>'btn btn-info', 'data-toggle'=>'modal', 'data-target'=>'#modal_acceptgrant'])!!}
                    {!! Form::reset('Decline', ['class'=>'btn btn-default'])!!}
                    {!! Form::close() !!}
                  </div>
              </div>
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
                          <img class="user img-circle" src="{{ URL::asset('img/test.jpg') }}">
                        </div>
                        <div class="user-details">
                          <h5 class="user-name">
                            {!! $r->friendRequest->firstname !!} {!! $r->friendRequest->lastname !!}
                          </h5>
                          <div class="fr-buttons">
                            <a href="{!! action('UserController@acceptFriendRequest', $r->id) !!}" class="btn btn-info">Accept</a>
                            <a href="" class="btn btn-default">Decline</a>
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
@endsection
