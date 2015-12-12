 @extends('admin.master')
@section('title', 'Search User/Admin')
@section('content')

<div class="row">
    <div class="col-md-12">

        <!-- START DEFAULT DATATABLE -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Search</h3>
            </div>

            @if(session('status'))
              <div class="alert alert-success">
                  {{ session('status') }}
              </div>
            @endif

            @if($results->isEmpty())
              <div class="alert alert-info" role="alert">
                No Users.
              </div>
            @else

            @foreach($errors->all() as $error)
                <p class="alert alert-danger"> {{ $error }}</p>
            @endforeach

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
                          <th>Type</th>
                          <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($results as $r)
                        <tr>
                            <td>
                              @if($r->status == 1)
                                <span class="fa fa-circle active-indicator"></span>Active
                              @else
                                <span class="fa fa-circle deactivated-indicator"></span>Deactivated
                              @endif

                            </td>
                            <td>{!! $r->id !!}</td>
                            <td>{!! $r->lastname!!}, {!! $r->firstname !!}</td>
                            <td>{!! $r->username !!}</td>
                            <td>{!! $r->email !!}</td>
                            <td>{!! $r->created_at !!}</td>
                            <td>
                              @if($r->type == 0)
                                Admin
                              @else
                                User
                              @endif

                            </td>
                            <td>
                              @if($r->type == 0)
                                <a href="{!! action('AdminController@editAdmin', $r->id) !!}"><button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Edit Details"><span class="glyphicon glyphicon-edit"></span></button></a>
                                @if($r->status == 1)
                                  <a href="#" class="mb-control" data-box="#mb-delete{!! $r->id !!}"><button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Deactivate"><span class="glyphicon glyphicon-trash"></span></button></a>
                                @endif
                              @else
                                @if($r->status == 1)
                                  <a href="#" class="mb-control" data-box="#mb-delete{!! $r->id !!}"><button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Deactivate/Ban"><span class="fa fa-ban"></span></button></a>
                                @endif
                              @endif

                              @if($r->status == 0)
                                <a href="#" class="mb-control" data-box="#mb-undo{!! $r->id !!}"><button type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Reactivate"><span class="fa fa-undo"></span></button></a>
                              @endif
                            </td>


                            <!-- <div class="message-box animated fadeIn" data-sound="alert" id="mb-delete{!! $r->id !!}">
                                <div class="mb-container">
                                    <div class="mb-middle">
                                        <div class="mb-title"><span class="glyphicon glyphicon-trash"></span> Delete {!! $r->lastname!!}, {!! $r->firstname !!}?</div>
                                        <div class="mb-content">
                                            <p>Are you sure you want to delete this user?</p>
                                        </div>
                                        <div class="mb-footer">
                                            <div class="pull-right">
                                                <a href="{!! action('AdminController@deactivate', $r->id) !!}" class="btn btn-success btn-lg">Yes</a>
                                                <button class="btn btn-default btn-lg mb-control-close">No</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="message-box animated fadeIn" data-sound="alert" id="mb-undo{!! $r->id !!}">
                                <div class="mb-container">
                                    <div class="mb-middle">
                                        <div class="mb-title"><span class="glyphicon glyphicon-trash"></span> Reactivate {!! $r->lastname!!}, {!! $r->firstname !!}?</div>
                                        <div class="mb-content">
                                            <p>Are you sure you want to reactivate this user?</p>
                                        </div>
                                        <div class="mb-footer">
                                            <div class="pull-right">
                                                <a href="{!! action('AdminController@reactivate', $r->id) !!}" class="btn btn-success btn-lg">Yes</a>
                                                <button class="btn btn-default btn-lg mb-control-close">No</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->


                        </tr>
                      @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
        <!-- END DEFAULT DATATABLE -->

        @foreach($results as $r)


              <div class="message-box animated fadeIn" data-sound="alert" id="mb-delete{!! $r->id !!}">
                  <div class="mb-container">
                      <div class="mb-middle">
                          <div class="mb-title"><span class="glyphicon glyphicon-trash"></span> Delete {!! $r->lastname!!}, {!! $r->firstname !!}?</div>
                          <div class="mb-content">
                              <p>Are you sure you want to delete this user?</p>
                          </div>
                          <div class="mb-footer">
                              <div class="pull-right">
                                  <a href="{!! action('AdminController@deactivate', $r->id) !!}" class="btn btn-success btn-lg">Yes</a>
                                  <button class="btn btn-default btn-lg mb-control-close">No</button>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

              <div class="message-box animated fadeIn" data-sound="alert" id="mb-undo{!! $r->id !!}">
                  <div class="mb-container">
                      <div class="mb-middle">
                          <div class="mb-title"><span class="glyphicon glyphicon-trash"></span> Reactivate {!! $r->lastname!!}, {!! $r->firstname !!}?</div>
                          <div class="mb-content">
                              <p>Are you sure you want to reactivate this user?</p>
                          </div>
                          <div class="mb-footer">
                              <div class="pull-right">
                                  <a href="{!! action('AdminController@reactivate', $r->id) !!}" class="btn btn-success btn-lg">Yes</a>
                                  <button class="btn btn-default btn-lg mb-control-close">No</button>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>


          </tr>
        @endforeach
    </div>
</div>


<!-- <div class="row">
    <div class="col-sm-12">

      <div class="col-sm-6 col-sm-offset-3">
        @foreach($errors->all() as $error)
            <p class="alert alert-danger"> {{ $error }}</p>
        @endforeach

              {!! Form::open(array(
                        'class' => 'form')) !!}
              <div class="form-group col-sm-6">
                    {!! Form::text('search', null,
                                    array('required',
                                    'placeholder' => 'Search',
                                    'class'=>'form-control inline-inputs')) !!}
              </div>

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

                        </tr>
                      @endforeach
                  </tbody>
              </table>
          </div>
      </div>
    @endif
  </div>
</div> -->

@stop
