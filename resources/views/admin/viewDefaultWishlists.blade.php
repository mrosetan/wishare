@extends('admin.master')
@section('title', 'Default Wishlists')
@section('content')
  <div class="row">
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
                No Users.
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
                              <a href="{!! action('AdminController@deleteDefaultWishlist', $dw->id) !!}"><span class="glyphicon glyphicon-trash"></span></a>
                            </td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
              @endif
            </div>
        </div>

      </div>
  </div>
@stop
