<header class="  pb-4 pt-1 custom-header">
    <div class=" container">
        <div class="row justify-content-between align-items-center my-3">
            <div class="col-auto">
                <div class="logo-header">
                    <a href="{!! route('index') !!}">
                        <img src="{!! asset('site/img/logo-white.svg') !!}"
                             width="120" alt="">
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col text-right">
                <div class="row justify-content-end">

                @if(student()->check())

                    <!-- begin:user image --------------------------------------------------->
                        <div class="col-auto pr-0">
                            <a href="{!! route('student.portfolio') !!}" class="img-after-login">

                                @if(student()->user()->photo == null)
                                    @if(student()->user()->mowhob_gender ==  trans('general.male'))
                                        <img src="{{asset('adminBoard/images/male.jpeg')}}" alt="">
                                    @else
                                        <img src="{{asset('adminBoard/images/female.jpeg')}}" alt="">

                                    @endif
                                @else
                                    <img src="{!! asset(Storage::url(student()->user()->photo)) !!}" alt="">
                                @endif
                            </a>
                        </div>
                        <!-- end:user image --------------------------------------------------->
                        <!-- begin:user notifications --------------------------------------------------->
                        <div class="col-auto px-2">

                            <a href="#" class="bell-after-login orange_student_notifications_count">
                                <div>
                            <span class="">
                                {!! App\Models\Mawhoob_Notification::orderByDesc('id')->where('notify_for', 'mawhob')
                                 ->where('student_id', student()->id())->where('notify_class','unread')->count() !!}
                            </span>
                                    <i class="fas fa-bell"></i>
                                </div>
                            </a>
                            <div class="p-2 br-5 box-noty" uk-dropdown="mode: click ; pos: top-right">

                                <span id="orange_student_notify_section"></span>


                            </div>

                        </div>
                        <!-- end:user notifications --------------------------------------------------->

                @else
                    <!-- begin:login --------------------------------------------------->
                        <div class="col-auto pr-0">
                            <a href="{!! route('get.student.login') !!}" class="btn btn-light px-3 br-20 fs-14">
                                {!! trans('site.login') !!}
                            </a>
                        </div>
                        <!-- end:login --------------------------------------------------->

                        <!-- begin:signup --------------------------------------------------->
                        <div class="col-auto px-2">
                            <a href="{!! route('student.registration.policy') !!}"
                               class=" btn btn-outline-light br-20 mx-1 fs-14">
                                {!! trans('site.sign_up') !!}
                            </a>
                        </div>
                        <!-- end:signup --------------------------------------------------->

                @endif

                <!-- begin:language --------------------------------------------------->
                    @if(setting()->lang_front_button_status == 'on')
                        <div class="col-auto pl-0">

                            @if(Lang()=='ar')
                                <a href="/en" class="btn btn-outline-light br-50 fs-14 w-h">
                                    {!! trans('site.en') !!}
                                </a>
                            @else
                                <a href="/ar" class="btn btn-outline-light br-20 fs-14 w-h">
                                    {!! trans('site.ar') !!}
                                </a>
                            @endif

                        </div>
                @endif
                <!-- begin:language --------------------------------------------------->

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
    </div>
</header>
@push('js')
    <script type="text/javascript">
        ////////////////////////////////////////////////////////////////////////////
        //Notifications
        $('#orange_student_notify_section').load("{!! route('student.get.notifications') !!}");
        $(".orange_student_notifications_count").load(location.href + " .orange_student_notifications_count");

        setInterval(
            function () {
                $('#orange_student_notify_section').load("{!! route('student.get.notifications') !!}");
                $(".orange_student_notifications_count").load(location.href + " .orange_student_notifications_count");
            }, 1000);
        ///50000
    </script>
@endpush
