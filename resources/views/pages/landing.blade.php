<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>wishare</title>

    <!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: http://bootswatch.com/flatly/ -->
    <link href="{{ URL::asset('freelancer/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('freelancer/css/custom.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ URL::asset('freelancer/css/freelancer.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ URL::asset('freelancer/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top" class="index">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#page-top">wishare</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li class="page-scroll">
                        <a href="#header2">About</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#howitworks">How It Works</a>
                    </li>
                    <!-- <li class="page-scroll">
                        <a href="#contact">Contact</a>
                    </li> -->
                    <li >
                        <a href="http://download.wishare.net/">Get the android app</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <header id="lp-main" class="heroshot">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <img class="img-responsive lp-header-logo" src="{{ URL::asset('img/logo.png') }}" alt="">
                    <br/>
                    <br/>
                    <div class="intro-text">
                        <span class="name">Wishing & <br/> wish-granting socialized.</span>
                        <!-- <hr class="star-light"> -->
                        <span class="skills">Bring wishes closer to reality.</span>
                    </div>

                    <!-- <div class="row">
                        <div class="form-group col-xs-6 col-xs-offset-3">
                            <a type="submit" class="btn btn-outline btn-lg">Download wishare for Android</a>
                        </div>

                    </div> -->
                </div>
            </div>
            <br/>
            <br/>

            <div class="row">
                <div class="col-lg-4 col-lg-offset-4 text-center">
                  <a href="{!! action('AuthController@redirectToProvider') !!}" type="submit" class="btn button-fb btn-block">Connect with Facebook</a>
                  <a href="{{ URL::to('signin')}}" type="submit" class="btn btn-success btn-block">Sign In</a>
                  <a href="{{ URL::to('signup')}}" type="submit" class="btn btn-success btn-block">Sign Up</a>
                </div>
            </div>

        </div>
    </header>

    <!-- Grid Section -->
    <section id="header2">
        <div class="container lp-2nd-header">

            <div class="row">
                <!-- <div class="col-lg-6-offset-3 "> -->
                  <div class="col-sm-3 col-lg-offset-2">
                    <img class="center-block" src="{{ URL::asset('img/logo1.jpg') }}" alt="" />
                  </div>
                  <div class="col-sm-5" >
                      <h3>Wishare is a web and mobile social network for wishing and wish-granting.</h3>
                      <p>
                        Share, update, and keep track of your wishes and the things you have received.
                      </p>

                      <p>
                        Find the perfect thing to give someone.
                      </p>

                      <p>
                        Say goodbye to unorganized wishes and wishlists.
                      </p>
                  </div>
                <!-- </div> -->
            </div>

        </div>
    </section>

    <!-- Portfolio Grid Section -->
    <!-- <section id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Portfolio</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 portfolio-item">
                    <a href="#portfolioModal1" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="img/portfolio/cabin.png" class="img-responsive" alt="">
                    </a>
                </div>
                <div class="col-sm-4 portfolio-item">
                    <a href="#portfolioModal2" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="img/portfolio/cake.png" class="img-responsive" alt="">
                    </a>
                </div>
                <div class="col-sm-4 portfolio-item">
                    <a href="#portfolioModal3" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="img/portfolio/circus.png" class="img-responsive" alt="">
                    </a>
                </div>
                <div class="col-sm-4 portfolio-item">
                    <a href="#portfolioModal4" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="img/portfolio/game.png" class="img-responsive" alt="">
                    </a>
                </div>
                <div class="col-sm-4 portfolio-item">
                    <a href="#portfolioModal5" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="img/portfolio/safe.png" class="img-responsive" alt="">
                    </a>
                </div>
                <div class="col-sm-4 portfolio-item">
                    <a href="#portfolioModal6" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="img/portfolio/submarine.png" class="img-responsive" alt="">
                    </a>
                </div>
            </div>
        </div>
    </section> -->

    <!-- About1 -->
    <section class="about1" id="howitworks">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Keep track of your wishes</h2>
                    <h4>Share your wishes and wants to your friends</h4>
                    <p class="text16">You never know, someone out there is looking for the perfect thing to give you.</p>
                </div>
            </div>
            <br />
            <br />
            <div class="row">
                <div class="col-lg-4 text-center">
                    <img class="center-block lp-icons" src="{{ URL::asset('img/lp/1.png') }}" alt="" />
                    <p class="text16">Organize your wishes <br />into different wishlists.</p>
                </div>
                <div class="col-lg-4 text-center">
                    <img class="center-block lp-icons" src="{{ URL::asset('img/lp/2.png') }}" alt="" />
                    <p class="text16">Set wishlists to be either <br />public or private.</p>
                </div>
                <div class="col-lg-4 text-center">
                    <img class="center-block lp-icons" src="{{ URL::asset('img/lp/3.png') }}" alt="" />
                    <p class="text16">Share your wishlists to another <br />social networking site(s).</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About2 Section -->
    <section class="success about2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Find out the wishes of your friends.</h2>
                    <h4>Now you won't have to waste time on thinking what to give someone.</h4>
                    <p class="text16">Scroll through your events stream or check out yout friends' profile to be <br />updated on things your friends want.</p>
                </div>
            </div>
            <br />
            <br />
            <div class="row text-center">
                <div class="col-lg-3">
                    <img class="center-block lp-icons" src="{{ URL::asset('img/lp/4.png') }}" alt="" />
                    <p class="text16">Favorite Wishes</p>
                </div>
                <div class="col-lg-3">
                    <img class="center-block lp-icons" src="{{ URL::asset('img/lp/5.png') }}" alt="" />
                    <p class="text16">Track Wishes</p>
                </div>
                <div class="col-lg-3">
                    <img class="center-block lp-icons" src="{{ URL::asset('img/lp/6.png') }}" alt="" />
                    <p class="text16">Rewish wishes</p>
                </div>
                <div class="col-lg-3">
                    <img class="center-block lp-icons" src="{{ URL::asset('img/lp/7.png') }}" alt="" />
                    <p class="text16">Grant Wishes</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About3 Section -->
    <section id="about3">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Other Features</h2>
                    <br />
                </div>
            </div>
            <div class="row text-center">
                <div class="col-lg-4 col-lg-offset-2">
                    <img class="center-block lp-icons" src="{{ URL::asset('img/lp/8.png') }}" alt="" />
                    <h4>Private Messaging</h4>
                    <p class="text16">Send private messages or notes to keep in contact and communicate with your friends.</p>
                </div>
                <div class="col-lg-4">
                    <img class="center-block lp-icons" src="{{ URL::asset('img/lp/9.png') }}" alt="" />
                    <h4>Tag</h4>
                    <p class="text16">Tag friends to wishes to bring their attention to those.</p>
                </div>
            </div>

            <div class="row text-center">
                <div class="col-lg-4 col-lg-offset-4">
                    <img class="center-block lp-icons" src="{{ URL::asset('img/lp/10.png') }}" alt="" />
                    <h4>Share the things you have received</h4>
                    <p class="text16">Tell your friends about your wishes that came true.</p>
                </div>
            </div>

            <div class="row text-center">
                <div class="col-lg-4 col-lg-offset-2">
                    <img class="center-block lp-icons" src="{{ URL::asset('img/lp/11.png') }}" alt="" />
                    <h4>Thank You Notes</h4>
                    <p class="text16" >Show your appreciation to whoever granted your wish by sending then a Thank You Note.</p>
                </div>
                <div class="col-lg-4">
                    <img class="center-block lp-icons" src="{{ URL::asset('img/lp/12.png') }}" alt="" />
                    <h4>Event Stream</h4>
                    <p class="text16">Be updated on your friends' wishes and granted wishes.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- pre footer -->
    <section id="prefooter">
      <div class="container">
          <div class="row">
              <div class="col-lg-12 text-center">
                  <h2>JOIN WISHARE TODAY!</h2>
              </div>
          </div>
          <br />
          <br />
          <br />
          <div class="row">
              <div class="col-lg-8 col-lg-offset-2 text-center">
                  <a href="{{ URL::to('signup')}}" class="btn btn-lg btn-outline">
                      Sign up now - It's free!
                  </a>
              </div>
          </div>
      </div>
    </section>

    <!-- About Section -->
    <!-- <section class="success" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>About</h2>
                    <hr class="star-light">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-lg-offset-2">
                    <p>Freelancer is a free bootstrap theme created by Start Bootstrap. The download includes the complete source files including HTML, CSS, and JavaScript as well as optional LESS stylesheets for easy customization.</p>
                </div>
                <div class="col-lg-4">
                    <p>Whether you're a student looking to showcase your work, a professional looking to attract clients, or a graphic artist looking to share your projects, this template is the perfect starting point!</p>
                </div>
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <a href="#" class="btn btn-lg btn-outline">
                        <i class="fa fa-download"></i> Download Theme
                    </a>
                </div>
            </div>
        </div>
    </section> -->

    <!-- Contact Section -->
    <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
    <!-- The form should work on most web servers, but if the form is not working you may need to configure your web server differently. -->
    <!-- <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Contact Me</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2"> -->

                    <!-- <form name="sentMessage" id="contactForm" novalidate>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Name</label>
                                <input type="text" class="form-control" placeholder="Name" id="name" required data-validation-required-message="Please enter your name.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Email Address</label>
                                <input type="email" class="form-control" placeholder="Email Address" id="email" required data-validation-required-message="Please enter your email address.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Phone Number</label>
                                <input type="tel" class="form-control" placeholder="Phone Number" id="phone" required data-validation-required-message="Please enter your phone number.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Message</label>
                                <textarea rows="5" class="form-control" placeholder="Message" id="message" required data-validation-required-message="Please enter a message."></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <br>
                        <div id="success"></div>
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <button type="submit" class="btn btn-success btn-lg">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section> -->

    <!-- Footer -->
    <footer class="text-center">
        <div class="footer-above">
            <div class="container">
                <div class="row">
                    <div class="footer-col col-md-4">
                        <h3>Location</h3>
                        <p>Cebu City, Philippines<br>6000</p>
                    </div>
                    <div class="footer-col col-md-4">
                        <h3>Around the Web</h3>
                        <ul class="list-inline">
                            <li>
                                <a href="https://www.facebook.com/wishare.net/" class="btn-social btn-outline"><i class="fa fa-fw fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-google-plus"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-linkedin"></i></a>
                            </li>
                        </ul>

                        <p>
                          or email us at <br/>appwishare@gmail.com
                        </p>
                    </div>
                    <div class="footer-col col-md-4">
                        <h3>About wishare</h3>
                        <p>wishare is a web and mobile social network for wishing and wish-granting.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-below">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        Copyright &copy; wishare 2016
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-top page-scroll visible-xs visible-sm">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>

    <!-- Portfolio Modals -->
    <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Project Title</h2>
                            <hr class="star-primary">
                            <img src="img/portfolio/cabin.png" class="img-responsive img-centered" alt="">
                            <p>Use this area of the page to describe your project. The icon above is part of a free icon set by <a href="https://sellfy.com/p/8Q9P/jV3VZ/">Flat Icons</a>. On their website, you can download their free set with 16 icons, or you can purchase the entire set with 146 icons for only $12!</p>
                            <ul class="list-inline item-details">
                                <li>Client:
                                    <strong><a href="http://startbootstrap.com">Start Bootstrap</a>
                                    </strong>
                                </li>
                                <li>Date:
                                    <strong><a href="http://startbootstrap.com">April 2014</a>
                                    </strong>
                                </li>
                                <li>Service:
                                    <strong><a href="http://startbootstrap.com">Web Development</a>
                                    </strong>
                                </li>
                            </ul>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- jQuery -->
    <script src="{{ URL::asset('freelancer/js/jquery.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ URL::asset('freelancer/js/bootstrap.min.js') }}"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="{{ URL::asset('freelancer/js/classie.js') }}"></script>
    <script src="{{ URL::asset('freelancer/js/cbpAnimatedHeader.js') }}"></script>

    <!-- Contact Form JavaScript -->
    <script src="{{ URL::asset('freelancer/js/jqBootstrapValidation.js') }}"></script>
    <script src="{{ URL::asset('freelancer/js/contact_me.js') }}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{ URL::asset('freelancer/js/freelancer.js') }}"></script>

</body>

</html>
