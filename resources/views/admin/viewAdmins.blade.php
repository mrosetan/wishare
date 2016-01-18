@extends('admin.master')
@section('title', 'Wishare Admins')
@section('content')
  <!-- <div class="row">
      <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Admins</h3>
            </div>
            @if($users->isEmpty())
              <div class="alert alert-info" role="alert">
                No Admins.
              </div>
            @else
            @foreach($errors->all() as $error)
                <p class="alert alert-danger"> {{ $error }}</p>
            @endforeach
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Admin ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Created On</th>
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
                                <a href="{!! action('AdminController@editAdmin', $user->id) !!}"><span class="glyphicon glyphicon-edit"></span></a>
                                <a href="#" class="mb-control" data-box="#mb-delete"><span class="glyphicon glyphicon-trash"></span></a>
                              </td>


                              <div class="message-box animated fadeIn" data-sound="alert" id="mb-delete">
                                  <div class="mb-container">
                                      <div class="mb-middle">
                                          <div class="mb-title"><span class="glyphicon glyphicon-trash"></span> Delete?</div>
                                          <div class="mb-content">
                                              <p>Are you sure you want to delete this admin?</p>
                                          </div>
                                          <div class="mb-footer">
                                              <div class="pull-right">
                                                  <a href="{!! action('AdminController@deleteAdmin', $user->id) !!}" class="btn btn-success btn-lg">Yes</a>
                                                  <button class="btn btn-default btn-lg mb-control-close">No</button>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>

                          </tr>
                        @endforeach
                    </tbody>
                </table>

                {!! $users->render() !!}
              @endif
            </div>
        </div>

      </div>
  </div> -->

  <!-- <div class="row">
      <div class="col-md-12"> -->

          <!-- START DEFAULT DATATABLE -->
          <!-- <div class="panel panel-default">
              <div class="panel-heading">
                  <h3 class="panel-title">Admins</h3>
              </div>

              @if($users->isEmpty())
                <div class="alert alert-info" role="alert">
                  No Admins.
                </div>
              @else
              @foreach($errors->all() as $error)
                  <p class="alert alert-danger"> {{ $error }}</p>
              @endforeach

              <div class="panel-body">
                  <table class="table datatable">
                      <thead>
                          <tr>
                            <th>Admin ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Created On</th>
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
                                <a href="{!! action('AdminController@editAdmin', $user->id) !!}"><button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Edit Details"><span class="glyphicon glyphicon-edit"></span></button></a>

                                <a href="#" class="mb-control" data-box="#mb-delete{!! $user->id !!}"><button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Deactivate"><span class="glyphicon glyphicon-trash"></span></button></a>
                              </td>


                              <div class="message-box animated fadeIn" data-sound="alert" id="mb-delete{!! $user->id !!}">
                                  <div class="mb-container">
                                      <div class="mb-middle">
                                          <div class="mb-title"><span class="glyphicon glyphicon-trash"></span> Delete {!! $user->lastname !!}, {!! $user->firstname !!}?</div>
                                          <div class="mb-content">
                                              <p>Are you sure you want to delete this admin?</p>
                                          </div>
                                          <div class="mb-footer">
                                              <div class="pull-right">
                                                  <a href="{!! action('AdminController@deleteAdmin', $user->id) !!}" class="btn btn-success btn-lg">Yes</a>
                                                  <button class="btn btn-default btn-lg mb-control-close">No</button>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>

                          </tr>
                        @endforeach
                      </tbody>
                  </table>
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
                                <td>{!! $user->id !!}</td>
                                <td><a href="{!! action('AdminController@userdetails', $user->id) !!}">{!! $user->lastname!!}, {!! $user->firstname !!}</a></td>
                                <td>{!! $user->username !!}</td>
                                <td>{!! $user->email !!}</td>
                                <td>{!! $user->created_at !!}</td>



                            </tr>
                          @endforeach

                        </tbody>
                    </table>

                  @endif
              </div>
          </div>
          <!-- END DEFAULT DATATABLE -->
    </div>
</div>
@stop
