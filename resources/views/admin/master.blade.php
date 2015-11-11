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
        <link rel="stylesheet" type="text/css" id="theme" href="{{ URL::asset('css/theme-default.css') }}"/>
        <link rel="stylesheet" type="text/css" id="theme" href="{{ URL::asset('css/bootstrap/admin-styles.css') }}"/>
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
                        <a href="{{ URL::to('/admin')}}">Admin</a>
                        <a href="#" class="x-navigation-control"></a>
                    </li>

                    <!-- <li class="xn-title">Navigation</li> -->
                    <li><a href="{{ URL::to('/admin')}}"><img src="{{ URL::asset('img/logo.png') }}" class="admin-logo"></a></li>

                    <li>
                        <a href="{{ URL::to('/admin')}}"><span class="glyphicon glyphicon-home"></span> <span class="xn-text">Home</span></a>
                    </li>

                    <li>
                        <a href="{{ URL::to('/admin/reports')}}"><span class="fa fa-file"></span> <span class="xn-text">Reports</span></a>
                    </li>

                    <li>
                        <a href="{{ URL::to('/admin/search')}}"><span class="fa fa-search"></span> <span class="xn-text">Search Users</span></a>
                    </li>

                    <li class="xn-openable">
                        <a href="#"><span class="fa fa-file-text-o"></span> <span class="xn-text">Monitoring</span></a>
                        <ul>
                            <li><a href="{{ URL::to('/admin/monitor/users')}}"><span class="fa fa-users"></span> Active Users</a></li>
                            <li><a href="{{ URL::to('/admin/monitor/wishes')}}"><span class="fa fa-star"></span> Wishes</a></li>
                            <li><a href="{{ URL::to('/admin/monitor/wishlists')}}"><span class="fa fa-list"></span> Wishlists</a></li>
                        </ul>
                    </li>

                    <li class="xn-openable">
                        <a href="#"><span class="fa fa-users"></span> <span class="xn-text">Admin Accounts</span></a>
                        <ul>
                            <li><a href="{{ URL::to('/admin/create/admin')}}"><span class="glyphicon glyphicon-plus-sign"></span> Add New Admin</a></li>
                            <li><a href="{{ URL::to('/admin/view/admins')}}"><span class="glyphicon glyphicon-list"></span> View Admins</a></li>
                        </ul>
                    </li>

                    <li class="xn-openable">
                        <a href="#"><span class="fa fa-list"></span> <span class="xn-text">Default Wishlists</span></a>
                        <ul>
                            <li><a href="{{ URL::to('/admin/create/defaultwishlist')}}"><span class="glyphicon glyphicon-plus-sign"></span> Add New Default Wishlist</a></li>
                            <li><a href="{{ URL::to('/admin/view/defaultwishlists')}}"><span class="glyphicon glyphicon-list"></span> View Default Wishlists</a></li>
                        </ul>
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
                    <!-- END TOGGLE NAVIGATION -->
                    <!-- SIGN OUT -->
                    <li class="xn-icon-button pull-right">
                        <a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span></a>


                    </li>
                    <!-- END SIGN OUT -->
                </ul>
                <!-- END X-NAVIGATION VERTICAL -->

                <!-- START BREADCRUMB -->
                <!-- <ul class="breadcrumb">
                    <li><a href="#">Link</a></li>
                    <li class="active">Active</li>
                </ul> -->
                <!-- END BREADCRUMB -->

                <div class="page-title">
                    <h2> @yield('title')</h2>
                </div>

                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">

                    @yield('content')
                    <!-- <div class="row">
                        <div class="col-md-12">

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Panel Title</h3>
                                </div>
                                <div class="panel-body">
                                    Panel body
                                </div>
                            </div>

                        </div>
                    </div> -->

                </div>
                <!-- END PAGE CONTENT WRAPPER -->
            </div>
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->

        <!-- MESSAGE BOX-->
        <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
                    <div class="mb-content">
                        <p>Are you sure you want to log out?</p>
                        <p>Press No if youwant to continue work. Press Yes to logout current user.</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href="{{ url('/auth/signout') }}" class="btn btn-success btn-lg">Yes</a>
                            <button class="btn btn-default btn-lg mb-control-close">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MESSAGE BOX-->

        <!-- START PRELOADS -->
        <audio id="audio-alert" src="audio/alert.mp3" preload="auto"></audio>
        <audio id="audio-fail" src="audio/fail.mp3" preload="auto"></audio>
        <!-- END PRELOADS -->

    <!-- START SCRIPTS -->
        <!-- START PLUGINS -->
        <script type="text/javascript" src="{!! asset('js/plugins/jquery/jquery.min.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/plugins/jquery/jquery-ui.min.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/plugins/bootstrap/bootstrap.min.js') !!}"></script>
        <!-- END PLUGINS -->

        <!-- THIS PAGE PLUGINS -->

        <!-- END PAGE PLUGINS -->

        <!-- START TEMPLATE -->

        <script type="text/javascript" src="{!! asset('js/plugins.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/actions.js') !!}"></script>
        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->
    </body>
</html>
