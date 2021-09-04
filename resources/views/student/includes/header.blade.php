<header class="  pb-4 pt-1 custom-header">
    <div class=" container">
        <div class="row justify-content-between align-items-center my-3">
            <div class="col-auto">
                <div class="logo-header">
                    <a href="#"><img src="{!! asset('site/img/logo-white.svg') !!}" width="120" alt=""></a>
                </div>
            </div>
            <div class="col-lg-4 col text-right">
                <div class="row justify-content-end">
                    <div class="col-auto pr-0">
                        <a href="#" class="btn btn-primary px-3 br-20 fs-14">{!! trans('site.login') !!}</a>
                    </div>
                    <div class="col-auto px-2">

                        <a href="#" class=" btn btn-outline-light br-20 mx-1 fs-14">{!! trans('site.sign_up') !!}</a>

                    </div>
                    <div class="col-auto pl-0">
                        <a href="#" class="btn btn-outline-light br-50 fs-14 w-h">{!! trans('site.en') !!}</a>
                    </div>
                </div>

            </div>
        </div>
        <nav class="navbar navbar-expand-lg border border-right-0 border-left-0 py-0">

            <button class="navbar-toggler  w-100" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                <i class="fas fa-bars text-white"></i>
            </button>

            <div class="collapse navbar-collapse w-100" id="navbarSupportedContent">
                <ul class="navbar-nav  d-flex align-items-center justify-content-between w-100">
                    <li class="nav-item  col active">
                        <a class="nav-link" href="{!! route('index') !!}">
                            {!! trans('site.home') !!}
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>

                    <li class="nav-item col">
                        <a class="nav-link" href="{!! route('talents') !!}">
                            {!! trans('site.talents') !!}
                        </a>
                    </li>

                    <li class="nav-item col">
                        <a class="nav-link" href="{!! route('programs') !!}">
                            {!! trans('site.programs') !!}
                        </a>
                    </li>

                    <li class="nav-item col">
                        <a class="nav-link" href="{!! route('courses') !!}">
                            {!! trans('site.courses') !!}
                        </a>
                    </li>

                    <li class="nav-item col">
                        <a class="nav-link" href="#">
                            {!! trans('site.activities') !!}
                        </a>
                    </li>

                    <li class="nav-item col">
                        <a class="nav-link" href="#">
                            {!! trans('site.contact') !!}
                        </a>
                    </li>
                </ul>

            </div>
        </nav>
    </div>
</header>
