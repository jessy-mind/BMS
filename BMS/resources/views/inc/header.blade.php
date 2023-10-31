<header id="home" class="hero-area">    
    <div class="overlay">
      <span></span>
      <span></span>
    </div>
    @if (url()->current() != route('login'))
        <nav class="navbar navbar-expand-md bg-inverse fixed-top scrolling-navbar">
    @else
        <nav class="navbar navbar-expand-md bg-inverse scrolling-navbar menu-bg">
    @endif
      <div class="container">
        <a href="index.html" class="navbar-brand"><img src="{{ asset('landpage/img/logo.png') }}" alt=""></a>       
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <i class="lni-menu"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto w-100 justify-content-end">
            <li class="nav-item">
              @if (url()->current() != route('home'))
                <a class="nav-link page-scroll" href="{{ route('home') }}">Home</a>
              @else
                <a class="nav-link page-scroll" href="#home">Home</a>
              @endif
            </li>
            <li class="nav-item">
              <a class="nav-link page-scroll" href="#services">About</a>
            </li>  
            <li class="nav-item">
              <a class="nav-link page-scroll" href="#features">Services</a>
            </li>                            
            <li class="nav-item">
              <a class="nav-link page-scroll" href="#showcase">Showcase</a>
            </li>       
            <li class="nav-item">
              <a class="nav-link page-scroll" href="#pricing">Pricing</a>
            </li>     
            <li class="nav-item">
              <a class="nav-link page-scroll" href="#team">Team</a>
            </li> 
            <li class="nav-item">
              <a class="nav-link page-scroll" href="#blog">Blog</a>
            </li>  
            <li class="nav-item">
              <a class="nav-link page-scroll" href="#contact">Contact</a>
            </li> 
            <li class="nav-item">
             @if (Auth::check())
              <a class="btn btn-singin" href="/dashboard">Dashboard</a>
             @else
              @if (url()->current() != route('login'))
                <a class="btn btn-singin" href="/login">Login</a>
              @endif
             @endif
            </li>
          </ul>
        </div>
      </div>
    </nav>  
    @if (url()->current() != route('login'))
        <div class="container">      
            <div class="row space-100">
            <div class="col-lg-6 col-md-12 col-xs-12">
                <div class="contents">
                <h2 class="head-title">Business Management  <br>System  (BMS)</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab <br>dolores ea fugiat nesciunt quisquam.</p>
                <div class="header-button">
                    <a href="#" class="btn btn-border-filled">Get Started</a>
                    <a href="#contact" class="btn btn-border page-scroll">Contact Us</a>
                </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-xs-12 p-0">
                <div class="intro-img">
                <img src="{{ asset('landpage/img/intro.png') }}" alt="">
                </div>            
            </div>
            </div> 
        </div> 
    @endif            
  </header>