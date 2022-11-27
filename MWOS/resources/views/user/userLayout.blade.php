<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <!-- Meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Title -->
  <title>{{ config('app.name', 'MWOS') }}</title>

  <!-- Styles -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

  <!-- Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>

<body class="bg-light">

  <!-- Navbar -->
  <div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3">
      <a href="{{ route('user.dashboard') }}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <img src="{{ asset('logo/logo.png') }}" alt="Logo" width="35">
        <span class="fs-5 ms-2 fw-bold">Mondale Woodworks</span>
      </a>
      <ul class="nav nav-pills">
        <li class="nav-item"><a href="{{ route('user.dashboard') }}" class="nav-link text-decoration-none">Home</a></li>
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

  <!-- Content/Body -->
  <main>
    <div class="container">
      @yield('content')
    </div>
  </main>

  <!-- Footer -->
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

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
  <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
  <script>
    $(function() {
      $("[data-toggle=popover]").popover({
        html: true,
        placement: "bottom",
        content: function() {
          var content = $(this).attr("data-popover-content");
          return $(content).children(".popover-body").html();
        },
        title: function() {
          var title = $(this).attr("data-popover-content");
          return $(title).children(".popover-heading").html();
        }
      });
    });
  </script>

</body>

</html>