<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <!-- <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/css/adminlte.min.css') }}">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

</head>

<body class="hold-transition" >
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('img/WLC_REGFORM_LOGO.png') }}" alt="WLCLogo" width="200">
        </div>
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav nav_hide_xs">
                <li class="nav-item burger_btn">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item search_group">
                    <div class="input-group">
                        <input id="tableSearch" class="form-control form-control" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn ">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </li>
            </ul>

            <ul class="navbar-nav d-block d-md-none">
                <li class="nav-item burger_btn">
                    <img src="{{ asset('img/WLC_REGFORM_LOGO.png') }}" alt="AdminLTE Logo" class="brand-image" style="width: 100px">
                </li>
            </ul>
            
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto d-block d-md-none">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars fa-2x"></i></a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4 sidebar-no-expand">
            <!-- Brand Logo -->
            <a href="/" class="d-flex justify-content-center" style="text-decoration: none !important">
                <img src="{{ asset('img/WLC_LOGO_MAIN.png') }}" alt="WLC Logo"
                    class="" style="width: 175px">
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                            src="{{ asset('img/defaultProfile.jpg') }}" alt="User profile picture">
                    </div>
                    <h3 class="profile-username text-center text-white">{{ auth()->user()->full_name }}</h3>
                    <p class="text-center" style="color: #c2c7d0">{{ \App\Models\User::userRoleList()[auth()->user()->role] }}</p>
                    <div class="d-flex">
                        <a href="#" class="nav-link" data-widget="control-sidebar">
                            <i class="fas fa-user"></i>
                        </a>
                        <a href="#" class="nav-link" data-widget="control-sidebar">
                            <i class="fas fa-envelope"></i>
                        </a>
                        <a href="#" class="nav-link" data-widget="control-sidebar">
                            <i class="fas fa-comment"></i>
                        </a>
                        <a href="#" class="nav-link" data-widget="control-sidebar">
                            <i class="fas fa-cog"></i>
                        </a>
                    </div>
                </div>
                <!-- Sidebar user panel (optional) -->

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        @if (\App\Models\UserPermission::isRoleHasRightToAccess(auth()->user()->role, 'dashboard'))
                            <li class="nav-item">
                                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard')? 'active': '' }}">
                                    <i class="fas fa-tachometer-alt nav-icon"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                        @endif

                        @if (\App\Models\UserPermission::isRoleHasRightToAccess(auth()->user()->role, 'transactions'))
                            <li class="nav-item">
                                <a href="{{ route('transactions') }}" class="nav-link {{ request()->routeIs('transactions')? 'active': '' }}">
                                    <i class="fas fa-exchange-alt nav-icon"></i>
                                    <p>Transactions</p>
                                </a>
                            </li>
                        @endif

                        @if (\App\Models\UserPermission::isRoleHasRightToAccess(auth()->user()->role, 'rewards'))
                            <li class="nav-item">
                                <a href="{{ route('rewards') }}" class="nav-link {{ request()->routeIs('rewards')? 'active': '' }}">
                                    <i class="fas fa-gift nav-icon"></i>
                                    <p>Rewards</p>
                                </a>
                            </li>
                        @endif

                        @if (\App\Models\UserPermission::isRoleHasRightToAccess(auth()->user()->role, 'team'))
                            <li class="nav-item">
                                <a href="{{ route('team') }}" class="nav-link {{ request()->routeIs('team')? 'active': '' }}">
                                    <i class="fas fa-users nav-icon"></i>
                                    <p>Team</p>
                                </a>
                            </li>
                        @endif

                        @if (\App\Models\UserPermission::isRoleHasRightToAccess(auth()->user()->role, 'store'))
                            <li class="nav-item">
                                <a href="{{ route('store') }}" class="nav-link {{ request()->routeIs('store')? 'active': '' }}">
                                    <i class="fas fa-store-alt nav-icon"></i>
                                    <p>Store</p>
                                </a>
                            </li>
                        @endif

                        @if (\App\Models\UserPermission::isRoleHasRightToAccess(auth()->user()->role, 'user-permissions') || \App\Models\UserPermission::isRoleHasRightToAccess(auth()->user()->role, 'roles'))
                            <li class="nav-header">Users</li>
                        @endif
                        @if (\App\Models\UserPermission::isRoleHasRightToAccess(auth()->user()->role, 'roles'))
                            <li class="nav-item">
                                <a href="{{ route('roles') }}" class="nav-link {{ request()->routeIs('roles')? 'active': '' }}">
                                    <i class="fas fa-user nav-icon"></i>
                                    <p>User Roles</p>
                                </a>
                            </li>
                        @endif

                        @if (\App\Models\UserPermission::isRoleHasRightToAccess(auth()->user()->role, 'user-permissions'))
                            <li class="nav-item">
                                <a href="{{ route('user-permissions') }}" class="nav-link {{ request()->routeIs('user-permissions')? 'active': '' }}">
                                    <i class="fas fa-user-tie nav-icon"></i>
                                    <p>User Permissions</p>
                                </a>
                            </li>
                        @endif

                        <!-- Endorsers Code -->
                        <li class="nav-item mt-3">
                            <span class="text-white">ID</span>
                            <div class="input-group">
                                <input class="form-control" id="endorsersId" type="text" readonly value="{{ auth()->user()->endorsers_id }}">
                                <button class="btn btn-sm btn-primary " id="copyBtnID">
                                    Copy
                                </button>
                            </div>
                        </li>

                        <!-- Endorsers Code -->
                        <li class="nav-item mt-3">
                            <span class="text-white">Referral URL</span>
                            <div class="input-group">
                                <input class="form-control" id="endorsersUrl" type="text" readonly value="{{ route('register').'?ref='.auth()->user()->endorsers_id }}">
                                <button class="btn btn-sm btn-primary " id="copyBtnURL">
                                    Copy
                                </button>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Main content -->
        <div class="container-fluid">
            @livewire('activate-user')
            @yield('content')
        </div>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
    <!-- AdminLTE App-->
    <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>

    @stack('modals')

    @livewireScripts

    @stack('scripts')

    <script>
        $(document).ready(function () {
            $('#copyBtnID').on('click', function(){
                $("#endorsersId").select();
                document.execCommand("copy");
            });

            $('#copyBtnURL').on('click', function(){
                $("#endorsersUrl").select();
                document.execCommand("copy");
            });

            $("#tableSearch").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#tableList tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
            
            // Toaster
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: true,
            });
            
   
            

            @if (auth()->user()->role == 'user')
                $(function(){
                    $(document).Toasts('create', {
                        class: 'bg-danger text-center',
                        title: "Become a Product Endorsers!",
                        position: 'topRight',
                        body: "<button class='btn btn-dark' onclick='activationEmit()'>Activate</button>",
                        subtitle: 'Activate now',
                        close: false,
                        delay: 2000,
                        autohide: true,
                    });
                })
            @endif
        });

        function activationEmit(){
            window.Livewire.emit('show');
        }
    </script>
</body>
</html>