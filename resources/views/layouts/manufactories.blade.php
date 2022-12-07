@include('front.navigation')
@include('front.footer')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description"/>
    <meta content="" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico')}}" />

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- jQuery  -->
    <script src="{{ asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{ asset('assets/js/jquery-ui.min.js')}}"></script>
    <!-- App css -->
    <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/jquery-ui.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/metisMenu.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/app-rtl.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/all.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/hekal.css')}}" rel="stylesheet" type="text/css"/>
    <script src="{{ asset('assets/js/hekal.js')}}"></script>
    @yield('css')
</head>

<body data-layout="horizontal">

<!-- Top Bar Start -->
<div class="topbar">

    <div class="topbar-inner">
        <!-- LOGO -->
        <div class="topbar-left text-center text-lg-left">
            <a href="{{ url('/') }}" class="logo">
                <span>
                <img src="{{ asset('assets/images/logo-sm.png')}}" alt="logo-small" class="logo-sm">
                </span>
                <span>
                    <img src="{{ asset('assets/images/logo.png')}}" alt="logo-large" class="logo-lg logo-light">
                    <img src="{{ asset('assets/images/logo-dark.png')}}" alt="logo-large" class="logo-lg logo-dark">
                </span>
            </a>
        </div>
        <!--end logo-->
        <!-- Navbar -->
        <nav class="navbar-custom">
            <ul class="list-unstyled topbar-nav float-right mb-0">
                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown"
                       href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="ti-bell noti-icon"></i>
                        <span class="badge badge-danger badge-pill noti-icon-badge">2</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-lg pt-0">
                        @yield('notifications')
                    </div>
                </li>
                @yield('user_area')

                <li class="menu-item">
                    <!-- Mobile menu toggle-->
                    <a class="navbar-toggle nav-link" id="mobileToggle">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a><!-- End mobile menu toggle-->
                </li> <!--end menu item-->
            </ul><!--end topbar-nav-->

            <ul class="list-unstyled topbar-nav mb-0">
                <li class="hide-phone app-search">
                    <form role="search" class="">
                        <input type="text" id="AllCompo" placeholder="Search..." class="form-control">
                        <a href=""><i class="fas fa-search"></i></a>
                    </form>
                </li>
            </ul>
        </nav>
        <!-- end navbar-->
    </div><!--topbar-inner-->
</div>
<!-- Top Bar End -->

<div class="navbar-custom-menu">
    <div class="container-fluid">
        <div id="navigation">
            <!-- Navigation Menu-->
            <ul class="navigation-menu">
                @yield('navigation')
            </ul><!-- End navigation menu -->
        </div> <!-- end navigation -->
    </div> <!-- end container-fluid -->
</div> <!-- end navbar-custom -->

<div class="page-wrapper">
    <!-- Page Content-->
    <div class="page-content">

        <div class="container p-2">
            <?php /*
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="float-right">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">المندوبين</a></li>
                                <li class="breadcrumb-item"><a href="javascript:void(0);">العملاء</a></li>
                                <li class="breadcrumb-item active">لوحة التحكم</li>
                            </ol>
                        </div>
                        <h4 class="page-title">لوحة التحكم</h4>
                    </div><!--end page-title-box-->
                </div><!--end col-->
            </div>
            <!-- end page title end breadcrumb -->
            */ ?>
            <div>
                <div class="clo-12 py-4">
                    @yield('content')
                </div>
            </div>
        </div><!-- container -->

        <footer class="footer text-center text-sm-left">
            <div class="boxed-footer">
                @yield('footer_test')
            </div>
        </footer><!--end footer-->
    </div>
    <!-- end page content -->
</div>
<!-- end page-wrapper -->

</body>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('assets/js/metismenu.min.js')}}"></script>
<script src="{{ asset('assets/js/waves.js')}}"></script>
<script src="{{ asset('assets/js/feather.min.js')}}"></script>
<script src="{{ asset('assets/js/jquery.slimscroll.min.js')}}"></script>
<script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js')}}"></script>

@yield('js')
<!-- App js -->
<script src="{{ asset('assets/js/all.min.js')}}"></script>
<script src="{{ asset('assets/js/app.js')}}"></script>
</html>
