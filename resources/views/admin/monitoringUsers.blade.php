@extends('admin.master')
@section('title', 'Monitor Users')
@section('content')


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
                              <th>Status</th>
                              <th>ID #    </th>
                              <th>Name</th>
                              <th>Username</th>
                              <th>Email</th>
                              <th>Created On</th>
                              <!-- <th>Type</th> -->
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($users as $user)
                            <tr>
                                <td>
                                  @if($user->status == 1)
                                    <span class="fa fa-circle active-indicator"></span> Active -
                                  @else
                                    <span class="fa fa-circle deactivated-indicator"></span> Deactivated -
                                  @endif
                                  @if($user->type == 0)
                                    Admin
                                  @else
                                    User
                                  @endif
                                </td>
                                <td>{{ $user->id }}</td>
                                <td><a href="{{ action('AdminController@userdetails', $user->id) }}">{{ $user->lastname}}, {{ $user->firstname }}</a></td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ date('F d, Y g:i A', strtotime($user->created_at)) }}</td>
                                <!-- <td>
                                  @if($user->type == 0)
                                    Admin
                                  @else
                                    User
                                  @endif

                                </td> -->
                                <!-- <td> -->
                                  <!-- @if($user->type == 0)
                                    <a href="{{ action('AdminController@editAdmin', $user->id) }}"><button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Edit Details"><span class="glyphicon glyphicon-edit"></span></button></a>
                                    @if($user->status == 1)
                                      <a href="#" class="mb-control" data-box="#mb-delete{{ $user->id }}"><button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Deactivate"><span class="glyphicon glyphicon-trash"></span></button></a>
                                    @endif
                                  @else
                                    @if($user->status == 1)
                                      <a href="#" class="mb-control" data-box="#mb-delete{{ $user->id }}"><button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Deactivate/Ban"><span class="fa fa-ban"></span></button></a>
                                    @endif
                                  @endif

                                  @if($user->status == 0)
                                    <a href="#" class="mb-control" data-box="#mb-undo{{ $user->id }}"><button type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Reactivate"><span class="fa fa-undo"></span></button></a>
                                  @endif -->
                                <!-- </td> -->


                                <!-- <div class="message-box animated fadeIn" data-sound="alert" id="mb-delete{{ $user->id }}">
                                    <div class="mb-container">
                                        <div class="mb-middle">
                                            <div class="mb-title"><span class="glyphicon glyphicon-trash"></span> Delete {{ $user->lastname}}, {{ $user->firstname }}?</div>
                                            <div class="mb-content">
                                                <p>Are you sure you want to delete this user?</p>
                                            </div>
                                            <div class="mb-footer">
                                                <div class="pull-right">
                                                    <a href="{{ action('AdminController@deactivate', $user->id) }}" class="btn btn-success btn-lg">Yes</a>
                                                    <button class="btn btn-default btn-lg mb-control-close">No</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="message-box animated fadeIn" data-sound="alert" id="mb-undo{{ $user->id }}">
                                    <div class="mb-container">
                                        <div class="mb-middle">
                                            <div class="mb-title"><span class="glyphicon glyphicon-trash"></span> Reactivate {{ $user->lastname}}, {{ $user->firstname }}?</div>
                                            <div class="mb-content">
                                                <p>Are you sure you want to reactivate this user?</p>
                                            </div>
                                            <div class="mb-footer">
                                                <div class="pull-right">
                                                    <a href="{{ action('AdminController@reactivate', $user->id) }}" class="btn btn-success btn-lg">Yes</a>
                                                    <button class="btn btn-default btn-lg mb-control-close">No</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->


                            </tr>
                          @endforeach
                          <!-- @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->firstname }}</td>
                                <td>{{ $user->lastname }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>
                                  <a href="#" class="mb-control" data-box="#mb-delete{{ $user->id }}"><button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Deactivate/Ban"><span class="fa fa-ban"></span></button></a>
                                </td>
                            </tr> -->

                          <!-- <div class="message-box animated fadeIn" data-sound="alert" id="mb-delete{{ $user->id }}">
                              <div class="mb-container">
                                  <div class="mb-middle">
                                      <div class="mb-title"><span class="glyphicon glyphicon-trash"></span> Ban/Deactivate {{ $user->lastname }}, {{ $user->firstname }}?</div>
                                      <div class="mb-content">
                                          <p>Are you sure you want to ban/deactivate this user?</p>
                                      </div>
                                      <div class="mb-footer">
                                          <div class="pull-right">
                                              <a href="{{ action('AdminController@deactivateUser', $user->id) }}" class="btn btn-success btn-lg">Yes</a>
                                              <button class="btn btn-default btn-lg mb-control-close">No</button>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div> -->
                          <!-- @endforeach -->
                        </tbody>
                    </table>

                  @endif
              </div>
          </div>
          <!-- END DEFAULT DATATABLE -->
    </div>
</div>

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
                          <td>{{ $user->id }}</td>
                          <td>{{ $user->firstname }}</td>
                          <td>{{ $user->lastname }}</td>
                          <td>{{ $user->username }}</td>
                          <td>{{ $user->email }}</td>
                          <td>{{ $user->created_at }}</td>
                          <td>


                            <a href="#" class="mb-control" data-box="#mb-delete{{ $user->id }}"><button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Deactivate/Ban"><span class="fa fa-ban"></span></button></a>
                          </td>
                      </tr>

                      <div class="message-box animated fadeIn" data-sound="alert" id="mb-delete{{ $user->id }}">
                          <div class="mb-container">
                              <div class="mb-middle">
                                  <div class="mb-title"><span class="glyphicon glyphicon-trash"></span> Ban/Deactivate {{ $user->lastname }}, {{ $user->firstname }}?</div>
                                  <div class="mb-content">
                                      <p>Are you sure you want to ban/deactivate this user?</p>
                                  </div>
                                  <div class="mb-footer">
                                      <div class="pull-right">
                                          <a href="{{ action('AdminController@deactivateUser', $user->id) }}" class="btn btn-success btn-lg">Yes</a>
                                          <button class="btn btn-default btn-lg mb-control-close">No</button>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>

                      @endforeach
                  </tbody>
              </table>
              {{ $users->render() }}
              @endif
          </div>
      </div>

    </div>
</div> -->
@stop
