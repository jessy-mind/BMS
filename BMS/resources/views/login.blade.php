<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="Bootstrap, Landing page, Template, Business, Service">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="author" content="Grayrids">
    <title>{{ $appTitle }} | Login </title>
    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="{{ asset('landpage/img/2.png') }}" type="image/png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('landpage/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('landpage/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('landpage/css/LineIcons.css') }}">
    <link rel="stylesheet" href="{{ asset('landpage/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('landpage/css/owl.theme.css') }}">
    <link rel="stylesheet" href="{{ asset('landpage/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('landpage/css/nivo-lightbox.css') }}">
    <link rel="stylesheet" href="{{ asset('landpage/css/main.css') }}">    
    <link rel="stylesheet" href="{{ asset('landpage/css/responsive.css') }}">

  </head>
  
  <body>

    <!-- Header Section Start -->
    @include('inc.header')
    <!-- Header Section End --> 




     <!-- Contact Us Section -->
     <section id="contact" class="section p-3">
        <!-- Container Starts -->
        <div class="container ">
          <div class="row justify-content-center">
              <div class="col-md-12 col-lg-12 col-xl-10 p-4">
                  <div class="card shadow-lg o-hidden border-0 my-5 py-5">
                      <div class="card-body p-0">
                          <div class="row">
                              <div class="col-lg-6 d-none d-lg-flex">
                                  <div class="flex-grow-1 bg-login-image m-4" style="background-image: url({{ asset('landpage/img/contact/01.png') }}); "></div>
                              </div>
                              <div class="col-lg-6">
                                  <div class="p-5">
                                      <div class="text-center">
                                          <h4 class="text-dark mb-4">Welcome</h4>
                                      </div>
                                      <form class="user" action="{{ route('login-data') }}" method="post">
                                          @csrf
                                          <div class="mb-3">
                                            <input class="form-control" type="text" placeholder="Enter Email or Phone number" name="email">
                                          </div>
                                          <div class="mb-3">
                                            <input class="form-control" type="password" placeholder="*********" name="password"></div>
                                          <button style="background-color: #2FC101;" class="btn btn-singin form-control ml-0" type="submit">Login</button>
                                          <hr>
                                      </form>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      </section>
      <!-- Contact Us Section End -->

    <!-- Preloader -->
    <div id="preloader">
      <div class="loader" id="loader-1"></div>
    </div>
    <!-- End Preloader -->

    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="{{ asset('landpage/js/jquery-min.js') }}"></script>
    <script src="{{ asset('landpage/js/popper.min.js') }}"></script>
    <script src="{{ asset('landpage/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('landpage/js/owl.carousel.js') }}"></script>      
    <script src="{{ asset('landpage/js/jquery.nav.js') }}"></script>    
    <script src="{{ asset('landpage/js/scrolling-nav.js') }}"></script>    
    <script src="{{ asset('landpage/js/jquery.easing.min.js') }}"></script>     
    <script src="{{ asset('landpage/js/nivo-lightbox.js') }}"></script>     
    <script src="{{ asset('landpage/js/jquery.magnific-popup.min.js') }}"></script>      
    <script src="{{ asset('landpage/js/main.js') }}"></script>
    
  </body>
</html>