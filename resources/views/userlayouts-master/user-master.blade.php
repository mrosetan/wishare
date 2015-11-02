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
        <div class="page-container">

            <!-- START PAGE SIDEBAR -->
            <div class="page-sidebar">
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
                        <a href="#"><span class="fa fa-globe"></span> <span class="xn-text">Notifications</span></a>
                    </li>
                    <li>
                        <a href="#"><span class="glyphicon glyphicon-envelope"></span> <span class="xn-text">Notes</span></a>
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

                      <li class="xn-icon-button pull-right">
                          <a href="#"><span class="fa fa-pencil-square"></span></a>
                          <div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
                              <div class="panel-heading">
                                  <h3 class="panel-title"></span> Actions</h3>
                              </div>
                              <div class="panel-body list-group" style="height: 150px;">
                                  <a class="list-group-item" href="#">
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
                              </div>
                          </div>
                      </li>
                    </div>
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
        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->
    </body>
</html>
