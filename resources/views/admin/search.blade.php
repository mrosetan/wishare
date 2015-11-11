@extends('admin.master')
@section('title', 'Search User/Admin')
@section('content')
<div class="row">
    <div class="col-sm-12">

      <div class="col-sm-6 col-sm-offset-3">
        @foreach($errors->all() as $error)
            <p class="alert alert-danger"> {{ $error }}</p>
        @endforeach

              {!! Form::open(array(
                        'action' => array('AdminController@searchUser'),
                        'class' => 'form')) !!}
              <div class="form-group col-sm-6">
                    {!! Form::text('search', null,
                                    array('required',
                                    'placeholder' => 'Search',
                                    'class'=>'form-control inline-inputs')) !!}
              </div>

                <!-- <div class="form-group col-md-4">
                    {!! Form::select('type',
                                      array(
                                        '1' => 'First Name',
                                        '2' => 'Last Name',
                                        '3' => 'Username',
                                        '4' => 'Email'),
                                      null,
                                      ['placeholder' => 'Type',
                                      'class'=>'form-control inline-inputs']) !!}
                </div> -->

                <div class="col-sm-6 form-group ">
                    {!! Form::submit('Search',
                                      array('class'=>'btn btn-info btn-block')) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>


<div class="row">

  <div class="col-md-12">
    @if(isset($errormsg))
      <p class="alert alert-danger">{{ $errormsg }}</p>

    @elseif($results != '')
      <div class="panel panel-default">
          <div class="panel-heading">
              <h3 class="panel-title">Search Results</h3>
          </div>
          <div class="panel-body">
              <table class="table table-striped">
                  <thead>
                      <tr>
                          <th>Status</th>
                          <th>#</th>
                          <th>Name</th>
                          <th>Username</th>
                          <th>Email</th>
                          <th>Created On</th>
                          <th>Type</th>
                          <th>Actions</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($results as $r)
                        <tr>
                            <td>
                              <!-- {!! $r->status !!} -->
                              @if($r->status == 1)
                                <span class="fa fa-circle active-indicator"></span>
                              @else
                                <span class="fa fa-circle deactivated-indicator"></span>
                              @endif

                            </td>
                            <td>{!! $r->id !!}</td>
                            <td>{!! $r->lastname!!}, {!! $r->firstname !!}</td>
                            <td>{!! $r->username !!}</td>
                            <td>{!! $r->email !!}</td>
                            <td>{!! $r->created_at !!}</td>
                            <td>
                              <!-- {!! $r->type !!} -->
                              @if($r->type == 0)
                                Admin
                              @else
                                User
                              @endif

                            </td>
                            <td>
                              @if($r->type == 0)
                                <a href="{!! action('AdminController@editAdmin', $r->id) !!}"><span class="glyphicon glyphicon-edit"></span></a>
                                @if($r->status == 1)
                                  <a href="#" class="mb-control" data-box="#mb-delete"><span class="glyphicon glyphicon-trash"></span></a>
                                @endif
                              @else
                                @if($r->status == 1)
                                  <a href="#" class="mb-control" data-box="#mb-delete"><span class="fa fa-ban"></span></a>
                                @endif
                              @endif
                            </td>

                            <!-- MESSAGE BOX-->
                            <div class="message-box animated fadeIn" data-sound="alert" id="mb-delete">
                                <div class="mb-container">
                                    <div class="mb-middle">
                                        <div class="mb-title"><span class="glyphicon glyphicon-trash"></span> Delete?</div>
                                        <div class="mb-content">
                                            <p>Are you sure you want to delete this admin?</p>
                                        </div>
                                        <div class="mb-footer">
                                            <div class="pull-right">
                                                <a href="{!! action('AdminController@deleteAdmin', $r->id) !!}" class="btn btn-success btn-lg">Yes</a>
                                                <button class="btn btn-default btn-lg mb-control-close">No</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END MESSAGE BOX-->

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
                                                <a href="{!! action('AdminController@deactivateUser', $r->id) !!}" class="btn btn-success btn-lg">Yes</a>
                                                <button class="btn btn-default btn-lg mb-control-close">No</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END MESSAGE BOX-->
                        </tr>
                      @endforeach
                  </tbody>
              </table>
          </div>
      </div>
    @endif
  </div>
</div>

@stop
