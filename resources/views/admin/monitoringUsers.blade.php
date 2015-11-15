@extends('admin.master')
@section('title', 'Monitor Users')
@section('content')
  <!-- <div class="row">
      <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Users</h3>
            </div>
            @if($users->isEmpty())
              <div class="alert alert-info" role="alert">
                No Users.
              </div>
            @else

            @if(session('status'))
              <div class="alert alert-success">
                  {{ session('status') }}
              </div>
            @endif

            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Date Joined</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{!! $user->id !!}</td>
                            <td>{!! $user->firstname !!}</td>
                            <td>{!! $user->lastname !!}</td>
                            <td>{!! $user->username !!}</td>
                            <td>{!! $user->email !!}</td>
                            <td>{!! $user->created_at !!}</td>
                            <td>
                              <a href="#" class="mb-control" data-box="#mb-delete"><span class="fa fa-ban"></span></a>
                            </td>
                        </tr>

                        <div class="message-box animated fadeIn" data-sound="alert" id="mb-delete">
                            <div class="mb-container">
                                <div class="mb-middle">
                                    <div class="mb-title"><span class="glyphicon glyphicon-trash"></span> Ban/Deactivate User?</div>
                                    <div class="mb-content">
                                        <p>Are you sure you want to ban/deactivate this user?</p>
                                    </div>
                                    <div class="mb-footer">
                                        <div class="pull-right">
                                            <a href="{!! action('AdminController@deactivateUser', $user->id) !!}" class="btn btn-success btn-lg">Yes</a>
                                            <button class="btn btn-default btn-lg mb-control-close">No</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @endforeach
                    </tbody>
                </table>
                {!! $users->render() !!}
                @endif
            </div>
        </div>

      </div>
  </div> -->

  <div class="row">
      <div class="col-md-12">

          <!-- START DEFAULT DATATABLE -->
          <div class="panel panel-default">
              <div class="panel-heading">
                  <h3 class="panel-title">Users</h3>

                  <!-- <ul class="panel-controls">
                      <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                      <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                      <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                  </ul> -->
              </div>
              @if($users->isEmpty())
                <div class="alert alert-info" role="alert">
                  No Users.
                </div>
              @else

              @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
              @endif
              <div class="panel-body">
                  <table class="table datatable">
                      <thead>
                          <tr>
                            <th>ID #</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Date Joined</th>
                            <th>Actions</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach($users as $user)
                          <tr>
                              <td>{!! $user->id !!}</td>
                              <td>{!! $user->firstname !!}</td>
                              <td>{!! $user->lastname !!}</td>
                              <td>{!! $user->username !!}</td>
                              <td>{!! $user->email !!}</td>
                              <td>{!! $user->created_at !!}</td>
                              <td>
                                <a href="#" class="mb-control" data-box="#mb-delete{!! $user->id !!}"><button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Deactivate/Ban"><span class="fa fa-ban"></span></button></a>
                              </td>
                          </tr>

                        <div class="message-box animated fadeIn" data-sound="alert" id="mb-delete{!! $user->id !!}">
                            <div class="mb-container">
                                <div class="mb-middle">
                                    <div class="mb-title"><span class="glyphicon glyphicon-trash"></span> Ban/Deactivate {!! $user->lastname !!}, {!! $user->firstname !!}?</div>
                                    <div class="mb-content">
                                        <p>Are you sure you want to ban/deactivate this user?</p>
                                    </div>
                                    <div class="mb-footer">
                                        <div class="pull-right">
                                            <a href="{!! action('AdminController@deactivateUser', $user->id) !!}" class="btn btn-success btn-lg">Yes</a>
                                            <button class="btn btn-default btn-lg mb-control-close">No</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                      </tbody>
                  </table>
                  <!-- {!! $users->render() !!} -->
                  @endif
              </div>
          </div>
          <!-- END DEFAULT DATATABLE -->
    </div>
</div>
@stop
