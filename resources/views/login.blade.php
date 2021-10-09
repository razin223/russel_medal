<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>শেখ রাসেল কুইজ: @yield('title','সাইন ইন')</title>
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
        <link rel="stylesheet" href="{{asset('admin/css/style.css')}}"/> <!-- End layout styles -->
        <link rel="shortcut icon" href="{{asset('assets/img/russel-logo.jepg')}}" />
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
                                        <img src="{{asset('assets/img/russel-logo.jpeg')}}">
                                    </a>
                                </div>
                                <h4 class="text-center">শেখ রাসেল কুইজ</h4>
                                <h6 class="font-weight-light text-center">সাইন ইন করুন</h6>
                                @include('new-admin.fixed-layout.message')
                                <form class="pt-3" method="POST" action="<?php echo route('login') ?>">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="ইমেইল">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="পাসওয়ার্ড">
                                    </div>

                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" name="remember" value="1" class="form-check-input"> লগইন থাকুন </label>
                                    </div>
                                    <div class="mt-3">
                                        <input type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" value="সাইন ইন" style="background-color: #1B783C; border-radius: 10px"/>
                                    </div>
                                    <div class="my-2 d-flex justify-content-between align-items-center">

                                        <a href="{{route('forget_password')}}" class="auth-link text-black">পাসওয়ার্ড ভুলে গেছেন?</a>



                                        <a href="{{route('email_verify_resend')}}" class="auth-link text-black">পুনরায় ভেরিফিকেশন ইমেইল পাঠান</a>
                                    </div>
                                    <div class="text-center mt-4 font-weight-light"> অ‌্যাকাউন্ট নেই? সাইন আপ করুন &rarr; <a href="{{route('ka_group_registration')}}" class="text-primary"> গ্রুপ ক</a> <a href="{{route('kha_group_registration')}}" class="text-primary"> গ্রুপ খ</a>
                                    </div>
                                    <div class="text-center mt-4 font-weight-light">
                                        <button type="button" onclick="window.location = 'https://sheikhrussel.gov.bd'" class="btn btn-block btn-warning auth-form-btn" style="background-color: #916226; border-radius: 10px">
                                            <i class="icon-home mr-2"></i>ওয়েবসাইটে ফিরে যান </button>
                                    </div>
                                    <!--                                    <div class="mb-2">
                                                                            <br/>
                                                                            <button type="button" onclick="window.location = '#/auth/google'" class="btn btn-block btn-google auth-form-btn">
                                                                                <i class="icon-social-google mr-2"></i>গুগল দিয়ে সাইন ইন করুন </button>
                                    
                                                                            <button type="button" onclick="window.location = '#/auth/facebook'" class="btn btn-block btn-facebook auth-form-btn">
                                                                                <i class="icon-social-facebook mr-2"></i>Lফেসবুক দিয়ে সাইন ইন করুন </button>
                                                                        </div>-->

                                </form>
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
        <script src="{{asset('admin/js/jquery.js')}}"></script>
        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#captcha").click(function () {
                                                    $.ajax({
                                                        url: "/captcha_img",
                                                        data: {},
                                                        success: function (data) {
                                                            console.log(data);
                                                            $("#captcha_img").attr("src", data.src);
                                                        },
                                                        error: function (error) {
                                                            alert(error.responseText);
                                                        }
                                                    });
                                                });
                                            });
        </script>
        <!-- endinject -->

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-QES6F5P7GW"></script>
        <script>
                                                    window.dataLayer = window.dataLayer || [];
                                                    function gtag() {
                                                        dataLayer.push(arguments);
                                                    }
                                                    gtag('js', new Date());

                                                    gtag('config', 'G-QES6F5P7GW');
        </script>
    </body>
</html>