@extends('userlayouts-master.profile-master')
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
          <a href="{!! action('UserController@otheruser', $ty['id']) !!}">{!! $ty['firstname'] !!} {!! $ty['lastname'] !!} ({!! $ty['username'] !!})</a>
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
        <div class="pull-right">
          <a href="#" class="mb-control" data-box="#mb-deletetynote{!! $tyid !!}"><button class="btn btn-info">Delete</button></a>
        </div>
      </div>
    </div>
  @endforeach
@endif

@if(isset($tynotes) and $tynotes->count())
  @foreach($tynotes as $tyid => $ty)
    <div class="message-box animated fadeIn" data-sound="alert" id="mb-deletetynote{!! $tyid !!}">
        <div class="mb-container">
            <div class="mb-middle">
                <div class="mb-title"><span class="glyphicon glyphicon-trash"></span>Delete Thank You Note</div>
                <div class="mb-content">
                    <p>Are you sure you want to delete this note?</p>
                </div>
                <div class="mb-footer">
                    @if(!empty($ty))
                    <div class="pull-right">
                        <a href="{!! action('ProfileController@deleteTYNoteProfile', $ty->pivot->id) !!}" class="btn btn-success btn-lg">Yes</a>
                        <button class="btn btn-default btn-lg mb-control-close">No</button>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
  @endforeach
@endif

@endsection
