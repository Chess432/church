<!--================ Start of Navigation Menu =================-->
<header class="header_area">
    <div class="main_menu">
      <nav class="navbar navbar-expand-lg navbar-light" >
        <div class="container-fluid">
          <a class="navbar-brand logo_h" href="/" class="img-fluid"><img src="{{ asset('images/pefa.png') }}" alt="PEFA SouthB"></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
  
          <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">              
              <li class="nav-item"><a class="nav-link" href="/">Home</a></li>  
              @auth              
              <li class="nav-item"><a class="nav-link" href="/sermons">Sermons</a></li>
              <li class="nav-item"><a class="nav-link" href="/news">News</a></li>
              <li class="nav-item"><a class="nav-link" href="/programs">Programs</a></li>
              @endauth
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
              <!-- Authentication Links -->
              @guest
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                  </li>
                  @if (Route::has('register'))
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                      </li>
                  @endif
              @else
                  <li class="nav-item dropdown">
                      <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                          {{ Auth::user()->name }} <span class="caret"></span>
                      </a>
  
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="{{ route('logout') }}"
                             onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                              {{ __('Logout') }}
                          </a>
  
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              @csrf
                          </form>
                      </div>
                  </li>
              @endguest
          </ul>
          </div> 
        </div>
      </nav>
    </div>
  </header>
  <!--================ End of navigation Menu =================-->