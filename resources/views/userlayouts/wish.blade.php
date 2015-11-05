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
            <h5>Bobby</h5>
            Specifics: Hot bench bobby
            <br />
            Alternatives: None. I only want Bobby
            <br />
            Tags: Bobby
            <br />
            <div class="text-center">
              <h2>Pic here</h2>
            </div>
            <br /><br /><br /><br /><br />
            <div class="wish-icons pull-right">
              <a href="#"><span class="fa fa-star"></span></a>
              &nbsp;&nbsp;
              <a href="#"><span class="fa fa-bookmark"></span></a>
              &nbsp;&nbsp;
              <a href="#"><span class="fa fa-retweet"></span></a>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection
