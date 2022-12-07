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
    <!-- App css -->
    <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/app-rtl.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/css/hekal.css')}}" rel="stylesheet" type="text/css" />
    <!-- jQuery  -->
    <script src="{{ asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{ asset('assets/js/hekal.js')}}"></script>
    <style>
        #navigation a {
            padding: 10px 2px 0 2px !important;
            box-sizing: border-box;

        }
        body{
            padding: 80px 0 0 0 !important;
        }
    </style>
</head>

<body>
<div class="container bg-success">

<div class="navbar-custom-menu m-0 p-0" >
    <div class="container-fluid">
        <div id="navigation">
            <!-- Navigation Menu-->
            <ul class="navigation-menu" style="padding: 0 !important; margin: 0 auto !important;">
                @yield('navigation')
            </ul><!-- End navigation menu -->
        </div> <!-- end navigation -->
    </div> <!-- end container-fluid -->
</div> <!-- end navbar-custom -->

<div class="page-wrapper">
    <!-- Page Content-->
    <div class="page-content bg-warning center align-items-center justify-content-center">
        <div class="container-fluid pt-2" style="margin: 0 auto !important; width: 100%;">
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
<!-- App js -->
<script src="{{ asset('assets/js/app.js')}}" ></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js')}}"></script>
</html>
