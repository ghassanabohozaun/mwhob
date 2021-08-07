<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{!! trans('dashboard.panels') !!}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #0a0a0a;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 120px;
            }

            .links > a {
                color: #1f1f21;
                padding: 0 25px;
                font-size: 20px;
                font-weight: 800;
                letter-spacing: .2rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .links > a:hover {
                color: #7e848d;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    {!! trans('dashboard.mohwb') !!}
                </div>

                <div class="links">
                    <a href="{!! route('admin.login') !!}"> {!! trans('dashboard.admin_panel') !!}</a>
                    <a href="#"> {!! trans('dashboard.teacher_panel') !!}</a>
                </div>
            </div>
        </div>
    </body>
</html>
