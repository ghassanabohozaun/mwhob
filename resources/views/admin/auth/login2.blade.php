<!doctype html>
<html @if(Lang()=='ar') lang="ar" dir="rtl" @else lang="en" dir="ltr" @endif
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
    <link href="{!! asset('site/css/style-en.css') !!}" rel="stylesheet">
</head>
<body>


<section class="c-panel">
    <div>
        <div class="row mx-0 align-items-center">
            <div class="col-lg-6 px-0 left-background-login d-none d-lg-block">
                <div class="img-left-login ">
                    <img src="{!! asset('site/img/img-login.jpg') !!}" class=" uk-background-fixed"
                         width="100%" alt="">
                </div>
            </div>
            <div class="col-lg-6 d-flex align-items-center block-login">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="  text-center">
                            <div class="title-block-login text-bold text-warning fs-24">
                                {!! trans('login.email') !!}
                            </div>



                            @if(\Illuminate\Support\Facades\Session::has('error'))
                                <div class="alert alert-danger font-weight-bold" role="alert">
                                    {{\Illuminate\Support\Facades\Session::get('error')}}
                                </div>
                            @endif

                            <form action="{{route('admin.login')}}" method="POST">
                                @csrf
                                <div class="form-group {!! Lang()=='ar'? 'text-right':'text-left' !!} mt-4">
                                    <label for="email">
                                        {!! trans('login.email') !!}
                                    </label>
                                    <input type="email" class="form-control" id="email" name="email"
                                           autocomplete="off" placeholder="{!! trans('login.enter_email') !!}">

                                    @error('email')
                                    <span class="text-danger font-weight-bold">
                                        {{$message}}
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group {!! Lang()=='ar'? 'text-right':'text-left' !!} mt-4">
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


                                <div class="form-group {!! Lang()=='ar'? 'text-right':'text-left' !!}">
                                    <div class="contact100-form-checkbox">
                                        <label>
                                            <input type="checkbox" name="rememberMe" id="rememberMe">
                                            <span style="margin-top: 10px;color: #999999">&nbsp;
                                                {{trans('login.remember_me')}}
                                            </span>
                                        </label>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary px-5 br-20">
                                    {!! trans('login.login') !!}
                                </button>
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
<script src="{!! asset('site/js/slick.min.js') !!}"></script>
<script src="{!! asset('site/s/select2.min.js') !!}j"></script>
<script src="{!! asset('site/js/js.js') !!}"></script>
</body>
</html>

