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


            <li class="nav-item col dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                   role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {!! trans('site.activities') !!}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{!! route('contests') !!}">
                        {!! trans('site.contests') !!}
                    </a>
                    <a class="dropdown-item" href="{!! route('summer.camps') !!}">
                        {!! trans('site.summer_camps') !!}
                    </a>
                    <a class="dropdown-item" href="{!! route('magazine') !!}">
                        {!! trans('site.mawhoob_magazine') !!}
                    </a>
                </div>
            </li>

            <li class="nav-item col">
                <a class="nav-link" href="{!! route('index') !!}#contactUs">
                    {!! trans('site.contact') !!}
                </a>
            </li>
        </ul>

    </div>
</nav>
