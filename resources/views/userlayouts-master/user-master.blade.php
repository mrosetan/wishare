<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- META SECTION -->
        <title>@yield('title')</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="icon" href="{{ URL::asset('img/icon.png') }}" type="image/x-icon" />
        <!-- END META SECTION -->

        <!-- CSS INCLUDE -->
        <link rel="stylesheet" type="text/css" id="theme" href="{{ URL::asset('css/theme-blue.css') }}"/>
        <link rel="stylesheet" type="text/css" id="theme" href="{{ URL::asset('css/bootstrap/user/userlayouts.css') }}"/>
        <link rel="stylesheet" type="text/css" id="theme" href="{{ URL::asset('css/bootstrap/user/solo-wish.css') }}"/>
        <link rel="stylesheet" href="{{ URL::asset('css/bootstrap/calendar-bootstrap.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/bootstrap/bootstrap-multiselect.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/bootstrap/searchableOptionList.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/bootstrap/sol.css') }}">
        <!-- EOF CSS INCLUDE -->

        <!-- FACEBOOK SHARE -->
        <meta property="og:url"           content="http://www.wishare.net" /> <!-- URL of site -->
        <meta property="og:type"          content="website" />
        <meta property="og:title"         content="Wishare" />
        <meta property="og:description"   content="A Web and Mobile Social Network for Wishing and Wish-granting" />
        <meta property="og:image"         content="" />
    </head>
    <body>
    <!-- Facebook javascript SDK -->
    <div id="fb-root"></div>
      <script>
        window.fbAsyncInit = function() {
          FB.init({
            appId      : '456045444586296',
            xfbml      : true,
            version    : 'v2.5'
          });
          FB.ui({
            method: 'share_open_graph',
            action_type: 'og.likes',
            action_properties: JSON.stringify({
                object:'http://www.wishare.net', //URL of site
              })
            }, function(response){
          });
        };

        (function(d, s, id){
           var js, fjs = d.getElementsByTagName(s)[0];
           if (d.getElementById(id)) {return;}
           js = d.createElement(s); js.id = id;
           js.src = "//connect.facebook.net/en_US/sdk.js";
           fjs.parentNode.insertBefore(js, fjs);
         }(document, 'script', 'facebook-jssdk'));
      </script>
      <!-- End of Facebook javascript SDK -->
        <!-- START PAGE CONTAINER -->
        <div class="page-container page-navigation-top-fixed">

            <!-- START PAGE SIDEBAR -->
            <div class="page-sidebar page-sidebar-fixed scroll">
                <!-- START X-NAVIGATION -->
                <ul class="x-navigation">
                    <li class="xn-logo">
                        <a href="{{ url('user/home') }}"><img class="logo" src="{{ URL::asset('img/logo.png') }}"</a>
                        <a href="#" class="x-navigation-control"></a>
                    </li>
                    <li class="xn-profile">
                        <a href="#" class="profile-mini">
                            <img src="{!! $user->imageurl !!}" alt="{{ $user->firstname }} {{ $user->lastname }}"/>
                        </a>
                        <div class="profile">
                            <div class="profile-image-thumbnail">
                                <img src="{!! $user->imageurl !!}" class="profile-img-thumbnail" alt="{{ $user->username }}"/>
                            </div>
                            <br/>
                            <div class="profile-data">
                                <div class="profile-data-name">{{ $user->firstname }} {{ $user->lastname }}</div>

                            </div>
                            <div class="profile-controls">
                                <!-- <a href="pages-profile.html" class="profile-control-left"><span class="fa fa-info"></span></a> -->
                                <!-- <a href="pages-messages.html" class="profile-control-right"><span class="fa fa-envelope"></span></a> -->
                            </div>
                        </div>
                    </li>
                    <li>
                        <a href="{{ url('user/home') }}"><span class="glyphicon glyphicon-home"></span> <span class="xn-text">Home</span></a>
                    </li>
                    <li>
                        <a href="{!! action('UserProfilesController@profile', $user['id']) !!}"><span class="glyphicon glyphicon-user"></span> <span class="xn-text">Profile</span></a>
                    </li>

                    <!-- <li>
                      <a href="{{ url('user/notifications') }}"><span class="fa fa-globe"></span> <span class="xn-text">Notifications</span></a>
                    </li> -->
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
                    <!-- <li class="xn-openable">
                        <a href="#"><span class="fa fa-gear"></span> <span class="xn-text">Settings</span></a>
                        <ul>
                            <li><a href="{{ url('user/settings') }}"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
                            <li><a href="{{ url('user/settings/changepassword') }}"><span class="fa fa-lock"></span> Change Password</a></li>
                        </ul>
                    </li> -->

                    <li class="xn-openable">
                      <a href="#"><span class="fa fa-gear"></span> <span class="xn-text">Settings</span></a>
                      <ul>
                          <li><a href="{{ url('user/settings') }}"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
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
                            {!! Form::open(array(
                                      'action' => array('UserController@search'),
                                      'class' => 'form')) !!}
                                      {!! Form::text('search', null,
                                                array('class'=>'form-control',
                                                'placeholder'=>'Search...')) !!}
                          {!! Form::close()!!}
                      </li>
                    </div>

                    <li class="xn-icon-button pull-right">
                        <a href="#"><span class="fa fa-tasks"></span></a>
                        <!-- <div class="informer informer-danger">4</div> -->
                        <div class="panel panel-primary animated zoomIn xn-drop-left">
                            <div class="panel-heading">
                                <h3 class="panel-title"><span class="fa fa-tasks"></span> Activity</h3>
                                <!-- <div class="pull-right">
                                    <span class="label label-danger">4 new</span>
                                </div> -->
                            </div>
                            <div class="panel-body list-group list-group-contacts scroll" style="height: 400px;">
                              @if(count($notifs)>0)
                                @foreach($notifs as $n)
                                    @if($n->notificationtype == 'tagged')
                                    <a href="{!! action('SoloWishController@wish', $n->wish['id'] ) !!}" class="list-group-item" style="height: 70px;">
                                      <div class="image-thumbnail inline">
                                        {!! Html::image('' . $n->tagger['imageurl'], '', array('class'=>'pull-left user-image')) !!}
                                      </div>
                                      <span class="contacts-title inline">&nbsp;&nbsp;{!! $n->tagger['firstname'] !!} {!! $n->tagger['lastname'] !!} </span> tagged you in a wish:<br/>
                                      <b>&nbsp;&nbsp;{!! $n->wish['title'] !!}</b>
                                      <small class="pull-right inline">&nbsp;&nbsp;{!! date('F d, Y g:i A', strtotime($n['created_at'])) !!}</small>
                                    </a>
                                    @else
                                      @if($n->user->id != $user->id)
                                      <a href="{!! action('SoloWishController@wish', $n->wish['id'] ) !!}" class="list-group-item" style="height: 60px;">
                                        <div class="image-thumbnail inline">
                                          {!! Html::image('' . $n->user['imageurl'], '', array('class'=>'pull-left user-image')) !!}
                                        </div>
                                        <span class="contacts-title inline">&nbsp;&nbsp;{!! $n->user['firstname'] !!} {!! $n->user['lastname'] !!}&nbsp;</span>{!! $n['notificationtype'] !!} your wish:<br/>
                                        <b>&nbsp;&nbsp;{!! $n->wish['title'] !!}</b>
                                        <small class="pull-right inline">&nbsp;&nbsp;{!! date('F d, Y g:i A', strtotime($n['created_at'])) !!}</small>
                                      </a>
                                      @endif
                                    @endif
                                @endforeach
                              @endif
                            </div>
                        </div>
                    </li>

                    <li class="xn-icon-button pull-right">
                        <a href="#"><span class="fa fa-magic"></span></a>
                        @if(count($grant) > 0)
                          <div class="informer informer-danger">{!! count($grant) !!}</div>
                        @endif
                        <div class="panel panel-primary animated zoomIn xn-drop-left">
                            <div class="panel-heading">
                                <h3 class="panel-title"><span class="fa fa-magic"></span> Grant Requests</h3>
                            </div>
                            <div class="panel-body list-group list-group-contacts scroll" style="height: 400px;">
                              @if(count($grant)>0)
                                @foreach($grant as $g)
                                <a href="{!! action('SoloWishController@wish', $g['id']) !!}" class="list-group-item" style="height: 70px;">
                                    <div class="image-thumbnail inline">
                                      {!! Html::image('' . $g->granter['imageurl'], '', array('class'=>'pull-left user-image')) !!}
                                    </div>

                                    <span class="contacts-title inline">&nbsp;{!! $g->granter['firstname'] !!} {!! $g->granter['lastname'] !!}&nbsp;</span>sent a grant request
                                    <br/>
                                    <b>&nbsp;&nbsp;{!! $g['title'] !!}</b>
                                    <div class="pull-right inline request-btns">
                                      {!! Form::open(array(
                                                    'action' => array('UserController@confirmGrantRequest', $g['id']),
                                                    'class' => 'form friendActions friend-action-button',
                                                    'method'=> 'get')) !!}
                                          {!! Form::submit('Accept', array('class'=>'btn btn-info btn-sm')) !!}
                                      {!! Form::close() !!}
                                      {!! Form::open(array(
                                                    'action' => array('UserController@declineGrantRequest', $g['id']),
                                                    'class' => 'form friendActions friend-action-button',
                                                    'method' => 'get')) !!}
                                          {!! Form::submit('Decline', array('class'=>'btn btn-default btn-sm')) !!}
                                      {!! Form::close() !!}
                                    </div>
                                </a>
                                @endforeach
                                @else
                                <a href="#" class="list-group-item" style="text-align: center;">
                                  No grant request(s).
                                </a>
                              @endif
                            </div>
                        </div>
                    </li>

                    <li class="xn-icon-button pull-right">
                        <a href="#"><span class="fa fa-user"></span></a>
                        @if(count($requests) > 0)
                          <div class="informer informer-info">{!! count($requests) !!}</div>
                        @endif
                        <div class="panel panel-primary animated zoomIn xn-drop-left">
                            <div class="panel-heading">
                                <h3 class="panel-title"><span class="fa fa-user"></span> Friend Requests</h3>
                            </div>
                            <div class="panel-body list-group list-group-contacts scroll" style="height: 400px;">
                              @if(count($requests)>0)
                                @foreach($requests as $r)
                                  <a href="#" class="list-group-item" style="height: 60px;">
                                      <div class="image-thumbnail inline">
                                        {!! Html::image('' . $r->friendRequest['imageurl'], '', array('class'=>'pull-left user-image')) !!}
                                      </div>
                                      <span class="contacts-title inline">&nbsp;{!! $r->friendRequest->firstname !!} {!! $r->friendRequest['lastname'] !!}</span>
                                      <div class="pull-right inline request-btns">
                                        {!! Form::open(array(
                                                      'action' => array('UserController@acceptFriendRequest', $r['id']),
                                                      'class' => 'form friendActions friend-action-button',
                                                      'method' => 'get')) !!}
                                            {!! Form::submit('Accept', array('class'=>'btn btn-info btn-sm')) !!}
                                        {!! Form::close() !!}
                                        {!! Form::open(array(
                                                      'action' => array('UserController@declineFriendRequest', $r['id']),
                                                      'class' => 'form friendActions friend-action-button',
                                                      'method' => 'get')) !!}
                                            {!! Form::submit('Decline', array('class'=>'btn btn-default btn-sm')) !!}
                                        {!! Form::close() !!}
                                      </div>
                                  </a>
                                @endforeach
                              @else
                                <a href="#" class="list-group-item" style="text-align: center;">
                                  No friend request(s).
                                </a>
                              @endif
                            </div>
                        </div>
                    </li>

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
        <script type="text/javascript" src="{{ URL::asset('js/plugins/bootstrap/bootstrap-file-input.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/plugins/bootstrap/bootstrap-datepicker.js') }}"></script>

        <!-- END PLUGINS -->


        <!-- <script src="{{ URL::asset('js/plugins/bootstrap/calendar-bootstrap.js') }}"></script> -->
        <script>
        $.fn.modal.Constructor.prototype.enforceFocus = function() {};

        $(function() {
          var datePicker = $('#datepicker').datepicker();

          $(".demo").scroll(function() {
            datePicker.datepicker('hide');
            $('#datepicker').blur();
          });

          $(window).resize(function() {
            datePicker.datepicker('hide');
            $('#datepicker').blur();
          });
        });

        $('#myTabs a').click(function (e) {
            e.preventDefault();
            $(this).tab('show');
        });

        // store the currently selected tab in the hash value
        $("ul.nav-tabs > li > a").on("shown.bs.tab", function (e) {
            var id = $(e.target).attr("href").substr(1);
            window.location.hash = id;
        });

        // on load of the page: switch to the currently selected tab
        var hash = window.location.hash;
        $('#myTabs a[href="' + hash + '"]').tab('show');

        $("#home-alert").fadeTo(3000, 500).slideUp(500, function(){
          $("#home-alert").alert('close');
        });
        $(function() {
            // initialize sol
            $('#my-select').prop('selectedIndex', -1).searchableOptionList({
              maxHeight: '250px',
              allowNullSelection: true,
            });
        });

        </script>
        <script type='text/javascript' src="{{ URL::asset('js/plugins/icheck/icheck.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js') }}"></script>

        <script type="text/javascript" src="{{ URL::asset('js/plugins/knob/jquery.knob.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/plugins/owl/owl.carousel.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/plugins/tagsinput/jquery.tagsinput.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/plugins/bootstrap/bootstrap-select.js') }}"></script>

        <script type='text/javascript' src="{!! asset('js/plugins/icheck/icheck.min.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js') !!}"></script>

        <script type="text/javascript" src="{!! asset('js/plugins/datatables/jquery.dataTables.min.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/bootstrap-multiselect.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/sol.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/plugins/blueimp/jquery.blueimp-gallery.min.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/jquery.jscroll.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/jquery.jscroll.min.js') !!}"></script>
        <!-- END PAGE PLUGINS -->

        <!-- START TEMPLATE -->
        <script type="text/javascript" src="{{ URL::asset('js/plugins.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/actions.js') }}"></script>

        <script type="text/javascript" src="{{ URL::asset('js/user_side.js') }}"></script>

        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->
    </body>
</html>
