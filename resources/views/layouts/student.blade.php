<!doctype html>
<html @if( Lang() =='ar') lang="ar" dir="rtl" @else lang="en" dir="ltr" @endif
xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>{{ !empty($title) ? $title: trans('site.mawhob') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('metaTags')
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link rel="icon" type="image/jpg" href="{!! asset(Storage::url(setting()->site_icon)) !!}">
    <link rel="shortcut icon" href="{!! asset(Storage::url(setting()->site_icon)) !!}">
    <link rel="apple-touch-icon" sizes="180x180" href="{!! asset(Storage::url(setting()->site_icon)) !!}">
    <meta name="application-name" content=""/>
    <meta name="author" content=""/>

    <link href="{!! asset('site/css/select2.min.css') !!}" rel="stylesheet">
    @if(Lang()=='ar')
        <link href="{!! asset('site/css/style-ar.css') !!}" rel="stylesheet">
    @else
        <link href="{!! asset('site/css/style-en.css') !!}" rel="stylesheet">
    @endif
    <link href="{!! asset('site/css/my-style.css') !!}" rel="stylesheet">
    <link href="{!! asset('site/css/pagination.css') !!}" rel="stylesheet">
    @stack('css')
</head>
<body>


@include('site.includes.orange-header')

@yield('content')

@include('student.includes.footer')

<script src="{!! asset('site/js/jquery.min.js') !!}"></script>
<script src="{!! asset('site/js/uikit.min.js') !!}"></script>
<script src="{!! asset('site/js/bootstrap.min.js') !!}"></script>
<script src="{!! asset('site/js/aos.js') !!}"></script>
<script src="{!! asset('site/js/slick.min.js') !!}"></script>
<script src="{!! asset('site/js/select2.min.js') !!}"></script>
<script src="{!! asset('site/js/js.js') !!}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="{!! asset('site/css/my-sweet-alert-style.css') !!}" rel="stylesheet">


<!-- Firebase files -->
<!-- Insert these scripts at the bottom of the HTML, but before you use any Firebase services -->

<!-- Firebase App (the core Firebase SDK) is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/8.2.5/firebase-app.js"></script>

<!-- If you enabled Analytics in your project, add the Firebase SDK for Analytics -->
<script src="https://www.gstatic.com/firebasejs/8.2.5/firebase-analytics.js"></script>

<!-- Add Firebase products that you want to use -->
<script src="https://www.gstatic.com/firebasejs/8.2.5/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.2.5/firebase-firestore.js"></script>

<script type="text/javascript" src="{{ asset('otp/js/firebase-conf.js') }}"></script>
<script type="text/javascript" src="{{ asset('otp/js/phone.js') }}"></script>


@stack('js')
<script>
    AOS.init();
    $(document).ready(function () {
        $(".multiselect").select2();
        refreshLectureDate();
        function refreshLectureDate() {
            setInterval(function() {
                $( "#refresh_lecture_date" ).load(window.location.href + " #refresh_lecture_date" );
            }, 1000);  //Delay here = 5 seconds
        }
    });
</script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>

    var bar = document.getElementById('js-progressbar');

    UIkit.upload('.js-upload', {

        url: '/img',
        multiple: true,

        beforeSend: function () {
            console.log('beforeSend', arguments);
        },
        beforeAll: function () {
            console.log('beforeAll', arguments);
        },
        load: function () {
            console.log('load', arguments);
        },
        error: function () {
            console.log('error', arguments);
        },
        complete: function () {
            console.log('complete', arguments);
        },

        loadStart: function (e) {
            console.log('loadStart', arguments);

            bar.removeAttribute('hidden');
            bar.max = e.total;
            bar.value = e.loaded;
        },

        progress: function (e) {
            console.log('progress', arguments);

            bar.max = e.total;
            bar.value = e.loaded;
        },

        loadEnd: function (e) {
            console.log('loadEnd', arguments);

            bar.max = e.total;
            bar.value = e.loaded;
        },

        completeAll: function () {
            console.log('completeAll', arguments);

            setTimeout(function () {
                bar.setAttribute('hidden', 'hidden');
            }, 1000);

            alert('Upload Completed');
        }

    });

</script>
</body>
</html>
