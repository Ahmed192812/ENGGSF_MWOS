<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'MWOS') }}</title>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Icon -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

  <!-- Styles -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>

  <!-- Scripts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>

<body>
  <div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3">
      <a href="{{ route('user.dashboard') }}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <img src="{{ asset('logo/logo.png') }}" alt="Logo" width="35">
        <span class="fs-5 ms-2 fw-bold">Mondale Woodworks</span>
      </a>
      <ul class="nav nav-pills">
        @if(Auth::check() && Auth::user()->role == 1 || Auth::check() && Auth::user()->role == 3 )
        <li class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link text-decoration-none">Dashboard</a></li>
        <li class="nav-item"><a href="{{ route('admin.mangeOrders')}}" class="nav-link text-decoration-none">Orders</a></li>
        <li class="nav-item btn-group">
          <a class="nav-link d-block text-decoration-none dropdown-toggle" type="button" id="dropdownMenuClickableInside" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
            Product
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('admin.products')}}">Product List</a></li>
            <li><a class="dropdown-item" href="{{ route('admin.productCategory')}}">Product Category</a></li>
          </ul>
        </li>
        @else
        <li class="nav-item"><a href="{{ route('user.dashboard') }}" class="nav-link text-decoration-none">Home</a></li>
        <li class="nav-item"><a href="#" class="nav-link text-decoration-none">E-Catalog</a></li>
        <li class="nav-item btn-group">
          <a class="nav-link d-block text-decoration-none dropdown-toggle" type="button" id="dropdownMenuClickableInside" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
            Services
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Custom</a></li>
            <li><a class="dropdown-item" href="#">Repair</a></li>
          </ul>
        </li>
        @endif

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

        @else
        <li class="nav-item">
          <a href="" class="nav-link d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">{{ Auth::user()->Fname }}
          </a>
          <ul class="dropdown-menu text-small">
            <li><a class="dropdown-item" href="{{ route('allUsers.profile')}}">{{ __('Profile') }}</a></li>
            <hr class="dropdown-divider">
            <li><a class="dropdown-item" href="{{ route('admin.OrdersArchives')}}">Archives</a></li>
            <li><a class="dropdown-item" href="{{ route('admin.mangeUsers')}}">Users</a></li>
            <li><a class="dropdown-item" href="{{ route('admin.material')}}">Materials</a></li>

            @if(Auth::check() && Auth::user()->role == 2)
            <li><a class="dropdown-item" href="#">Orders</a></li>
            @endif
            <hr class="dropdown-divider">
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
        @endguest
      </ul>
    </header>
  </div>

  <!-- Content/Body -->
  <main class="container">
    @yield('content')
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

</body>

</html>