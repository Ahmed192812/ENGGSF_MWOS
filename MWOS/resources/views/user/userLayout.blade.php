<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'MWOS') }}</title>

  <!-- Styles -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

  <!-- Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>

<body class="bg-light">
  <div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3">
      <a href="{{ route('user.dashboard') }}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <img src="{{ asset('logo/logo.png') }}" alt="Logo" width="35">
        <span class="fs-5 ms-2 fw-bold">Mondale Woodworks</span>
      </a>
      <ul class="nav nav-pills">
        <li class="nav-item"><a href="{{ route('user.dashboard') }}" class="nav-link text-decoration-none">Home</a></li>
        <li class="nav-item"><a href="" class="nav-link text-decoration-none">About</a></li>
        <!-- <li class="nav-item btn-group">           
          <a class="nav-link d-block text-decoration-none dropdown-toggle" type="button" id="dropdownMenuClickableInside" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
            E-Catalog
          </a>
          <ul class="dropdown-menu">
            <li class="nav-item dropend">
              <a class="dropdown-item" type="button" id="dropdownMenuClickableInside" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                <div class="row g-0">
                  <div class="col">Bedroom</div>
                  <div class="col text-end"><i class="bi bi-caret-right-fill"></i></div>
                </div>
              </a>
              <ul class="dropdown-menu">
                <li>
                  <form method="POST" action="{{ route('user.catalog') }}">
                    <input type="hidden" value="3">
                    <a class="dropdown-item" type="submit">Bed Frame</a>
                  </form>
                </li>
                <li><a class="dropdown-item" href="#">Night Stands</a></li>
                <li><a class="dropdown-item" href="#">Wardrobe</a></li>
              </ul>
            </li>
            <li class="nav-item dropend">
              <a class="dropdown-item" type="button" id="dropdownMenuClickableInside" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                <div class="row g-0">
                  <div class="col">Living Room</div>
                  <div class="col text-end"><i class="bi bi-caret-right-fill"></i></div>
                </div>
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Accent Tables</a></li>
                <li>
                  <form method="GET" action="{{ route('user.catalog') }}">
                    @csrf
                    <input type="hidden" name="category" value="Sofa">
                    <button class="dropdown-item" type="submit">Sofa</button>
                  </form>
                </li>
                <li><a class="dropdown-item" href="#">Bookcases</a></li>
              </ul>
            </li>
            <li class="nav-item dropend">
              <a class="dropdown-item" type="button" id="dropdownMenuClickableInside" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                <div class="row g-0">
                  <div class="col">Dining Room</div>
                  <div class="col text-end"><i class="bi bi-caret-right-fill"></i></div>
                </div>
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Tables</a></li>
                <li><a class="dropdown-item" href="#">Dining Sets</a></li>
                <li><a class="dropdown-item" href="#">Dining Chairs</a></li>
              </ul>
            </li>
            <li class="nav-item dropend">
              <a class="dropdown-item" type="button" id="dropdownMenuClickableInside" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                <div class="row g-0">
                  <div class="col">Kitchen</div>
                  <div class="col text-end"><i class="bi bi-caret-right-fill"></i></div>
                </div>
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Kitchen Cabinet</a></li>
                <li><a class="dropdown-item" href="#">Kitchen Shelings</a></li>
                <li><a class="dropdown-item" href="#">Countertops</a></li>
              </ul>
            </li>
          </ul>
        </li>-->
        <li class="nav-item">
          <a href="" class="nav-link text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">E-Catalog</a>
          <ul class="dropdown-menu text-small">
            @foreach($posts as $category)
            <li>
              <form method="GET" action="{{ route('user.catalog') }}">
                @csrf
                <input type="hidden" value="{{ $category->prodCategory }}" name="category">
                <button class="dropdown-item" type="submit">{{ $category->prodCategory }}</button>
              </form>
            </li>
            @endforeach
          </ul>
        </li>
        <li class="nav-item">
          <a href="" class="nav-link d-block text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Services</a>
          <ul class="dropdown-menu text-small">
            <li>
              <a class="dropdown-item" href="{{ route('user.repair')}}">Repair</a>
            </li>
            <li>
              <a class="dropdown-item" href="{{ route('user.custom') }}">Custom</a>
            </li>
          </ul>
        </li>
        </li>
        @guest
        @if (Route::has('login'))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
          </li>
          @endif
          @if (Route::has('register'))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
          </li>
          @endif
          @endguest

        @if(Auth::check() && Auth::user()->role == 2)
        <li class="nav-item">
          <a href="" class="nav-link d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"> @if(Auth::check()) {{ Auth::user()->Fname }} @endif
          </a>
          <ul class="dropdown-menu text-small">
            <li>
              <a class="dropdown-item" href="{{ route('allUsers.profile')}}">
                {{ __('Profile') }}
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="{{ route('user.orders') }}">Orders</a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </li>
          </ul>
        </li>
        @endif

      </ul>
    </header>
  </div>
  <main>
    <div class="container">
      @yield('content')
    </div>
  </main>

  <div class="container">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
      <div class="col-md-4 d-flex align-items-center">
        <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
          <img src="{{ asset('logo/logo.png') }}" alt="Logo" width="30">
        </a>
        <span class="mb-3 mb-md-0 text-muted">© 2022 Mondale Woodworks, Inc</span>
      </div>
      <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
        <li class="ms-3">
          <a class="text-muted" href="#">
            <i class="bi bi-facebook fs-4"></i>
          </a>
        </li>
      </ul>
    </footer>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
</body>

</html>