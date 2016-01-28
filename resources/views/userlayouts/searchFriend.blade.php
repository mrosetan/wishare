@extends('userlayouts-master.user-master')
@section('title', 'Search')

@section('content')
<div class="row">
    <div class="col-md-12">


        <!-- START SIMPLE DATATABLE -->
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
                User not found.
              </div>
            @else

            <div class="panel-body">
                <table class="table datatable_simple">
                  <thead>
                      <tr>
                        <th>User</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach($results as $r)
                      <tr>
                          <td>
                            <div class="pull-left">
                              <a href="{!! !empty($r['imageurl']) ? action('UserProfilesController@profile', $r['userid']) : '' !!}">
                                <img class="user stream img-circle" src="{!! $r['imageurl'] !!}">
                              </a>
                            </div>
                              <a href="{!! action('UserProfilesController@profile', $r->id) !!}"><h4>{!! $r->firstname !!} {!! $r->lastname!!}</h4>
                              {!! $r->username !!}</a>
                          </td>

                      </tr>
                    @endforeach
                  </tbody>
                </table>
              @endif
            </div>
        </div>
        <!-- END SIMPLE DATATABLE -->

    </div>
</div>
@endsection
