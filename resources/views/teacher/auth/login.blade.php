<!doctype html>
<html @if( Lang() =='ar') lang="ar" dir="rtl" @else lang="en" dir="ltr" @endif
xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>{!! Lang()=='ar' ?  setting()->site_name_ar : setting()->site_name_en !!}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no,
             initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

    <link rel="icon" type="image/jpg"
          href="{!!asset(\Illuminate\Support\Facades\Storage::url(setting()->site_icon)) !!}">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <link rel="shortcut icon" href="">
    <link rel="apple-touch-icon" sizes="180x180" href="">
    <meta name="application-name" content=""/>
    <meta name="author" content=""/>
    <link href="{!! asset('site/css/select2.min.css') !!}" rel="stylesheet">

    @if(Lang()=='ar')
        <link href="{!! asset('site/css/style-ar.css') !!}" rel="stylesheet">
    @else
        <link href="{!! asset('site/css/style-en.css') !!}" rel="stylesheet">
    @endif
    <style>
        .left-background-login {
            background-image: url({!! asset('adminBoard/images/adminLogin3.jpg') !!});
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            height: 100vh;
        }
    </style>
</head>
<body>


<section class="c-panel">
    <div>
        <div class="row mx-0 align-items-center">
            <div class="col-lg-6 px-0 left-background-login d-none d-lg-block">
                <div class="img-left-login ">

                </div>
            </div>
            <div class="col-lg-6 ">
                <div class="row ">
                    <div class="col-lg-12">
                        <div class="">
                            <div class="title-block-login text-bold text-warning fs-24 text-center">
                                <div class="mt-4">
                                    <img src="{!! asset('adminBoard/images/logo/logo.svg') !!}" style="width: 200px">
                                </div>

                                <div class="mt-4">
                                    <h2>
                                        {!! trans('login.sign_in_to_teacher') !!}
                                    </h2>
                                </div>
                            </div>


                            <form action="{!! route('teacher.login') !!}"
                                  method="POST"
                                  style=" display: table;margin: auto " class="col-lg-8">
                                @csrf


                                <div class="mt-4">
                                    @if(\Illuminate\Support\Facades\Session::has('error'))
                                        <div class="alert alert-danger font-weight-bold" role="alert">
                                            {{\Illuminate\Support\Facades\Session::get('error')}}
                                        </div>
                                    @endif
                                </div>


                                <div class="form-group  mt-4">
                                    <label for="email">
                                        {!! trans('login.email') !!}
                                    </label>
                                    <input type="email" class="form-control" id="teacher_email" name="teacher_email"
                                           autocomplete="off" placeholder="{!! trans('login.enter_email') !!}">
                                    @error('teacher_email')
                                    <span class="text-danger font-weight-bold">
                                        {{$message}}
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group mt-4">
                                    <label for="password">
                                        {!! trans('login.password') !!}
                                    </label>
                                    <input type="password" class="form-control" id="password" name="password"
                                           autocomplete="off"
                                           placeholder="{!! trans('login.enter_password') !!}">

                                    @error('password')
                                    <span class="text-danger font-weight-bold">
                                        {{$message}}
                                    </span>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <div class="contact100-form-checkbox">
                                        <label>
                                            <input type="checkbox" name="teacher_remember_token"
                                                   id="teacher_remember_token">
                                            <span style="margin-top: 10px;color: #999999">&nbsp;
                                                {{trans('login.remember_me')}}
                                            </span>
                                        </label>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary px-5 br-20">
                                        {!! trans('login.login') !!}
                                    </button>
                                </div>

                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="{!! asset('site/js/jquery.min.js') !!}"></script>

<script src="{!! asset('site/js/uikit.min.js') !!}"></script>
<script src="{!! asset('site/js/bootstrap.min.js') !!}"></script>
<script src="{!! asset('site/js/aos.js') !!}"></script>
</body>
</html>

