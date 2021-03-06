@extends('userlayouts-master.user-master')
@section('title', 'Send Thank You Note')

@section('content')
<div class="page-content-wrap">
  <div class="row">
    <div class="actions-container">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4>Send Thank You Note</h4>
          @if(session('tynoteStatus'))
            <div class="alert alert-success">
                {{ session('tynoteStatus') }}
            </div>
          @endif
          @foreach($errors->all() as $error)
              <p class="alert alert-danger"> {{ $error }}</p>
          @endforeach
          {!! Form::open(array(
                        'action' => array('UserController@createTYNote'),
                        'class' => 'form',
                        'files'=>true)) !!}
          <div class="form-group">
            <div class="row">
              <div class="col-md-12">
                <!-- {!! Form::select('recipient', $recipient, null, array('id'=>'my-select')) !!}  -->
                <select name="recipient" class="recipient-container" id="my-select">
                  @foreach($recipient as $r)
                  <option value="{!! $r['id'] !!}">{{ $r['firstname'] }} {{ $r['lastname'] }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <br />
            <div class="row">
              <div class="col-md-12">
                {!! Form::textarea('message', null, ['class'=>'form-control', 'placeholder'=>'Note', 'size'=>'50x5']) !!}
              </div>
            </div>
            <br />
            <label>Thank You Sticker:</label>
            <div class="row">
              <div class="col-md-4">
                {!! Form::radio('sticker', '1') !!} Sticker 1<br />
                <div class="tysticker-container">
                  <img src="http://images.wishare.net/tynotessticker/ty1.png" class="tysticker-image"/>
                  <!-- <img src="http://192.168.1.8/wishareimages/tynotessticker/ty1.png" class="tysticker-image"/> -->
                </div>
              </div>
              <div class="col-md-4">
                {!! Form::radio('sticker', '2') !!} Sticker 2<br />
                <div class="tysticker-container">
                  <img src="http://images.wishare.net/tynotessticker/ty2.png" class="tysticker-image"/>
                  <!-- <img src="http://192.168.1.8/wishareimages/tynotessticker/ty2.png" class="tysticker-image"/> -->
                </div>
              </div>
              <div class="col-md-4">
                {!! Form::radio('sticker', '3') !!} Sticker 3<br />
                <div class="tysticker-container">
                  <img src="http://images.wishare.net/tynotessticker/ty3.png" class="tysticker-image"/>
                  <!-- <img src="http://192.168.1.8/wishareimages/tynotessticker/ty3.png" class="tysticker-image"/> -->
                </div>
              </div>
            </div>
            <br />
            <div class="row">
              <div class="col-md-12">
                <label>Upload:</label>
                <br />
                {!! Form::file('imageurl', array('class'=>'fileinput btn btn-info')) !!}
              </div>
            </div>
            <br />
            <div class="row">
              <div class="col-md-12">
                <div class="pull-right">
                  {!! Form::submit('Send', array('class'=>'btn btn-info')) !!}
                  {!! Form::button('Cancel', array('class'=>'btn btn-default mb-control-close')) !!}
                </div>
              </div>
            </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
