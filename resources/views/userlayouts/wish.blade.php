@extends('userlayouts-master.user-master')
@section('title', 'Wish')

@section('content')
<div class="page-title">
    <h2></h2>
</div>
<div class="page-content-wrap">
  <div class="row">
    <div class="col-md-12">
      <h5><a href="{{ url('user/profile') }}"><span class="fa fa-arrow-circle-o-left"></span>&nbsp;Back</a></h5>
      <div class="panel panel-default">
          <div class="panel-body">
            @if(!empty($wish))
              <h4>{!! $wish->title !!}</h4>
              Details: {!! $wish->details !!}
              <br />
              Alternatives: {!! $wish->alternatives !!}
              <br />
              Due Date: {!! date('F d, Y', strtotime($wish->due_date)) !!}
              <br />
              Tags:
              @foreach($tags as $t)
                <a href="{!! action('UserController@otheruser', $t->user->id) !!}">{!! $t->user->firstname !!} {!! $t->user->lastname !!}, </a>
              @endforeach
              <hr />
              <div class="wish-image-container">
                <img src='{!! $wish->wishimageurl !!}' class="wish-image"/>
              </div>
              <br /><br /><hr />
              <div class="wish-icons pull-right">
                <a href="#"><span class="fa fa-star"></span></a>
                &nbsp;&nbsp;
                <a href="#"><span class="fa fa-bookmark"></span></a>
                &nbsp;&nbsp;
                <a href="#"><span class="fa fa-retweet"></span></a>
              </div>
            @else
              <div class="alert alert-info">
                Wish not found
              </div>
            @endif
          </div>

      </div>
    </div>
  </div>
</div>
@endsection
