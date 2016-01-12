@extends('userlayouts-master.other-master')
@section('title', 'Thank You Notes')
@section('newcontent')
<br />
@if(isset($tynotes))
  @foreach($tynotes as $tyid => $ty)
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="pull-left">
          <b>Date: {!! date('F d, Y g:i A', strtotime($ty->pivot['updated_at']))  !!}</b>
          <br />
          <b>From: </b>
          <a href="{!! action('OtherUserController@profile', $ty['id']) !!}">{!! $ty['firstname'] !!} {!! $ty['lastname'] !!} ({!! $ty['username'] !!})</a>
        </div>

        @if(!empty($ty->pivot['sticker']))
        <div>
          <img src="{!! $ty->pivot['sticker'] !!}" class="tysticker-imageprofile pull-right" />
        </div>
        <br />
        @endif
        <br/><br/><br/><br/><br/><br/><br/><br/><br/>
        <p style="font-size: 18px;">{!! $ty->pivot['message'] !!}</p>
        <br />
        @if(!empty($ty->pivot['imageurl']))
        <img src="{!! $ty->pivot['imageurl'] !!}" class="tynote-image" />
        @endif
        <hr/>
      </div>
    </div>
  @endforeach
@endif

@endsection
