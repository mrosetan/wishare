@extends('userlayouts-master.user-master')
@section('title', 'Home')

@section('content')



<!-- <div class="page-title">
    <h4>Event Stream</h4>
</div> -->
<div class="page-content-wrap container-fluid {!! count($fstream) < 1 ? no-stream-content : '' !!}">
  <div class="row">
    <br />
      <div class="col-md-8 col-md-offset-2" id="stream">

        @if(count($fstream) > 0)
          @foreach($fstream as $s)

            @if($s['granted'] == 0)
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
                          updated a wish.
                        @endif
                        <br />
                        {!! date('F d, Y g:i A', strtotime($s['updated_at']))  !!}
                      </div>

                    </div>
                    <hr />
                    <div class="col-xs-12">
                      <div class="stream-margin">
                        <h4>{!! $s['title'] !!}</h4>
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
                        @if($s['due_date'] != 0000-00-00)
                          <p>
                            Due Date: {!! date('F d, Y', strtotime($s['due_date']))  !!}
                          </p>
                        @endif

                        @if(!empty($s['details']))
                          <p>
                          Details: {!! $s['details'] !!}
                          </p>
                        @endif

                        @if(!empty($s['alternatives']))
                        <p>
                          Alternatives: {!! $s['alternatives'] !!}
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
                        <a data-toggle="modal" data-target="#modal_rewish{!! $s['wishid'] !!}"><span class="fa fa-retweet"></span></a>
                        &nbsp;&nbsp;
                        <a data-toggle="modal" data-target="#modal_grant{!! $s['wishid'] !!}"><span class="fa fa-magic"></span></a>
                      </div>
                    </div>

                  </div>
              </div>

              <!--  Rewish  -->
              @if(count($wishlists)>0)
                <div class="modal" id="modal_rewish{!! $s['wishid'] !!}" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                              <h4>Re-Wish</h4>
                            </div>

                            <div class="modal-body">


                              @foreach($errors->all() as $error)
                                  <p class="alert alert-danger"> {{ $error }}</p>
                              @endforeach

                              {!! Form::open(array('action'=>array('UserController@reWish', $s['wishid']), 'class' => 'form', 'files'=>true)) !!}

                              <div class="form-group">
                                <div class="row">
                                  <div class="col-md-12">
                                    {!! Form::select('wishlist', $wishlists, null, array('class'=>'form-control'))!!}
                                  </div>
                                </div>
                                <br />
                                <div class="row">
                                  <div class="col-md-12">
                                    {!! Form::text('title', $s['title'], array('class'=>'form-control', 'placeholder'=>'Wish', 'disabled'=>'true')) !!}
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
                                <div class="row">
                                  <div class="col-sm-12">
                                    <label>Due Date:</label>
                                    {!! Form::text('due_date', date('Y-m-d'), array('id'=>'datepicker', 'class'=>'form-control')) !!}
                                  </div>
                                </div>
                                <br />
                                <div class="row">
                                  <div class="col-sm-12">
                                    <label>Upload:</label><br />
                                    {!! Form::file('wishimageurl', array('class'=>'fileinput btn btn-info')) !!}
                                  </div>
                                </div>
                                <br />
                                <div class="row">
                                  <div class="col-md-12">
                                    <label>Tag:</label>
                                    <select class="my-select" name="tags[]" multiple="multiple">
                                      @foreach($friends as $f)
                                        <option value="{!! $f->id !!}">{!! $f->firstname !!} {!! $f->lastname !!} ({!! $f->username !!})</option>

                                      @endforeach
                                    </select>


                                  </div>
                                </div>

                                <br />
                                <div class="row">
                                  <div class="col-md-12">
                                    {!! Form::checkbox('flag', '1', ['class'=>'form-control ']) !!}
                                    <label><span class="glyphicon glyphicon-flag"></span> Flag </label>

                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="pull-right">
                                      {!! Form::submit('Add', array('class'=>'btn btn-info')) !!}
                                      {!! Form::button('Cancel', array('class'=>'btn btn-default mb-control-close')) !!}
                                    </div>
                                  </div>
                                </div>
                              </div>



                              {!! Form::close() !!}


                            </div>
                        </div>
                    </div>
                </div>

              @else
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
                                    <!-- <button class="btn btn-default btn-lg mb-control-close">No</button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

              @endif
              <!--  Rewish  -->


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
                            {!! Form::open(array( 'class' => 'form')) !!}
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
                                  {!! Form::text('caption', null, array('class'=>'form-control', 'placeholder'=>'Caption'))!!}
                                </div>
                              </div>
                              <br />
                              <div class="row">
                                {!! Form::file('photo')!!}
                              </div>
                              <br />
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="pull-right">
                                    {!! Form::submit('Add', array('class'=>'btn btn-info')) !!}
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



              <!-- ============ ADDED NEW WISH ============ -->
            @else
              <!-- ============ GRANTED WISH ============ -->

              <div class="panel panel-default">
                  <div class="panel-body">
                    <div class="col-xs-12">
                      <div class="pull-left">
                        <img class="user stream img-circle" src="{{ URL::asset('img/test.jpg') }}">
                      </div>
                      <div class="stream-header">
                        <b>Brenda Mage </b>( PrettyCutie )'s wish has been granted by <b>Ebuen Clemente Jr. </b>( BenchBobby ).
                        <br />
                        December 1, 2015
                      </div>

                    </div>
                    <div class="col-xs-12">
                      <div class="stream-margin">

                        <h4>Bobby</h4>
                      </div>
                    </div>

                    <div class="col-xs-12 granter-grantee-body">
                      <div class="stream-margin">
                        <div class="col-xs-12">
                          <div class="pull-left">
                            <img class="user granter img-circle" src="{{ URL::asset('img/test.jpg') }}">
                          </div>
                          <div class="stream-header">
                            <b>Ebuen Clemente Jr. </b>( BenchBobby ):
                          </div>

                        </div>

                        <div class="col-xs-12">
                          <p class="granter-caption">
                          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                          </p>
                        </div>
                        <div id ="links" class="col-xs-6 col-xs-offset-3 stream-body">
                          <a href="{{ URL::asset('img/test.jpg') }}" title="Bobby" data-gallery>
                              <img src="{{ URL::asset('img/test.jpg') }}" class="img-responsive img-text"/>
                          </a>
                        </div>

                      </div>
                    </div>


                    <div class="col-xs-12">
                      <div class="stream-margin">
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
                                  <div id ="links" class="col-xs-6 col-xs-offset-3 stream-body">
                                    <a href="{{ URL::asset('img/test.jpg') }}" title="Bobby" data-gallery>
                                        <img src="{{ URL::asset('img/test.jpg') }}" class="img-responsive img-text"/>
                                    </a>
                                  </div>

                                  <div class="col-xs-12">
                                    <div class="">
                                      <p>
                                      Due Date: January 23, 2016
                                      </p>
                                      <p>
                                      Details:
                                      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                      </p>
                                      <p>
                                      Alternatives:
                                      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                      </p>
                                    </div>
                                  </div>

                                  <div class="col-xs-12">
                                    <ul class="list-tags">
                                        <li><a href="#"><span class="fa fa-tag"></span> Yenhaha</a></li>
                                        <li><a href="#"><span class="fa fa-tag"></span> RoseBecher</a></li>
                                        <li><a href="#"><span class="fa fa-tag"></span> JermaineDilao</a></li>
                                        <li><a href="#"><span class="fa fa-tag"></span> MikeL</a></li>
                                    </ul>
                                  </div>
                                  <!-- <div class="panel panel-wishes">
                                  </div> -->
                                </div>

                          </div>
                        </div>

                      </div>
                    </div>

                    <div class="col-xs-12">
                      <div class="pull-right">
                        <a href="#"><span class="fa fa-star"></span></a>
                        &nbsp;&nbsp;
                        <a data-toggle="modal" data-target="#modal_rewish"><span class="fa fa-retweet"></span></a>
                      </div>
                    </div>



                  </div>
              </div>

              <!-- ============ GRANTED WISH ============ -->
            @endif
          @endforeach
        @else
          <img src="{{ URL::asset('img/logo.png') }}" class="img-responsive no-stream-content-img"/>
        @endif


      </div>


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

    <!-- <div class="row">
        <div class="col-xs-12">
          <div class="panel panel-default">
              <div class="panel-body">
                <div class="pull-left">
                  <img class="user img-circle" src="{{ URL::asset('img/test.jpg') }}">
                </div>
                <div class="stream-header">
                  asdasdasd
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
                  <a data-toggle="modal" data-target="#modal_rewish"><span class="fa fa-retweet"></span></a>
                  &nbsp;&nbsp;
                  <a data-toggle="modal" data-target="#modal_grant"><span class="fa fa-magic"></span></a>
                </div>
              </div>
          </div>
        </div>
    </div> -->
    <!--  Rewish  -->
    <div class="modal" id="modal_rewish" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                  <h4>Re-Wish</h4>
                </div>
                <div class="modal-body">
                  @foreach($errors->all() as $error)
                      <p class="alert alert-danger"> {{ $error }}</p>
                  @endforeach
                  {!! Form::open(array( 'class' => 'form')) !!}
                  <div class="form-group">
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
                          {!! Form::reset('Cancel', array('class'=>'btn btn-default mb-control-close')) !!}
                        </div>
                      </div>
                    </div>
                  </div>
                  {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <!--  Grant  -->
    <div class="modal" id="modal_grant" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
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
                  {!! Form::open(array( 'class' => 'form')) !!}
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-12">
                        <label>Wish</label>
                        {!! Form::text('wish', null, array('class'=>'form-control', 'placeholder'=>'Bobby', 'disabled'=>'disabled')) !!}
                      </div>
                    </div>
                    <br />
                    <div class="row">
                      <div class="col-sm-12">
                        {!! Form::text('caption', null, array('class'=>'form-control', 'placeholder'=>'Caption'))!!}
                      </div>
                    </div>
                    <br />
                    <div class="row">
                      {!! Form::file('photo')!!}
                    </div>
                    <br />
                    <div class="row">
                      <div class="col-md-12">
                        <div class="pull-right">
                          {!! Form::submit('Add', array('class'=>'btn btn-info')) !!}
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
