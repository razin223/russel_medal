<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>শেখ রাসেল পদক: @yield('title','মেসেজ')</title>
        <!-- plugins:css -->
        <link rel="stylesheet" href="{{asset('admin/vendors/simple-line-icons/css/simple-line-icons.css')}}">
        <link rel="stylesheet" href="{{asset('admin/vendors/flag-icon-css/css/flag-icon.min.css')}}">
        <link rel="stylesheet" href="{{asset('admin/vendors/css/vendor.bundle.base.css')}}">
        <!-- endinject -->
        <!-- Plugin css for this page -->
        <!-- End plugin css for this page -->
        <!-- inject:css -->
        <!-- endinject -->
        <!-- Layout styles -->
        <link rel="stylesheet" href="{{asset('admin/css/style.css')}}"> <!-- End layout styles -->
        <link rel="shortcut icon" href="{{asset('assets/img/russel-logo.jpeg')}}" />
    </head>
    <body>
        <div class="container-scroller">
            <div class="container-fluid page-body-wrapper full-page-wrapper">
                <div class="content-wrapper d-flex align-items-center auth">
                    <div class="row flex-grow">
                        <div class="col-lg-4 mx-auto">
                            <div class="auth-form-light text-left p-5">
                                <div class="brand-logo text-center">
                                    <a href="{{route('landing')}}">
                                        <img src="{{asset('Final Tagline-01.png')}}">
                                    </a>
                                </div>
                                <h4 class="text-center">শেখ রাসেল পদক</h4>
                                <!--<h5 class="font-weight-light text-center">{{$message}}</h5>-->
                                @csrf
                                @include("template-admin.fixed-layout.message")
                                <div class="text-center mt-4 font-weight-light"> অ‌্যাকাউন্ট আছে? <a href="<?php echo route('login') ?>" class="text-primary">সাইন ইন করুন</a></div>
                                <div class="text-center mt-4 font-weight-light">
                                    <button type="button" onclick="window.location = 'https://sheikhrussel.gov.bd'" class="btn btn-block btn-google auth-form-btn">
                                        <i class="icon-home mr-2"></i>ওয়েবসাইটে ফিরে যান </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>
        <!-- container-scroller -->
        <!-- plugins:js -->
        <script src="{{asset('admin/vendors/js/vendor.bundle.base.js')}}"></script>
        <!-- endinject -->
        <!-- Plugin js for this page -->
        <!-- End plugin js for this page -->
        <!-- inject:js -->
        <script src="{{asset('admin/js/off-canvas.js')}}"></script>
        <script src="{{asset('admin/js/misc.js')}}"></script>
        <!-- endinject -->
    </body>
</html>