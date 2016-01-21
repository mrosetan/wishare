@extends('admin.master')
@section('title', 'Monitor Wishes')
@section('content')
  <div class="row">
      <div class="col-md-12">
        <!-- START DEFAULT DATATABLE -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Wishes</h3>
            </div>

            @if($wishes->isEmpty())
              <div class="alert alert-info" role="alert">
                No Wishes.
              </div>
            @else

            <div class="panel-body">
                <table class="table datatable">
                    <thead>
                        <tr>
                          <th>Status</th>
                          <th>#</th>
                          <th>Wish</th>
                          <th>Wishlist</th>
                          <th>Created by</th>
                          <th>Date Created</th>
                          <th>Granted</th>
                          <th>Date Granted</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($wishes as $wish)
                        <tr>
                            <td>
                              @if($wish->status == 1)
                                <span class="fa fa-circle active-indicator"></span> Active
                              @else
                                <span class="fa fa-circle deactivated-indicator"></span> Deleted
                              @endif
                            </td>
                            <td>{!! $wish->id !!}</td>
                            <td>{!! $wish->title !!}</td>
                            <td>{!! $wish->wishlist['title'] !!}</td>
                            <td>
                              <b>{!! $wish->user['firstname'] !!} {!! $wish->user['lastname '] !!}</b> <br />
                              {!! $wish->user['username'] !!}
                            </td>
                            <td>{!! $wish->created_at !!}</td>
                            <td>
                              @if($wish->granted == 0)
                                NG
                              @else
                                Granted
                              @endif
                            </td>
                            <td>{!! $wish->date_granted !!}</td>
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
