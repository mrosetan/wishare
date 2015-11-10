@extends('admin.master')
@section('title', 'Monitor Users')
@section('content')
  <div class="row">
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

            <!-- @foreach($errors->all() as $error)
                <p class="alert alert-danger"> {{ $error }}</p>
            @endforeach -->
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
                              <!-- <a href="{!! action('AdminController@deactivateUser', $user->id) !!}"><span class="fa fa-ban"></span></a> -->
                              <a href="#" class="mb-control" data-box="#mb-delete"><span class="fa fa-ban"></span></a>
                            </td>
                        </tr>

                        <!-- MESSAGE BOX-->
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
                        <!-- END MESSAGE BOX-->

                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>

      </div>
  </div>
@stop
