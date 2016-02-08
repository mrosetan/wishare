 @extends('admin.master')
@section('title', 'Search User/Admin')
@section('content')

<div class="row">
    <div class="col-md-8 col-md-offset-2">


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
                              <a href="{{ action('AdminController@userdetails', $r->id) }}"><h4>{{ $r->firstname }} {{ $r->lastname}}</h4>
                              {{ $r->username }}</a>
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
@stop
