<!doctype html>
<html lang="en">


<!-- Mirrored from codervent.com/rocker/demo/vertical/authentication-signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 07 Mar 2023 08:49:31 GMT -->
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{asset('assets/adminPanel')}}/images/favicon-32x32.png" type="image/png" />
    <!--plugins-->
    <link href="{{asset('assets/adminPanel')}}/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="{{asset('assets/adminPanel')}}/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="{{asset('assets/adminPanel')}}/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- loader-->
    <link href="{{asset('assets/adminPanel')}}/css/pace.min.css" rel="stylesheet" />
    <script src="{{asset('assets/adminPanel')}}/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="{{asset('assets/adminPanel')}}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('assets/adminPanel')}}/css/bootstrap-extended.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
    <link href="{{asset('assets/adminPanel')}}/css/app.css" rel="stylesheet">
    <link href="{{asset('assets/adminPanel')}}/css/icons.css" rel="stylesheet">
    <title>{{$company_info_share->name}}</title>
</head>

<body class="">
<!--wrapper-->
<div class="wrapper">
    <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
        <div class="container">
            <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                <div class="col mx-auto">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="">
                                <div class="mb-3 text-center">
{{--                                    <img src="{{asset('assets/adminPanel')}}/images/logo-icon.png" width="60" alt="" />--}}
                                </div>
                                <div class="text-center mb-3">
                                    <h5 class="">Admin</h5>
                                    <p class="mb-0">Please log in to your account</p>
                                </div>
                                <br>
                                @if(Session::get('error'))
                                <p class="mb-0 text-danger mb-3 text-center">{{Session::get('error')}}</p>
                                @endif
                                <div class="form-body mb-3">
                                    <form class="row g-3" method="post" action="{{route("admin.login")}}">
                                        @csrf
                                        <div class="col-12">
                                            <label for="inputEmailAddress" class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email" id="inputEmailAddress" placeholder="jhon@example.com" required>
                                        </div>
                                        <div class="col-12">
                                            <label for="inputChoosePassword" class="form-label">Password</label>
                                            <div class="input-group" id="show_hide_password">
                                                <input type="password" name="password" class="form-control border-end-0" id="inputChoosePassword" value="12345678" placeholder="Enter Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                                                <label class="form-check-label" for="flexSwitchCheckChecked">Remember Me</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 text-end">	<a href="authentication-forgot-password.html">Forgot Password ?</a>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary">Sign in</button>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="text-center ">
                                                <p class="mb-0">Don't have an account yet? <a href="authentication-signup.html">Sign up here</a>
                                                </p>
                                            </div>
                                        </div>
                                    </form>
                                </div>
{{--                                <div class="login-separater text-center mb-5"> <span>OR SIGN IN WITH</span>--}}
{{--                                    <hr/>--}}
{{--                                </div>--}}
{{--                                <div class="list-inline contacts-social text-center">--}}
{{--                                    <a href="javascript:;" class="list-inline-item bg-facebook text-white border-0 rounded-3"><i class="bx bxl-facebook"></i></a>--}}
{{--                                    <a href="javascript:;" class="list-inline-item bg-twitter text-white border-0 rounded-3"><i class="bx bxl-twitter"></i></a>--}}
{{--                                    <a href="javascript:;" class="list-inline-item bg-google text-white border-0 rounded-3"><i class="bx bxl-google"></i></a>--}}
{{--                                    <a href="javascript:;" class="list-inline-item bg-linkedin text-white border-0 rounded-3"><i class="bx bxl-linkedin"></i></a>--}}
{{--                                </div>--}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>
</div>
<!--end wrapper-->
<!-- Bootstrap JS -->
<script src="{{asset('assets/adminPanel')}}/js/bootstrap.bundle.min.js"></script>
<!--plugins-->
<script src="{{asset('assets/adminPanel')}}/js/jquery.min.js"></script>
<script src="{{asset('assets/adminPanel')}}/plugins/simplebar/js/simplebar.min.js"></script>
<script src="{{asset('assets/adminPanel')}}/plugins/metismenu/js/metisMenu.min.js"></script>
<script src="{{asset('assets/adminPanel')}}/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
<!--Password show & hide js -->
<script>
    $(document).ready(function () {
        $("#show_hide_password a").on('click', function (event) {
            event.preventDefault();
            if ($('#show_hide_password input').attr("type") == "text") {
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass("bx-hide");
                $('#show_hide_password i').removeClass("bx-show");
            } else if ($('#show_hide_password input').attr("type") == "password") {
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass("bx-hide");
                $('#show_hide_password i').addClass("bx-show");
            }
        });
    });
</script>
<!--app JS-->
<script src="{{asset('assets/adminPanel')}}/js/app.js"></script>
</body>


<!-- Mirrored from codervent.com/rocker/demo/vertical/authentication-signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 07 Mar 2023 08:49:31 GMT -->
</html>
