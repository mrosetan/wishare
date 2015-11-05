<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- META SECTION -->
        <title>@yield('title')</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->

        <!-- CSS INCLUDE -->
        <link rel="stylesheet" type="text/css" id="theme" href="{{ URL::asset('css/theme-blue.css') }}"/>
        <link rel="stylesheet" type="text/css" id="theme" href="{{ URL::asset('css/bootstrap/user/userlayouts.css') }}"/>
        <!-- EOF CSS INCLUDE -->
    </head>
    <body>
        <!-- START PAGE CONTAINER -->
        <div class="page-container page-navigation-top-fixed">

            <!-- START PAGE SIDEBAR -->
            <div class="page-sidebar page-sidebar-fixed scroll">
                <!-- START X-NAVIGATION -->
                <ul class="x-navigation">
                    <li class="xn-logo">
                        <a href="#"><img class="logo" src="{{ URL::asset('img/logo.png') }}"</a>
                        <a href="#" class="x-navigation-control"></a>
                    </li>
                    <li>
                        <a href="{{ url('user/home') }}"><span class="glyphicon glyphicon-home"></span> <span class="xn-text">Home</span></a>
                    </li>
                    <li>
                        <a href="{{ url('user/profile') }}"><span class="glyphicon glyphicon-user"></span> <span class="xn-text">Profile</span></a>
                    </li>
                    <li>
                        <a href="{{ url('user/notifications') }}"><span class="fa fa-globe"></span> <span class="xn-text">Notifications</span></a>
                    </li>
                    <li>
                        <a href="#"><span class="glyphicon glyphicon-envelope"></span> <span class="xn-text">Notes</span></a>
                    </li>
                    <li>
                        <a href="#" class="mb-control" data-box="#mb-wishlist"><span class="fa fa-list-ul"></span><span class="xn-text">Create a Wishlist</span></a>
                    </li>
                    <li>
                        <a href="#" class="mb-control" data-box="#mb-wish"><span class="fa fa-magic"></span><span class="xn-text">Add Wish</span></a>
                    </li>
                    <li>
                        <a href="#" class="mb-control" data-box="#mb-notes"><span class="glyphicon glyphicon-envelope"></span><span class="xn-text">Send Note</span></a>
                    </li>
                    <li>
                        <a href="#" class="mb-control" data-box="#mb-tynotes"><span class="glyphicon glyphicon-envelope"></span><span class="xn-text">Send Thank You Note</span></a>
                    </li>
                    <li>
                        <a href="#"><span class="fa fa-question-circle"></span> <span class="xn-text">Help</span></a>
                    </li>
                    <li>
                        <a href="#"><span class="fa fa-gear"></span> <span class="xn-text">Settings</span></a>
                    </li>
                    <li>
                        <a href="#"><span class="fa fa-power-off"></span> <span class="xn-text">Sign Out</span></a>
                    </li>
                </ul>
                <!-- END X-NAVIGATION -->
            </div>
            <!-- END PAGE SIDEBAR -->

            <!-- PAGE CONTENT -->
            <div class="page-content">
              <!-- Wishlist message box-->
              <div class="message-box animated fadeIn" id="mb-wishlist">
                  <div class="mb-container wishlist">
                      <div class="mb-middle">
                          <div class="mb-title">Create a Wishlist</div>
                          <div class="mb-content">
                              {!! Form::open(array( 'class' => 'form')) !!}
                                <div class="row">
                                  <div class="col-md-12">
                                    {!! Form::text('title', null, array('class'=>'form-control', 'placeholder'=>'Title')) !!}
                                  </div>
                                </div>
                                <br />
                                <label>Due Date</label>
                                <div class="row">
                                  <div class="col-md-4">
                                      {!! Form::select('year', ['null'=>'-Year-', 2010, 2011, 2012, 2013, 2014, 2015], null, ['class'=>'form-control']) !!}
                                  </div>
                                  <div class="col-md-4">
                                    {!! Form::select('month', ['null'=>'-Month-','January','February','March','April','May','June','July','August','Septembder','October','November','December'], null, ['class'=>'form-control']) !!}
                                  </div>
                                  <div class="col-md-4">
                                    {!! Form::select('day', ['null'=>'-Day-',1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31], null, ['class'=>'form-control']) !!}
                                  </div>
                                  <!--
                                  <div class="col-md-12">
                                    {!! Form::text('date', null, array('id'=>'datepicker', 'class'=>'form-control')) !!}
                                  </div>
                                -->
                                </div>
                                <br />
                                <label>Privacy</label>
                                <div class="row">
                                  <div class="col-md-12">
                                    {!! Form::radio('privacy', '1')!!}&nbsp;Private
                                    <br>
                                    {!! Form::radio('privacy', '0')!!}&nbsp;Public
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
                                <br/ >
                                <div class="row">
                                  <span class="fa fa-facebook-square"><a href="#"></span> <span class="xn-text">Share on Facebook</span></a>
                                </div>
                                <br />
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="pull-right">
                                        {!! Form::submit('Create', array('class'=>'btn btn-info')) !!}
                                        {!! Form::button('Cancel', array('class'=>'btn btn-default mb-control-close')) !!}
                                    </div>
                                  </div>
                                </div>
                              {!! Form::close() !!}
                          </div>
                        </div>
                      </div>
                  </div>
                  <!-- end of wishlist message box-->
                  <!-- Wish message box-->
                  <div class="message-box animated fadeIn" id="mb-wish">
                      <div class="mb-container wish">
                          <div class="mb-middle">
                            <div class="mb-title">Add Wish</div>
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
                                        {!! Form::text('wish', null, array('class'=>'form-control', 'placeholder'=>'Wish')) !!}
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
                                    <div class="row">
                                      {!! Form::file('photo')!!}
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
                <!-- end of wish message box-->
                <!-- Notes message box-->
                <div class="message-box animated fadeIn" id="mb-notes">
                  <div class="mb-container note">
                    <div class="mb-middle">
                      <div class="mb-title">Send Note</div>
                        <div class="mb-content">
                          {!! Form::open(array( 'class' => 'form')) !!}
                          <div class="row">
                            <div class="col-md-12">
                              {!! Form::text('search', null, array('class'=>'form-control', 'placeholder'=>'Recipient')) !!}
                            </div>
                          </div>
                          <br />
                          <div class="row">
                            <div class="col-md-12">
                              {!! Form::textarea('note', null, ['class'=>'form-control', 'placeholder'=>'Note', 'size'=>'50x5']) !!}
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
                <!-- end of notes message box-->
                <!-- TY Notes message box-->
                <div class="message-box animated fadeIn" id="mb-tynotes">
                  <div class="mb-container tynote">
                    <div class="mb-middle">
                      <div class="mb-title">Send Thank You Note</div>
                        <div class="mb-content">
                          {!! Form::open(array( 'class' => 'form')) !!}
                          <div class="row">
                            <div class="col-md-12">
                              {!! Form::text('search', null, array('class'=>'form-control', 'placeholder'=>'Recipient')) !!}
                            </div>
                          </div>
                          <br />
                          <div class="row">
                            <div class="col-md-12">
                              {!! Form::textarea('note', null, ['class'=>'form-control', 'placeholder'=>'Note', 'size'=>'50x5']) !!}
                            </div>
                          </div>
                          <br />
                          <label>Thank You Sticker</label>
                          <div class="row">
                            <div class="col-md-4">
                              {!! Form::radio('sticker', '1') !!}&nbsp;Sticker 1
                            </div>
                            <div class="col-md-4">
                              {!! Form::radio('sticker', '1') !!}&nbsp;Sticker 2
                            </div>
                            <div class="col-md-4">
                              {!! Form::radio('sticker', '1') !!}&nbsp;Sticker 3
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
                <!-- end of TY Notes message box-->

                <!-- START X-NAVIGATION VERTICAL -->
                <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
                    <!-- TOGGLE NAVIGATION -->
                    <li class="xn-icon-button">
                        <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
                    </li>
                    <div class="pull-right">
                      <li class="xn-search">
                          <form role="form">
                              <input type="text" name="search" placeholder="Search..."/>
                          </form>
                      </li>
              </div>
                      <!--
                      <li class="xn-icon-button pull-right">
                          <a href="#"><span class="fa fa-pencil-square"></span></a>
                          <div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
                              <div class="panel-heading">
                                  <h3 class="panel-title"></span> Actions</h3>
                              </div>
                              <div class="panel-body list-group" style="height: 150px;">
                                  <<button class="btn btn-default" data-toggle="modal" data-target="#modal_basic">Basic</button>

                                  <a class="list-group-item" data-toggle="modal" data-target="#modal_wishlist">
                                      Add Wishlist
                                  </a>
                                  <a class="list-group-item" href="#">
                                      Add Wish
                                  </a>
                                  <a class="list-group-item" href="#">
                                      Send Note
                                  </a>
                                  <a class="list-group-item" href="#">
                                      Send Thank You Note
                                  </a>

                                  <div class="modal" id="modal_wishlist" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
                                      <div class="modal-dialog">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                  <h4 class="modal-title" id="defModalHead">Add Wishlist</h4>
                                              </div>
                                              <div class="modal-body">
                                                  Some content in modal example
                                              </div>
                                              <div class="modal-footer">
                                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </li>
                      -->


                    <!-- END TOGGLE NAVIGATION -->
                </ul>
                <!-- END X-NAVIGATION VERTICAL -->

                <!-- PAGE CONTENT WRAPPER -->
                  @yield('content')
                <!-- END PAGE CONTENT WRAPPER -->
            </div>
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->

    <!-- START SCRIPTS -->
        <!-- START PLUGINS -->
        <script type="text/javascript" src="{{ URL::asset('js/plugins/jquery/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/plugins/jquery/jquery-ui.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/plugins/bootstrap/bootstrap.min.js') }}"></script>
        <!-- END PLUGINS -->

        <!-- THIS PAGE PLUGINS -->
        <script type='text/javascript' src="{{ URL::asset('js/plugins/icheck/icheck.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js') }}"></script>

        <script type="text/javascript" src="{{ URL::asset('js/plugins/knob/jquery.knob.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/plugins/owl/owl.carousel.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/plugins/tagsinput/jquery.tagsinput.min.js') }}"></script>
        <!-- END PAGE PLUGINS -->

        <!-- START TEMPLATE -->
        <script type="text/javascript" src="{{ URL::asset('js/plugins.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/actions.js') }}"></script>
        <script type="text/javascript">
        $(function() {
           $("#datepicker").datepicker();
         });
        </script>
        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->
    </body>
</html>
