<!DOCTYPE html>
<html>
    <head>
        <!-- META SECTION -->
        <title>@yield('title')</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <link rel="icon" href="img/icon.png" type="image/x-icon" />
        <!-- END META SECTION -->

        <!-- CSS INCLUDE -->
        <link rel="stylesheet" type="text/css" id="theme" href="{{ URL::asset('css/theme-default.css') }}"/>
        <link rel="stylesheet" type="text/css" id="theme" href="{{ URL::asset('css/bootstrap/custom-auth.css') }}"/>
        <!-- EOF CSS INCLUDE -->
    </head>
    <body>

      <!-- <script>
        window.fbAsyncInit = function() {
          FB.init({
            appId      : '456045444586296',
            xfbml      : true,
            version    : 'v2.5'
          });
        };

        (function(d, s, id){
           var js, fjs = d.getElementsByTagName(s)[0];
           if (d.getElementById(id)) {return;}
           js = d.createElement(s); js.id = id;
           js.src = "//connect.facebook.net/en_US/sdk.js";
           fjs.parentNode.insertBefore(js, fjs);
         }(document, 'script', 'facebook-jssdk'));
      </script> -->

      <div class="container-fluid" >
      <!--  <div class="login-header"> -->
        <div class="row">
            <a href="{{ URL::to('/')}}"><img src="img/logo.png" class="logo-header"></a>
            <!-- <div class="button-container">
              <div class="row">
                <div class="col-sm-6">
                  <a class="btn btn-info btn-lg btn-signin" href="{{ URL::to('signin')}}">Sign In</a>
                </div>
                <div class="col-sm-6">
                  <a type="button" class="btn btn-info btn-lg btn-signup" href="{{ URL::to('signup')}}">Sign Up</a>
                </div>
              </div>
            </div> -->
          </div>
        <!--</div>
      -->
        @yield('content')
      </div>
    </body>
</html>
