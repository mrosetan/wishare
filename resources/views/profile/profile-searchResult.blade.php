@extends('userlayouts-master.profile-master')
@section('title', 'Friends')
@section('newcontent')
<br />
@if(session('status'))
  <div class="alert alert-success">
      {{ session('status') }}
  </div>
@endif
<div class="row">
  <div class="col-md-12">
      <div class="panel panel-default">
          <div class="panel-body">
              <form class="form-horizontal">
                  <div class="form-group">
                      <div class="col-md-12">
                          <div class="input-group">
                              <div class="input-group-addon">
                                  <span class="fa fa-search"></span>
                              </div>
                                  {!! Form::open(array(
                                            'action' => array('ProfileController@searchFriend'),
                                            'class' => 'form')) !!}
                                            {!! Form::text('search', null,
                                                      array('class'=>'form-control',
                                                      'placeholder'=>'Search...')) !!}
                                {!! Form::close()!!}
                          </div>
                      </div>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>
@if(empty($results))
  <div class="alert alert-info" role="alert">
    User not found.
  </div>
@else
  <div class="row">
    @foreach($results as $r)
    <div class="col-md-6">

        <div class="panel panel-default">
            <div class="panel-body profile">
                <div class="profile-image">
                    <img src="{!! $r->imageurl !!}" alt="{!! $r->firstname !!} {!! $r->lastname !!}"/>
                </div>
                <div class="profile-data">
                    <div class="profile-data-name"><a href="{!! action('UserController@otheruser', $r->id ) !!}">{!! $r->firstname !!} {!! $r->lastname !!}</a></div>
                </div>
            </div>
            <div class="panel-body">
                <div class="contact-info">
                  <p><small>E-mail</small><br/>{!! $r->email !!}</p>
                </div>
            </div>
        </div>

    </div>
    @endforeach
  </div>
@endif

@endsection
