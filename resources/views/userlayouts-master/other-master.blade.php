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
        <link rel="stylesheet" type="text/css" id="theme" href="{{ URL::asset('css/bootstrap/user/userprofile.css') }}"/>
        <link rel="stylesheet" type="text/css" id="theme" href="{{ URL::asset('css/bootstrap/user/userlayouts.css') }}"/>
        <link rel="stylesheet" type="text/css" id="theme" href="{{ URL::asset('css/bootstrap/user/solo-wish.css') }}"/>
        <link rel="stylesheet" href="{{ URL::asset('css/bootstrap/calendar-bootstrap.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/bootstrap/bootstrap-multiselect.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/bootstrap/searchableOptionList.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/bootstrap/sol.css') }}">
        <!-- EOF CSS INCLUDE -->

        <!-- FACEBOOK SHARE -->
        <meta property="og:url"           content="http://www.9gag.com" /> <!-- URL of site -->
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
                  object:'http://www.9gag.com', //URL of site
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
        <div class="page-container page-navigation-top">
            <!-- PAGE CONTENT -->
            <div class="page-content">

                <!-- START X-NAVIGATION VERTICAL -->
                <ul class="x-navigation x-navigation-horizontal">
                    <li class="xn-logo">
                        <a href="{{ url('user/home') }}"><img class="logo" src="{{ URL::asset('img/logo.png') }}"</a>
                        <a href="#" class="x-navigation-control"></a>
                    </li>
                    <!-- DASHBOARD -->
                    <li class="pull-right">
                      <a href="{{ URL::to('user/home') }}"><span class="fa fa-arrow-circle-o-left"></span>Dashboard</a>
                    </li>
                    <!-- END DASHBOARD -->
                </ul>
                <!-- END X-NAVIGATION VERTICAL -->
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                  <div class="row">
                    <div class="profile-action-container">
                      <div class="col-md-3 col-md-offset-1">
                        <br/>
                        <div class="panel panel-default">
                            <div class="panel-body profile">
                            <!-- COVER PHOTO -->
                            <!-- <div class="panel-body profile" style="background: url('assets/images/gallery/music-4.jpg') center center no-repeat;"> -->
                            <!-- END OF COVER PHOTO -->
                              <div class="profile-image">
                                  <img src="{!! $otherUser['imageurl'] !!}" />
                              </div>
                              <div class="profile-data">
                                  <div class="profile-data-name">{!! $otherUser['firstname'] !!} {!! $otherUser['lastname'] !!}</div>
                                  <div class="profile-data-title" style="color: #FFF;">{!! $otherUser['city'] !!}</div>
                              </div>
                            </div>
                            <!--ADD AS FRIEND -->
                            <div class="panel-body">
                                <div class="row">
                                    <div class="">
                                        @if(count($requests)>0)
                                          @foreach($requests as $req)
                                            <div class="row accept-or-decline">
                                              <p class="text-center">
                                                You have a friend request from this user.
                                              </p>
                                              <div class="col-md-6">
                                                {!! Form::open(array(
                                                              'action' => array('UserController@acceptFriendRequest', $req->id),
                                                              'class' => 'form friendActions',
                                                              'method' => 'get')) !!}
                                                    {!! Form::submit('Accept', array('class'=>'btn btn-info btn-rounded btn-block')) !!}
                                                {!! Form::close() !!}
                                              </div>
                                              <div class="col-md-6">
                                                {!! Form::open(array(
                                                              'action' => array('UserController@declineFriendRequest', $req->id),
                                                              'class' => 'form friendActions',
                                                              'method' => 'get')) !!}
                                                    {!! Form::submit('Decline', array('class'=>'btn btn-info btn-rounded btn-block')) !!}
                                                {!! Form::close() !!}
                                              </div>



                                              <!-- <a href="{!! action('UserController@acceptFriendRequest', $req->id) !!}" class="btn btn-info">Accept</a>
                                              <a href="{!! action('UserController@declineFriendRequest', $req->id) !!}" class="btn btn-default">Decline</a> -->
                                            </div>
                                          @endforeach
                                        @else
                                          @if(isset($status) and ($status == 0 || $status == 1))

                                            @if($status == 0)
                                              {!! Form::open(array(
                                                            'action' => array('UserController@cancelFriendRequest', $otherUser->id),
                                                            'class' => 'form friendActions',
                                                            'method' => 'get')) !!}
                                                  {!! Form::submit('Cancel Friend Request', array('class'=>'btn btn-info btn-rounded btn-block')) !!}
                                              {!! Form::close() !!}
                                              <!-- <a href="{!! action('UserController@cancelFriendRequest', $otherUser->id) !!}" class="btn btn-info btn-default">Cancel Friend Request</a> -->
                                            @endif
                                            @if($status == 1)
                                              {!! Form::open(array(
                                                            'action' => array('UserController@unfriend', $otherUser->id),
                                                            'class' => 'form friendActions',
                                                            'method' => 'get')) !!}
                                                  {!! Form::submit('Unfriend', array('class'=>'btn btn-info btn-rounded btn-block')) !!}
                                              {!! Form::close() !!}
                                              <!-- <a href="{!! action('UserController@unfriend', $otherUser->id) !!}" class="btn btn-info btn-default">Unfriend</a> -->
                                            @endif
                                          @else
                                            {!! Form::open(array(
                                                          'action' => array('UserController@addFriend', $otherUser->id),
                                                          'class' => 'form friendActions',
                                                          'method' => 'get')) !!}
                                                {!! Form::submit('Add as Friend', array('class'=>'btn btn-info btn-rounded btn-block')) !!}
                                            {!! Form::close() !!}
                                            <!-- <a href="{!! action('UserController@addFriend', $otherUser->id) !!}" class="btn btn-info btn-default">Add as Friend</a> -->

                                          @endif
                                        @endif

                                        <!-- <button class="btn btn-info btn-rounded btn-block"><span class="fa fa-plus"></span> Add as Friend</button> -->

                                    </div>
                                </div>
                            </div>
                            <!--END OF ADD AS FRIEND -->
                            <div class="panel-body list-group border-bottom">
                                <a href="{!! action('OtherUserController@profile', $otherUser['id']) !!}" class="list-group-item"><span class="fa fa-home"></span> Profile Home </a>
                                <a href="{!! action('OtherUserController@wishWishlists', $otherUser['id']) !!}" class="list-group-item"><span class="fa fa-list-ul"></span> Wishlists and Wishes </a>
                                <a href="{!! action('OtherUserController@granted', $otherUser['id']) !!}" class="list-group-item"><span class="fa fa-magic"></span> Wishes Granted </a>
                                <a href="{!! action('OtherUserController@given', $otherUser['id']) !!}" class="list-group-item"><span class="fa fa-gift"></span> Wishes Given </a>
                                <a href="{!! action('OtherUserController@tracked', $otherUser['id']) !!}" class="list-group-item"><span class="fa fa-bookmark"></span> Tracked Wishes </a>
                                <a href="{!! action('OtherUserController@friends', $otherUser['id']) !!}" class="list-group-item"><span class="fa fa-users"></span> Friends </a>
                                <a href="{!! action('OtherUserController@tynotes', $otherUser['id']) !!}" class="list-group-item"><span class="fa fa-envelope"></span> Thank You Notes </a>
                            </div>
                        </div>

                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="profile-content-container">
                        @yield('newcontent')
                      </div>
                    </div>
                  </div>

                </div>
                <!-- PAGE CONTENT WRAPPER -->
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
            <script type="text/javascript" src="{!! asset('js/plugins/blueimp/jquery.blueimp-gallery.min.js') !!}"></script>


            <!-- END PLUGINS -->


            <!-- <script src="{{ URL::asset('js/plugins/bootstrap/calendar-bootstrap.js') }}"></script> -->
            <script>
            //  $(function() {
            //    var date = $('#datepicker').datepicker();
            //    //$( "#datepicker" ).datepicker();
            //  });
            // $(function() {
            //     $("#datepicker" ).datepicker({
            //       container:'#myDatePicker'
            //     });
            //   });

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

            $("a.list-group-item").on("click",function(e){
             var previous = $(this).closest(".list-group").children(".active");
             previous.removeClass("active"); // previous list-item
             $(e.target).addClass("active"); // activated list-item
           });
            // document.getElementById('links').onclick = function (event) {
            //     event = event || window.event;
            //     var target = event.target || event.srcElement;
            //     var link = target.src ? target.parentNode : target;
            //     var options = {index: link, event: event,onclosed: function(){
            //             setTimeout(function(){
            //                 $("body").css("overflow","");
            //             },200);
            //         }};
            //     var links = this.getElementsByTagName('a');
            //     blueimp.Gallery(links, options);
            // };

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
