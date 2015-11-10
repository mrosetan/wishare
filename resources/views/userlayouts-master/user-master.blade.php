<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- META SECTION -->
        <title>@yield('title')</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <link rel="icon" href="{{ URL::asset('img/icon.png') }}" type="image/x-icon" />
        <!-- END META SECTION -->

        <!-- CSS INCLUDE -->
        <link rel="stylesheet" type="text/css" id="theme" href="{{ URL::asset('css/theme-blue.css') }}"/>
        <link rel="stylesheet" type="text/css" id="theme" href="{{ URL::asset('css/bootstrap/user/userlayouts.css') }}"/>
        <link rel="stylesheet" href="{{ URL::asset('css/bootstrap/calendar-bootstrap.css') }}">
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
                        <a href="{{ url('user/notes') }}"><span class="glyphicon glyphicon-envelope"></span> <span class="xn-text">Notes</span></a>
                    </li>
                    <li>
                        <a href="{{ url('user/action/wishlist') }}"><span class="fa fa-list-ul"></span><span class="xn-text">Create a Wishlist</span></a>
                    </li>
                    <li>
                        <a href="{{ url('user/action/wish') }}"><span class="fa fa-magic"></span><span class="xn-text">Add Wish</span></a>
                    </li>
                    <li>
                        <a href="{{ url('user/action/notes') }}"><span class="glyphicon glyphicon-envelope"></span><span class="xn-text">Send Note</span></a>
                    </li>
                    <li>
                        <a href="{{ url('user/action/tynotes') }}"><class="mb-control" data-box="#mb-tynotes"><span class="glyphicon glyphicon-envelope"></span><span class="xn-text">Send Thank You Note</span></a>
                    </li>
                    <li>
                        <a href="{{ url('user/help') }}"><span class="fa fa-question-circle"></span> <span class="xn-text">Help</span></a>
                    </li>
                    <li class="xn-openable">
                        <a href="#"><span class="fa fa-gear"></span> <span class="xn-text">Settings</span></a>
                        <ul>
                            <li><a href="{{ url('user/settings/profile') }}"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
                            <li><a href="{{ url('user/settings/changepassword') }}"><span class="fa fa-lock"></span> Change Password</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ url('auth/signout') }}"><span class="fa fa-power-off"></span> <span class="xn-text">Sign Out</span></a>
                    </li>
                </ul>
                <!-- END X-NAVIGATION -->
            </div>
            <!-- END PAGE SIDEBAR -->

            <!-- PAGE CONTENT -->
            <div class="page-content">


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
        <script src="{{ URL::asset('js/plugins/bootstrap/calendar-bootstrap.js') }}"></script>
        <script>
         $(function() {
           var date = $('#datepicker').datepicker({ dateFormat: 'yy-mm-dd' }).val();
           //$( "#datepicker" ).datepicker();
         });
        </script>
        <script type='text/javascript' src="{{ URL::asset('js/plugins/icheck/icheck.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js') }}"></script>

        <script type="text/javascript" src="{{ URL::asset('js/plugins/knob/jquery.knob.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/plugins/owl/owl.carousel.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/plugins/tagsinput/jquery.tagsinput.min.js') }}"></script>
        <!-- END PAGE PLUGINS -->

        <!-- START TEMPLATE -->
        <script type="text/javascript" src="{{ URL::asset('js/plugins.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/actions.js') }}"></script>

        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->
    </body>
</html>
