@extends('userlayouts-master.user-master')
@section('title', 'Home')

@section('content')
<div class="page-title">
    <h2>Event Stream</h2>
</div>
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
          <div class="panel panel-default">
              <div class="panel-body">
                <div class="pull-left">
                  <img class="user img-circle" src="{{ URL::asset('img/test.jpg') }}">
                </div>
                <div class="user-details">
                  <h5 class="user-name">
                    Brenda Mage
                    <br />
                    Wish: Bobby's Heart
                    <br />
                    Date: 10/2/2015
                  </h5>
                </div>
                <div class="pull-right">
                  <a href="#"><span class="fa fa-star"></span></a>
                  &nbsp;&nbsp;
                  <a href="#"><span class="fa fa-bookmark"></span></a>
                  &nbsp;&nbsp;
                  <a href="#"><span class="fa fa-retweet"></span></a>
                  &nbsp;&nbsp;
                  <a href="#" class="mb-control" data-box="#mb-rewish"><span class="fa fa-magic"></span></a>
                </div>
              </div>
          </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
          <div class="panel panel-default">
              <div class="panel-body">
                <div class="pull-left">
                  <img class="user img-circle" src="{{ URL::asset('img/test.jpg') }}">
                </div>
                <div class="user-details">
                  <h5 class="user-name">
                    Brenda Mage
                    <br />
                    Wish: Bobby's Heart
                    <br />
                    Date: 10/2/2015
                  </h5>
                </div>
                <div class="pull-right">
                  <a href="#"><span class="fa fa-star"></span></a>
                  &nbsp;&nbsp;
                  <a href="#"><span class="fa fa-bookmark"></span></a>
                  &nbsp;&nbsp;
                  <a href="#"><span class="fa fa-retweet"></span></a>
                  &nbsp;&nbsp;
                  <a href="#" class="mb-control" data-box="#mb-rewish"><span class="fa fa-magic"></span></a>
                </div>
              </div>
          </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
          <div class="panel panel-default">
              <div class="panel-body">
                <div class="pull-left">
                  <img class="user img-circle" src="{{ URL::asset('img/test.jpg') }}">
                </div>
                <div class="user-details">
                  <h5 class="user-name">
                    Brenda Mage
                    <br />
                    Wish: Bobby's Heart
                    <br />
                    Date: 10/2/2015
                  </h5>
                </div>
                <div class="pull-right">
                  <a href="#"><span class="fa fa-star"></span></a>
                  &nbsp;&nbsp;
                  <a href="#"><span class="fa fa-bookmark"></span></a>
                  &nbsp;&nbsp;
                  <a href="#"><span class="fa fa-retweet"></span></a>
                  &nbsp;&nbsp;
                  <a href="#" class="mb-control" data-box="#mb-rewish"><span class="fa fa-magic"></span></a>
                </div>
              </div>
          </div>
        </div>
    </div>
    <div class="message-box animated fadeIn" id="mb-rewish">
        <div class="mb-container wish">
            <div class="mb-middle">
              <div class="mb-title">Re-wish</div>
                <div class="mb-content">
                    {!! Form::open(array( 'class' => 'form')) !!}
                      <div class="row">
                        <div class="col-md-12">
                          {!! Form::select('wishlist', ['null'=>'-Wishlist-', 'Christmas', 'Personal', 'Birthday'], null, array('class'=>'form-control'))!!}
                        </div>
                      </div>
                      <br />
                      <div class="row">
                        <div class="col-md-12">
                          {!! Form::text('wish', null, array('class'=>'form-control', 'placeholder'=>'Bobby', 'disabled'=>'disabled')) !!}
                        </div>
                      </div>
                      <br />
                      <div class="row">
                        <div class="col-md-12">
                          {!! Form::textarea('description', null, ['class'=>'form-control ', 'placeholder'=>'Details or specifics about the wish', 'size'=>'102x5']) !!}
                        </div>
                      </div>
                      <br />
                      <div class="row">
                        <div class="col-md-12">
                          {!! Form::textarea('alternatives', null, ['class'=>'form-control ', 'placeholder'=>'Wish alternatives', 'size'=>'102x5']) !!}
                        </div>
                      </div>
                      <br />
                      <label>Tag</label>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="tag-container">
                            {!! Form::checkbox('tag', 'tagged') !!}&nbsp;Bobby Baratheon
                            <br>
                            {!! Form::checkbox('tag', 'tagged') !!}&nbsp;Rosie Lannister
                            <br>
                            {!! Form::checkbox('tag', 'tagged') !!}&nbsp;Bobrys
                          </div>
                        </div>
                      </div>
                      <br />
                      <div class="row">
                        <span class="glyphicon glyphicon-flag"></span><a href="#"><span class="xn-text">&nbsp;Flag wish</span></a>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="pull-right">
                            {!! Form::submit('Add', array('class'=>'btn btn-info')) !!}
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
@endsection
