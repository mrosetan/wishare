@extends('userlayouts-master.user-master')
@section('title', 'Home')

@section('content')



<!-- <div class="page-title">
    <h4>Event Stream</h4>
</div> -->
<div class="page-content-wrap container-fluid ">
  <div class="row">
    <br />
      <div class="col-md-8 col-md-offset-2" id="stream">
        @if(session('homeAlert'))
          <div class="alert alert-info" id="home-alert">
              {{ session('homeAlert') }}
          </div>
        @endif
        @if(count($fstream) > 0)
          @foreach($fstream as $s)

            @if($s['granted'] != 1)
              <!-- ============ ADDED NEW WISH ============ -->

              <div class="panel panel-default">
                  <div class="panel-body">
                    <div class="col-xs-12">
                      <div class="pull-left">
                        <a href="{!! !empty($s['imageurl']) ? action('UserController@otheruser', $s['userid']) : '' !!}">
                          <img class="user stream img-circle" src="{!! $s['imageurl'] !!}">
                        </a>
                      </div>
                      <div class="stream-header">
                        <a href="{!! !empty($s['firstname']) || !empty($s['lastname']) || !empty($s['username']) ? action('UserController@otheruser', $s['userid']) : '' !!}">
                          <b>{!! $s['firstname'] !!} {!! $s['lastname'] !!} </b>( {!! $s['username'] !!} )
                        </a>
                        @if($s['created_at'] == $s['updated_at'])
                           added a new wish.
                        @else
                          @if(($s['granterid'] != 0) and ($s['date_granted'] == '0000-00-00 00:00:00'))
                            's wish has a grant request
                          @else
                            updated a wish.
                          @endif
                        @endif
                        <br />
                        {!! date('F d, Y g:i A', strtotime($s['updated_at']))  !!}
                      </div>

                    </div>
                    <hr />
                    <div class="col-xs-12">
                      <div class="stream-margin">
                        <h4>{!! $s['title'] !!}</h4>

                      </div>
                      <hr />
                    </div>

                    @if($s['wishimageurl'] == 'null')
                      <div></div>
                    @else
                      @if(!empty($s['wishimageurl']))
                        <div id ="links" class="col-xs-12 stream-body">
                          <a href="{!! $s['wishimageurl'] !!}" title="'{!! $s['title'] !!}' wished by: {!! $s['username'] !!}" data-gallery>
                              <img src="{!! $s['wishimageurl'] !!}" class="img-responsive stream-wish-img"/>
                          </a>
                        </div>
                      @endif
                    @endif

                    <div class="col-xs-12">
                      <div class="stream-margin">
                        @if($s['due_date'] != 0000-00-00)
                          <p>
                            <b>Due Date:</b> {!! date('F d, Y', strtotime($s['due_date']))  !!}
                          </p>
                        @endif

                        @if(!empty($s['details']))
                          <p>
                          <b>Details:</b> {!! $s['details'] !!}
                          </p>
                        @endif

                        @if(!empty($s['alternatives']))
                        <p>
                          <b>Alternatives:</b> {!! $s['alternatives'] !!}
                        </p>
                        @endif

                      </div>
                    </div>

                    <div class="col-xs-12">
                      @if(!empty($s['tagged']))
                        <ul class="list-tags">
                          @foreach($s['tagged'] as $tag)
                            <li><a href="{!! action('UserController@otheruser', $tag['id']) !!}"><span class="fa fa-tag"></span> {!!$tag['username'] !!}</a></li>
                          @endforeach
                        </ul>
                      @endif
                      <div class="pull-right">
                        <a href="#"><span class="fa fa-star"></span></a>
                        &nbsp;&nbsp;
                        <a href="#"><span class="fa fa-bookmark"></span></a>
                        &nbsp;&nbsp;
                        <a href="{!! action('UserController@rewishDetails', $s['wishid']) !!}"><span class="fa fa-retweet"></span></a>
                        @if(($s['granterid'] != 0) and ($s['date_granted'] == '0000-00-00 00:00:00'))
                          <!-- &nbsp;&nbsp;
                          <a data-toggle="modal" data-target="#modal_grant{!! $s['wishid'] !!}"><span class="fa fa-magic"></span></a> -->
                        @else
                        &nbsp;&nbsp;
                        <a data-toggle="modal" data-target="#modal_grant{!! $s['wishid'] !!}"><span class="fa fa-magic"></span></a>
                        @endif
                      </div>
                    </div>

                  </div>
              </div>
              <!-- ============ ADDED NEW WISH ============ -->
            @elseif($s['granted'] == 1)
              <!-- ============ GRANTED WISH ============ -->
              <div class="panel panel-default">
                  <div class="panel-body">
                    <div class="col-xs-12">
                      <div class="pull-left">
                        <a href="{!! !empty($s['imageurl']) ? action('UserController@otheruser', $s['userid']) : '' !!}">
                          <img class="user stream img-circle" src="{!! $s['imageurl'] !!}">
                        </a>
                      </div>
                      <div class="stream-header">
                        <a href="{!! !empty($s['firstname']) || !empty($s['lastname']) || !empty($s['username']) ? action('UserController@otheruser', $s['userid']) : '' !!}">
                          <b>{!! $s['firstname'] !!} {!! $s['lastname'] !!} </b>( {!! $s['username'] !!} )'s
                        </a>
                        wish has been granted by <a href="{!! !empty($s['granterfirstname']) || !empty($s['granterlastname']) || !empty($s['granterusername']) ? action('UserController@otheruser', $s['granterid']) : '' !!}">
                          <b>{!! $s['granterfirstname'] !!} {!! $s['granterlastname'] !!} </b>( {!! $s['granterusername'] !!} ).
                        </a>
                        <br />
                        {!! date('F d, Y g:i A', strtotime($s['date_granted']))  !!}
                      </div>

                    </div>
                    <div class="col-xs-12">
                      <div class="stream-margin">

                        <h4>{!! $s['title'] !!}</h4>
                      </div>
                    </div>

                    <div class="col-xs-12">
                      <div class="stream-margin">
                        <div class="panel-group accordion accordion-dc">
                          <div class="panel panel-default">
                            <div class="panel-heading" style="height: 30px; padding: initial;">
                              <p class="panel-title">
                                  <a href="#accOneColOne" style="font-size:11px;">
                                    Wish Details
                                  </a>
                              </p>
                            </div>
                                <div class="panel-body" id="accOneColOne">
                                  <!-- <div id ="links" class="col-xs-6 col-xs-offset-3 stream-body">
                                    <a href="{{ URL::asset('img/test.jpg') }}" title="Bobby" data-gallery>
                                        <img src="{{ URL::asset('img/test.jpg') }}" class="img-responsive img-text"/>
                                    </a>
                                  </div> -->

                                  @if($s['wishimageurl'] == 'null')
                                    <div></div>
                                  @else
                                    @if(!empty($s['wishimageurl']))
                                      <div id ="links" class="col-xs-12 stream-body">
                                        <a href="{!! $s['wishimageurl'] !!}" title="'{!! $s['title'] !!}' wished by: {!! $s['username'] !!}" data-gallery>
                                            <img src="{!! $s['wishimageurl'] !!}" class="img-responsive stream-wish-img"/>
                                        </a>
                                      </div>
                                    @endif
                                  @endif

                                  <div class="col-xs-12">
                                    <div class="">
                                      @if($s['due_date'] != 0000-00-00)
                                        <p>
                                          <b>Due Date:</b> {!! date('F d, Y', strtotime($s['due_date']))  !!}
                                        </p>
                                      @endif

                                      @if(!empty($s['details']))
                                        <p>
                                        <b>Details:</b> {!! $s['details'] !!}
                                        </p>
                                      @endif

                                      @if(!empty($s['alternatives']))
                                      <p>
                                        <b>Alternatives:</b> {!! $s['alternatives'] !!}
                                      </p>
                                      @endif

                                    </div>
                                  </div>

                                  <div class="col-xs-12">
                                    @if(!empty($s['tagged']))
                                      <ul class="list-tags">
                                        @foreach($s['tagged'] as $tag)
                                          <li><a href="{!! action('UserController@otheruser', $tag['id']) !!}"><span class="fa fa-tag"></span> {!!$tag['username'] !!}</a></li>
                                        @endforeach
                                      </ul>
                                    @endif
                                  </div>
                                  <!-- <div class="panel panel-wishes">
                                  </div> -->
                                </div>

                          </div>
                        </div>

                      </div>

                      <!-- <div class="pull-right">
                        <a href="#"><span class="fa fa-star"></span></a>
                        &nbsp;&nbsp;
                        <a href="{!! action('UserController@rewishDetails', $s['wishid']) !!}"><span class="fa fa-retweet"></span></a>

                      </div> -->
                    </div>

                    <div class="col-xs-12 granter-grantee-body">
                      <div class="stream-margin">
                        <div class="col-xs-12">
                          <div class="pull-left">
                            <a href="{!! !empty($s['granterimageurl']) ? action('UserController@otheruser', $s['granterid']) : '' !!}">
                              <img class="user granter img-circle" src="{!! $s['granterimageurl'] !!}">
                            </a>
                          </div>
                          <div class="stream-header">
                            <a href="{!! !empty($s['granterfirstname']) || !empty($s['granterlastname']) || !empty($s['granterusername']) ? action('UserController@otheruser', $s['granterid']) : '' !!}">
                              <b>{!! $s['granterfirstname'] !!} {!! $s['granterlastname'] !!} </b>( {!! $s['granterusername'] !!} ):
                            </a>
                          </div>

                        </div>

                        <div class="col-xs-12">
                          <p class="granter-caption">
                            {!! $s['granteddetails'] !!}
                          </p>
                        </div>
                        <div id ="links" class="col-xs-12 stream-body">
                          <a href="{!! $s['grantedimageurl'] !!}" title="'{!! $s['title'] !!}' wished by: {!! $s['username'] !!} granted by: {!! $s['granterusername'] !!}" data-gallery>
                              <img src="{!! $s['grantedimageurl'] !!}" class="img-responsive stream-wish-img"/>
                          </a>
                        </div>

                      </div>
                    </div>


                    <div class="col-xs-12">
                      <!-- <div class="stream-margin">
                        <div class="panel-group accordion accordion-dc">
                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <p class="panel-title">
                                  <a href="#accOneColOne">
                                    Wish Details
                                  </a>
                              </p>
                            </div>
                                <div class="panel-body" id="accOneColOne">

                                  @if($s['wishimageurl'] == 'null')
                                    <div></div>
                                  @else
                                    @if(!empty($s['wishimageurl']))
                                      <div id ="links" class="col-xs-12 stream-body">
                                        <a href="{!! $s['wishimageurl'] !!}" title="'{!! $s['title'] !!}' wished by: {!! $s['username'] !!}" data-gallery>
                                            <img src="{!! $s['wishimageurl'] !!}" class="img-responsive stream-wish-img"/>
                                        </a>
                                      </div>
                                    @endif
                                  @endif

                                  <div class="col-xs-12">
                                    <div class="">
                                      @if($s['due_date'] != 0000-00-00)
                                        <p>
                                          <b>Due Date:</b> {!! date('F d, Y', strtotime($s['due_date']))  !!}
                                        </p>
                                      @endif

                                      @if(!empty($s['details']))
                                        <p>
                                        <b>Details:</b> {!! $s['details'] !!}
                                        </p>
                                      @endif

                                      @if(!empty($s['alternatives']))
                                      <p>
                                        <b>Alternatives:</b> {!! $s['alternatives'] !!}
                                      </p>
                                      @endif

                                    </div>
                                  </div>

                                  <div class="col-xs-12">
                                    @if(!empty($s['tagged']))
                                      <ul class="list-tags">
                                        @foreach($s['tagged'] as $tag)
                                          <li><a href="{!! action('UserController@otheruser', $tag['id']) !!}"><span class="fa fa-tag"></span> {!!$tag['username'] !!}</a></li>
                                        @endforeach
                                      </ul>
                                    @endif
                                  </div>
                                </div>

                          </div>
                        </div>

                      </div> -->

                      <div class="pull-right">
                        <a href="#"><span class="fa fa-star"></span></a>
                        &nbsp;&nbsp;
                        <a href="{!! action('UserController@rewishDetails', $s['wishid']) !!}"><span class="fa fa-retweet"></span></a>

                      </div>
                    </div>





                  </div>
              </div>
              <!-- <div class="panel panel-default">
                  <div class="panel-body">
                    <div class="col-xs-12">
                      <div class="pull-left">
                        <a href="{!! !empty($s['imageurl']) ? action('UserController@otheruser', $s['userid']) : '' !!}">
                          <img class="user stream img-circle" src="{!! $s['imageurl'] !!}">
                        </a>
                      </div>
                      <div class="stream-header">
                        <a href="{!! !empty($s['firstname']) || !empty($s['lastname']) || !empty($s['username']) ? action('UserController@otheruser', $s['userid']) : '' !!}">
                          <b>{!! $s['firstname'] !!} {!! $s['lastname'] !!} </b>( {!! $s['username'] !!} )
                        </a>
                        @if($s['created_at'] == $s['updated_at'])
                           added a new wish.
                        @else
                          granted a wish.
                        @endif
                        <br />
                        {!! date('F d, Y g:i A', strtotime($s['updated_at']))  !!}
                      </div>
                    </div>

                    <hr />
                    <div class="col-xs-12">
                      <div class="stream-margin">
                        <h4>{!! $s['granteddetails'] !!}</h4>
                        <hr />
                      </div>
                    </div>

                    @if($s['wishimageurl'] == 'null')
                      <div></div>
                    @else
                      @if(!empty($s['wishimageurl']))
                        <div id ="links" class="col-xs-8 col-xs-offset-2 stream-body">
                          <a href="{!! $s['wishimageurl'] !!}" title="'{!! $s['title'] !!}' wished by: {!! $s['username'] !!}" data-gallery>
                              <img src="{!! $s['wishimageurl'] !!}" class="img-responsive"/>
                          </a>
                        </div>
                      @endif
                    @endif

                    <div class="col-xs-12">
                      <div class="stream-margin">
                        @if(!empty($s['title']))
                          <p>
                            <b>Wish: </b> {!! $s['title'] !!}
                          </p>
                        @endif
                        @if($s['due_date'] != 0000-00-00)
                          <p>
                            <b>Due Date:</b> {!! date('F d, Y', strtotime($s['due_date']))  !!}
                          </p>
                        @endif

                        @if(!empty($s['details']))
                          <p>
                          <b>Details:</b> {!! $s['details'] !!}
                          </p>
                        @endif

                        @if(!empty($s['alternatives']))
                        <p>
                          <b>Alternatives:</b> {!! $s['alternatives'] !!}
                        </p>
                        @endif

                      </div>
                    </div>

                    <div class="col-xs-12">
                      @if(!empty($s['tagged']))
                        <ul class="list-tags">
                          @foreach($s['tagged'] as $tag)
                            <li><a href="{!! action('UserController@otheruser', $tag['id']) !!}"><span class="fa fa-tag"></span> {!!$tag['username'] !!}</a></li>
                          @endforeach
                        </ul>
                      @endif
                      <div class="pull-right">
                        <a href="#"><span class="fa fa-star"></span></a>
                        &nbsp;&nbsp;
                        <a data-toggle="modal" data-target="#modal_rewish{!! $s['wishid'] !!}"><span class="fa fa-retweet"></span></a>

                      </div>
                    </div>
                  </div>
              </div> -->
              @else
              <!-- <div class="alert alert-info" id="home-alert">
                Grant request sent!
              </div> -->
              <!-- ============ GRANTED WISH ============ -->
            @endif
          @endforeach
        @else
          <img src="{{ URL::asset('img/logo.png') }}" class="img-responsive no-stream-content-img"/>
        @endif
      </div>
      <!-- modals -->
      <!--  Rewish  -->
      <!--

        <div class="message-box animated fadeIn open" id="mb-wishlist">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="glyphicon glyphicon-pencil"></span> You don't have wishlists.</div>
                    <div class="mb-content">
                        <p>You need to create a wishlist.</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href="{{ url('/user/action/wishlist') }}" class="btn btn-success btn-lg">Create Wishlist</a>
                            <a href="{{ url('/user/home') }}" class="btn btn-success btn-lg">Go back to home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      -->
      @if(isset($wishlists))
        @foreach($fstream as $s)
      <!--  Grant  -->
      <div class="modal" id="modal_grant{!! $s['wishid'] !!}" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4>Grant Wish</h4>
                  </div>
                  <div class="modal-body">
                    @foreach($errors->all() as $error)
                        <p class="alert alert-danger"> {{ $error }}</p>
                    @endforeach
                    {!! Form::open(array('action'=>array('UserController@grantWish', $s['wishid']), 'class' => 'form', 'files'=>true)) !!}
                    <div class="form-group">
                      <div class="row">
                        <div class="col-sm-12">
                          <label>Wish</label>
                          {!! Form::text('wish', $s['title'], array('class'=>'form-control', 'placeholder'=>'', 'disabled'=>'disabled')) !!}
                        </div>
                      </div>
                      <br />
                      <div class="row">
                        <div class="col-sm-12">
                          {!! Form::text('granteddetails', null, array('class'=>'form-control', 'placeholder'=>'Caption'))!!}
                        </div>
                      </div>
                      <br />
                      <div class="row">
                        {!! Form::file('grantedimageurl', array('class'=>'fileinput btn btn-info'))!!}
                      </div>
                      <br />
                      <div class="row">
                        <div class="col-md-12">
                          <div class="pull-right">
                            {!! Form::submit('Grant', array('class'=>'btn btn-info')) !!}
                            {!! Form::reset('Cancel', array('class'=>'btn btn-default')) !!}
                          </div>
                        </div>
                      </div>
                    </div>
                    {!! Form::close() !!}
                  </div>
              </div>
          </div>
      </div>
      @endforeach
      @endif
  </div>
  <!-- BLUEIMP GALLERY -->
  <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
      <div class="slides"></div>
      <h3 class="title"></h3>
      <a class="prev">‹</a>
      <a class="next">›</a>
      <a class="close">×</a>
      <a class="play-pause"></a>
      <ol class="indicator"></ol>
  </div>
  <!-- END BLUEIMP GALLERY -->
  </div>
</div>
@endsection
