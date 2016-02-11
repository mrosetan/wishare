@extends('userlayouts-master.profile-master')
@section('title', 'Friends')
@section('newcontent')
<br />
@if(isset($friends) and count($friends) > 0)
  <div class="row">
      @foreach($friends as $fr)
      <div class="col-md-6">
          <!-- CONTACT ITEM -->
          <div class="panel panel-default">
              <div class="panel-body profile">
                  <div class="profile-image">
                      <img src="{!! $fr['imageurl'] !!}" alt="{{ $fr['firstname'] }} {{ $fr['lastname'] }}"/>
                  </div>
                  <div class="profile-data">
                      <div class="profile-data-name"><a href="{!! action('UserProfilesController@profile', $fr['id'] ) !!}">{{ $fr['firstname'] }} {{ $fr['lastname'] }}</a></div>
                  </div>
              </div>
              <div class="panel-body">
                  <div class="contact-info">
                    <p><small>E-mail</small><br/>{{ $fr['email'] }}</p>
                  </div>
              </div>
          </div>
          <!-- END CONTACT ITEM -->
      </div>
      @endforeach
  </div>
@endif

@endsection
