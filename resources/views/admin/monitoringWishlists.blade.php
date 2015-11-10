@extends('admin.master')
@section('title', 'Monitor Wishlists')
@section('content')
  <div class="row">
      <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Wishlists</h3>
            </div>

            @if($wishlists->isEmpty())
              <div class="alert alert-info" role="alert">
                No Wishlists.
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
                            <th>Wishlist</th>
                            <th>Created by</th>
                            <th>Date Created</th>
                            <th>Privacy Setting</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($wishlists as $w)
                          <tr>
                              <td>{!! $w->id !!}</td>
                              <td>{!! $w->title !!}</td>
                              <td>
                                Name: {!! $w->user->firstname !!} {!! $w->user->lastname !!}<br />
                                Username: {!! $w->user->username !!}<br />
                                Email: {!! $w->user->email !!}<br />
                              </td>
                              <td>{!! $w->created_at !!}</td>
                              <td>
                                @if($w->privacy == 0)
                                  Public
                                @else
                                  Private
                                @endif
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
