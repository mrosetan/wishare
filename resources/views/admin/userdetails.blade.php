 @extends('admin.master')
@section('title', 'User/Admin')
@section('content')

<div class="row">

  <!-- PROFILE WIDGET -->
  <div class="col-md-8 col-md-offset-2">

      <div class="panel panel-default">
        @if(session('status'))
          <div class="alert alert-success">
              {{ session('status') }}
          </div>
        @endif

        @if(empty($user))
          <div class="alert alert-info" role="alert">
            No user found.
          </div>
        @else
          <div class="panel-body profile bg-info">

              <div class="profile-image">
                  <img src="{!! !empty($user->imageurl) ? $user->imageurl : 'http://192.168.1.10/wishareimages/userimages/default.jpg' !!}" alt="{!! $user->firstname !!} {!! $user->lastname !!}">
              </div>
              <div class="profile-data">
                  <div class="profile-data-name">{!! $user->firstname !!} {!! $user->lastname !!}</div>
                  <!-- <div class="profile-data-title">UI/UX Designer</div> -->
              </div>
              <div class="profile-controls">
                  <!-- <a href="#" class="profile-control-left"><span class="fa fa-home"></span></a> -->
                  <!-- <a href="pages-messages.html" class="profile-control-right"><span class="fa fa-envelope"></span></a> -->
              </div>

          </div>
          <div class="panel-body list-group">
              <span class="list-group-item"><span class="fa fa-bell"></span> Status: {!! $user->status == 1 ? 'Active' : 'Deactivated' !!}</span>
              <span class="list-group-item"><span class="fa fa-crosshairs"></span> Type: {!! $user->type == 0 ? 'Admin' : 'User' !!}</span>
              <span class="list-group-item"><span class="fa fa-rocket"></span> Username: {!! $user->username !!}</span>
              <span class="list-group-item"><span class="fa fa-envelope"></span> Email: {!! $user->email !!}</span>

              @if($user->type == 0)
                <span class="list-group-item"><a href="{!! action('AdminController@editAdmin', $user->id) !!}"><button type="button" class="btn btn-info btn-block" data-toggle="tooltip" data-placement="top" title="Edit Details"><span class="glyphicon glyphicon-edit"></span></button></a></span>
                @if($user->status == 1)
                  <span class="list-group-item"><a href="#" class="mb-control" data-box="#mb-delete{!! $user->id !!}"><button type="button" class="btn btn-danger btn-block" data-toggle="tooltip" data-placement="top" title="Deactivate"><span class="glyphicon glyphicon-trash"></span></button></a></span>
                @endif
              @else
                @if($user->status == 1)
                    <span class="list-group-item"><a href="#" class="mb-control" data-box="#mb-delete{!! $user->id !!}"><button type="button" class="btn btn-danger btn-block" data-toggle="tooltip" data-placement="top" title="Deactivate/Ban"><span class="fa fa-ban"></span></button></a></span>
                @endif
              @endif

              @if($user->status == 0)
                <span class="list-group-item"><a href="#" class="mb-control" data-box="#mb-undo{!! $user->id !!}"><button type="button" class="btn btn-warning btn-block" data-toggle="tooltip" data-placement="top" title="Reactivate"><span class="fa fa-undo"></span></button></a></span>
              @endif

          </div>
        @endif
      </div>

  </div>
  <!-- END PROFILE WIDGET -->

  <div class="message-box animated fadeIn" data-sound="alert" id="mb-delete{!! $user->id !!}">
      <div class="mb-container">
          <div class="mb-middle">
              <div class="mb-title"><span class="glyphicon glyphicon-trash"></span> Delete {!! $user->lastname!!}, {!! $user->firstname !!}?</div>
              <div class="mb-content">
                  <p>Are you sure you want to delete this user?</p>
              </div>
              <div class="mb-footer">
                  <div class="pull-right">
                      <a href="{!! action('AdminController@deactivate', $user->id) !!}" class="btn btn-success btn-lg">Yes</a>
                      <button class="btn btn-default btn-lg mb-control-close">No</button>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <div class="message-box animated fadeIn" data-sound="alert" id="mb-undo{!! $user->id !!}">
      <div class="mb-container">
          <div class="mb-middle">
              <div class="mb-title"><span class="glyphicon glyphicon-trash"></span> Reactivate {!! $user->lastname!!}, {!! $user->firstname !!}?</div>
              <div class="mb-content">
                  <p>Are you sure you want to reactivate this user?</p>
              </div>
              <div class="mb-footer">
                  <div class="pull-right">
                      <a href="{!! action('AdminController@reactivate', $user->id) !!}" class="btn btn-success btn-lg">Yes</a>
                      <button class="btn btn-default btn-lg mb-control-close">No</button>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
@stop
