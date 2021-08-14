<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->
<head>
    <meta charset="utf-8"/>
    <title>{!! trans('login.sign_in') !!}</title>
    <meta name="description" content="Login page example"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
    <!--end::Fonts-->


    <!--begin::Page Custom Styles(used by this page)-->
    <link href="{!! asset('adminBoard/assets/css/pages/login/classic/login-4.css') !!}" rel="stylesheet"
          type="text/css"/>
    <!--end::Page Custom Styles-->

    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="{!! asset('adminBoard/assets/plugins/global/plugins.bundle.css') !!}" rel="stylesheet"
          type="text/css"/>
    <link href="{!! asset('adminBoard/assets/plugins/custom/prismjs/prismjs.bundle.css') !!}" rel="stylesheet"
          type="text/css"/>
    <link href="{!! asset('adminBoard/assets/css/style.bundle.css') !!}" rel="stylesheet" type="text/css"/>
    <!--end::Global Theme Styles-->

    <!--begin::Layout Themes(used by all pages)-->

    <link href="{!! asset('adminBoard/assets/css/themes/layout/header/base/light.css') !!}" rel="stylesheet"
          type="text/css"/>
    <link href="{!! asset('adminBoard/assets/css/themes/layout/header/menu/light.css') !!}" rel="stylesheet"
          type="text/css"/>
    <link href="{!! asset('adminBoard/assets/css/themes/layout/brand/dark.css') !!}" rel="stylesheet"
          type="text/css"/>
    <link href="{!! asset('adminBoard/assets/css/themes/layout/aside/dark.css') !!}" rel="stylesheet"
          type="text/css"/>        <!--end::Layout Themes-->

    <link rel="shortcut icon" href="{!! asset('adminBoard/assets/media/logos/favicon.ico') !!}"/>

    <link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet"/>
    <style>
        body, html {
            font-family: "Poppins", "ArbFONTSBEINNormalAR", sans-serif;
            font-weight: normal;
            font-style: normal;
        }
    </style>

</head>
<!--end::Head-->
@if(LaravelLocalization::getCurrentLocale() =='ar')
    <style>
        body {
            direction: rtl
        }

        .checkbox-inline .checkbox span {
            margin-right: 0.75rem;
            margin-left: 0.75rem;
        }

        .font_size_16 {
            font-size: 16px;
        }
    </style>
@endif
<!--begin::Body-->
<body id="kt_body" style="background: white ;"
      class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed subheader-mobile-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">

<!--begin::Main-->
<div class="d-flex flex-column flex-root">
    <!--begin::Login-->
    <div class="login login-4 login-signin-on d-flex flex-row-fluid" id="kt_login">
        <div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat"
             style="background-image: url('{!! asset('adminBoard/assets/media/bg/bg-3.jpg');!!}">
            <div class="login-form text-center p-7 position-relative overflow-hidden">
                <!--begin::Login Header-->
                <div class="d-flex flex-center mb-15">
                    <a href="#">
                        <img src="{!! \Illuminate\Support\Facades\Storage::url(setting()->site_logo) !!}"
                             class="max-h-75px" alt=""/>
                    </a>
                </div>
                <!--end::Login Header-->

                <!--begin::Login Sign in form-->
                <div class="login-signin">
                    <div class="mb-20">
                        <h2>{!! trans('login.sign_in_to_teacher') !!}</h2>
                    </div>
                    <form class="form"   action="{!! route('teacher.login') !!}"
                          method="POST" enctype="multipart/form-data">
                        @csrf


                        @if(\Illuminate\Support\Facades\Session::has('error'))
                            <div class="alert alert-danger font-weight-bold" role="alert">
                                {{\Illuminate\Support\Facades\Session::get('error')}}
                            </div>
                        @endif


                        <div class="form-group mb-5">
                            <input class="form-control h-auto py-4 px-8 font_size_16" type="text"
                                   placeholder="{!! trans('login.email') !!}"
                                   name="teacher_email" id="teacher_email" autocomplete="off"/>
                        </div>
                        @error('teacher_email')
                        <span class="text-danger font-weight-bold" style="font-size: 14px ;">{{$message}}</span>
                        @enderror


                        <div class="form-group mb-5">
                            <input class="form-control h-auto  py-4 px-8 font_size_16" type="password"
                                   placeholder="{!! trans('login.password') !!}"
                                   name="password" id="password" autocomplete="off"/>
                        </div>
                        @error('password')
                        <span class="text-danger font-weight-bold" style="font-size: 14px ;">{{$message}}</span>
                        @enderror


                        <div class="form-group d-flex flex-wrap justify-content-between align-items-center">
                            <div class="checkbox-inline">
                                <label class="checkbox m-0 text-muted font_size_16">
                                    <input type="checkbox" name="teacher_remember_token"
                                    id="teacher_remember_token"/>
                                    <span></span>
                                    {{trans('login.remember_me')}}
                                </label>
                            </div>
                        </div>

                        <button id="kt_login_signin_submit"
                                class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4 font_size_16">
                            {!! trans('login.sign_in') !!}
                        </button>


                    </form>
                </div>
                <!--end::Login Sign in form-->

                <!--begin::Login Sign up form-->
                <div class="login-signup">
                    <div class="mb-20">
                        <h3>Sign Up</h3>
                        <div class="text-muted font-weight-bold">Enter your details to create your account</div>
                    </div>
                    <form class="form" id="kt_login_signup_form">
                        <div class="form-group mb-5">
                            <input class="form-control h-auto form-control-solid py-4 px-8" type="text"
                                   placeholder="Fullname" name="fullname"/>
                        </div>
                        <div class="form-group mb-5">
                            <input class="form-control h-auto form-control-solid py-4 px-8" type="text"
                                   placeholder="Email" name="email" autocomplete="off"/>
                        </div>
                        <div class="form-group mb-5">
                            <input class="form-control h-auto form-control-solid py-4 px-8" type="password"
                                   placeholder="Password" name="password"/>
                        </div>
                        <div class="form-group mb-5">
                            <input class="form-control h-auto form-control-solid py-4 px-8" type="password"
                                   placeholder="Confirm Password" name="cpassword"/>
                        </div>
                        <div class="form-group mb-5 text-left">
                            <div class="checkbox-inline">
                                <label class="checkbox m-0">
                                    <input type="checkbox" name="agree"/>
                                    <span></span>
                                    I Agree the <a href="#" class="font-weight-bold ml-1">terms and conditions</a>.
                                </label>
                            </div>
                            <div class="form-text text-muted text-center"></div>
                        </div>
                        <div class="form-group d-flex flex-wrap flex-center mt-10">
                            <button id="kt_login_signup_submit"
                                    class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-2">Sign Up
                            </button>
                            <button id="kt_login_signup_cancel"
                                    class="btn btn-light-primary font-weight-bold px-9 py-4 my-3 mx-2">Cancel
                            </button>
                        </div>
                    </form>
                </div>
                <!--end::Login Sign up form-->

                <!--begin::Login forgot password form-->
                <div class="login-forgot">
                    <div class="mb-20">
                        <h3>Forgotten Password ?</h3>
                        <div class="text-muted font-weight-bold">Enter your email to reset your password</div>
                    </div>
                    <form class="form" id="kt_login_forgot_form">
                        <div class="form-group mb-10">
                            <input class="form-control form-control-solid h-auto py-4 px-8" type="text"
                                   placeholder="Email" name="email" autocomplete="off"/>
                        </div>
                        <div class="form-group d-flex flex-wrap flex-center mt-10">
                            <button id="kt_login_forgot_submit"
                                    class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-2">Request
                            </button>
                            <button id="kt_login_forgot_cancel"
                                    class="btn btn-light-primary font-weight-bold px-9 py-4 my-3 mx-2">Cancel
                            </button>
                        </div>
                    </form>
                </div>
                <!--end::Login forgot password form-->
            </div>
        </div>
    </div>
    <!--end::Login-->
</div>
<!--end::Main-->


<script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
<!--begin::Global Config(global config for global JS scripts)-->
<script>
    var KTAppSettings = {
        "breakpoints": {
            "sm": 576,
            "md": 768,
            "lg": 992,
            "xl": 1200,
            "xxl": 1400
        },
        "colors": {
            "theme": {
                "base": {
                    "white": "#ffffff",
                    "primary": "#3699FF",
                    "secondary": "#E5EAEE",
                    "success": "#1BC5BD",
                    "info": "#8950FC",
                    "warning": "#FFA800",
                    "danger": "#F64E60",
                    "light": "#E4E6EF",
                    "dark": "#181C32"
                },
                "light": {
                    "white": "#ffffff",
                    "primary": "#E1F0FF",
                    "secondary": "#EBEDF3",
                    "success": "#C9F7F5",
                    "info": "#EEE5FF",
                    "warning": "#FFF4DE",
                    "danger": "#FFE2E5",
                    "light": "#F3F6F9",
                    "dark": "#D6D6E0"
                },
                "inverse": {
                    "white": "#ffffff",
                    "primary": "#ffffff",
                    "secondary": "#3F4254",
                    "success": "#ffffff",
                    "info": "#ffffff",
                    "warning": "#ffffff",
                    "danger": "#ffffff",
                    "light": "#464E5F",
                    "dark": "#ffffff"
                }
            },
            "gray": {
                "gray-100": "#F3F6F9",
                "gray-200": "#EBEDF3",
                "gray-300": "#E4E6EF",
                "gray-400": "#D1D3E0",
                "gray-500": "#B5B5C3",
                "gray-600": "#7E8299",
                "gray-700": "#5E6278",
                "gray-800": "#3F4254",
                "gray-900": "#181C32"
            }
        },
        "font-family": "Poppins"
    };
</script>
<!--end::Global Config-->

<!--begin::Global Theme Bundle(used by all pages)-->
<script src="{!! asset('adminBoard/assets/plugins/global/plugins.bundle.js') !!}"></script>
<script src="{!! asset('adminBoard/assets/plugins/custom/prismjs/prismjs.bundle.js') !!}"></script>
<script src="{!! asset('adminBoard/assets/js/scripts.bundle.js') !!}"></script>
<!--end::Global Theme Bundle-->


<!--begin::Page Scripts(used by this page)-->
<script src="{!! asset('adminBoard/assets/js/pages/custom/login/login-general.js') !!}"></script>
<!--end::Page Scripts-->
</body>
<!--end::Body-->
</html>
