 <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Blood Bank</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->

  <link rel="stylesheet" href=" {{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href=" {{ asset('adminlte/css/adminlte.min.css') }}">
  <link rel="stylesheet" href=" {{ asset('adminlte/css/style.css') }}">

</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ asset('index3.html') }}" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">



      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>

      <li> <div class="user-panel mt-1 pb-1 mb-1 d-flex">
        <div class="image mr-2">
          <img src="{{ asset('adminlte/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><form id="logout-form" action="{{ route('logout') }}" method="POST" class="">
            @csrf
            <button type="submit">logout</button>
        </form></a>

      </div></li>
      <li > <div class="user-panel mt-1 pb-1 mb-1 d-flex"><div class="info" ><a class="d-block" href="{{ url(route('password.request')) }}">reset password</a></div></div>  </li>

      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ asset('index3.html') }}" class="brand-link">
      <img src="{{ asset('adminlte/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Blood Bank</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('adminlte/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{auth()->user()->name}}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="{{ asset('index.html') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v1</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../{{ asset('index2.html') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v2</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../{{ asset('index3.html') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v3</p>
                </a>
              </li>
            </ul>
          </li>
          {{-- @foreach ($authorizedRoutes as $routeName => $routeLabel)
          <a href="{{ route($routeName) }}">{{ $routeLabel }}</a>
                @endforeach --}}

          <li class="nav-item">
            <a href="{{ url(route('governorate.index')) }}" class="nav-link {{ request()->is('governorate*') ? 'shining-link' : '' }}">
              <i class="fa fa-landmark nav-icon"></i>
              <p>
                Governorates

              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url(route('city.index')) }}" class="nav-link {{ request()->is('city*') ? 'shining-link' : '' }} ">
              <i class="fa fa-city nav-icon"></i>
              <p>
                Cities

              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url(route('category.index')) }}" class="nav-link {{ request()->is('category*') ? 'shining-link' : '' }}">
              <i class="fa fa-list-alt nav-icon"></i>
              <p>
                Categories

              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url(route('client.index')) }}" class="nav-link {{ request()->is('client*') ? 'shining-link' : '' }}">
              <i class="fa fa-user nav-icon"></i>
              <p>
                Clients

              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url(route('post.index')) }}" class="nav-link {{ request()->is('post*') ? 'shining-link' : '' }}">
              <i class="fa fa-list nav-icon"></i>
              <p>
                Posts

              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url(route('contact.index')) }}" class="nav-link {{ request()->is('contact*') ? 'shining-link' : '' }}">
              <i class="fa fa-envelope nav-icon"></i>
              <p>
                Contacts

              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url(route('donation.index')) }}" class="nav-link {{ request()->is('donation*') ? 'shining-link' : '' }}">
              <i class="fa fa-tint nav-icon text-danger"></i>
              <p>
                Donation Requests

              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url(route('settings.edit')) }}" class="nav-link {{ request()->is('settings*') ? 'shining-link' : '' }}">
              <i class="fa fa-cogs nav-icon  "></i>
              <p>
                Settings
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url(route('user.index')) }}" class="nav-link {{ request()->is('user*') ? 'shining-link' : '' }}">
              <i class="fa fa-user-plus nav-icon  "></i>
              <p>
                Users
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url(route('role.index')) }}" class="nav-link {{ request()->is('role*') ? 'shining-link' : '' }}">
              <i class="fa fa-users nav-icon  "></i>
              <p>
                Roles
              </p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
{{-- <script src="{{ asset('adminlte/js/demo.js') }}"></script> --}}

</body>
</html>
