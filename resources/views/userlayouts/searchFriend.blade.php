@extends('userlayouts-master.user-master')
@section('title', 'Change Password')

@section('content')
<div class="row">
    <div class="col-md-12">


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
                          <th>User</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($results as $r)
                        <tr>
                            <td>
                                <a href="{!! action('UserController@otheruser', $r->id) !!}"><h4>{!! $r->firstname !!} {!! $r->lastname!!}</h4>
                                {!! $r->username !!}</a>
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
@endsection
