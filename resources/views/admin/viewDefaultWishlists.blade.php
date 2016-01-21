@extends('admin.master')
@section('title', 'Default Wishlists')
@section('content')
  <!-- <div class="row">
      <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Wishlists</h3>
            </div>

            @if(session('status'))
              <div class="alert alert-success">
                  {{ session('status') }}
              </div>
            @endif

            @if($defaultwishlists->isEmpty())
              <div class="alert alert-info" role="alert">
                No Default Wishlists.
              </div>
            @else

            @foreach($errors->all() as $error)
                <p class="alert alert-danger"> {{ $error }}</p>
            @endforeach
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Default Wishlist</th>
                            <th>Date Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($defaultwishlists as $dw)
                        <tr>
                            <td>{!! $dw->id !!}</td>
                            <td>{!! $dw->title !!}</td>
                            <td>{!! $dw->created_at !!}</td>
                            <td>
                              <a href="{!! action('AdminController@editDefaultWishlist', $dw->id) !!}"><span class="glyphicon glyphicon-edit"></span></a>
                              <a href="#" class="mb-control" data-box="#mb-delete"><span class="glyphicon glyphicon-trash"></span></a>
                            </td>


                            <div class="message-box animated fadeIn" data-sound="alert" id="mb-delete">
                                <div class="mb-container">
                                    <div class="mb-middle">
                                        <div class="mb-title"><span class="glyphicon glyphicon-trash"></span> Delete?</div>
                                        <div class="mb-content">
                                            <p>Are you sure you want to delete this wishlist?</p>
                                        </div>
                                        <div class="mb-footer">
                                            <div class="pull-right">
                                                <a href="{!! action('AdminController@deleteDefaultWishlist', $dw->id) !!}" class="btn btn-success btn-lg">Yes</a>
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

                {!! $defaultwishlists->render() !!}
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
                  <h3 class="panel-title">Wishlists</h3>
              </div>

              @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
              @endif

              @if($defaultwishlists->isEmpty())
                <div class="alert alert-info" role="alert">
                  No Default Wishlists.
                </div>
              @else

              @foreach($errors->all() as $error)
                  <p class="alert alert-danger"> {{ $error }}</p>
              @endforeach

              <div class="panel-body">
                  <table class="table">
                      <thead>
                          <tr>
                            <th>No.</th>
                            <th>Default Wishlist</th>
                            <th>Date Created</th>
                            <th>Actions</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach($defaultwishlists as $dw)
                          <tr>
                              <td>{!! $dw->id !!}</td>
                              <td>{!! $dw->title !!}</td>
                              <td>{!! $dw->created_at !!}</td>
                              <td>
                                <a href="{!! action('AdminController@editDefaultWishlist', $dw->id) !!}"><button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Edit Details"><span class="glyphicon glyphicon-edit"></span></button></a>
                                <!-- <a href="{!! action('AdminController@deleteDefaultWishlist', $dw->id) !!}"><span class="glyphicon glyphicon-trash"></span></a> -->
                                <a href="#" class="mb-control" data-box="#mb-delete{!! $dw->id !!}"><button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Deactivate"><span class="glyphicon glyphicon-trash"></span></button></a>
                              </td>

                              <!-- MESSAGE BOX-->
                              <div class="message-box animated fadeIn" data-sound="alert" id="mb-delete{!! $dw->id !!}">
                                  <div class="mb-container">
                                      <div class="mb-middle">
                                          <div class="mb-title"><span class="glyphicon glyphicon-trash"></span> Delete {!! $dw->title !!}?</div>
                                          <div class="mb-content">
                                              <p>Are you sure you want to delete this wishlist?</p>
                                          </div>
                                          <div class="mb-footer">
                                              <div class="pull-right">
                                                  <a href="{!! action('AdminController@deleteDefaultWishlist', $dw->id) !!}" class="btn btn-success btn-lg">Yes</a>
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
                  @endif
              </div>
          </div>
          <!-- END DEFAULT DATATABLE -->
      </div>
  </div>
@stop
