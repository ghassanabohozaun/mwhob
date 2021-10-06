<div class="row justify-content-between align-items-center my-3">
    <div class="col-auto">
        <div class="logo-header">
            <a href="{!! route('index') !!}">
                <img src="{!! asset('site/img/logo.svg') !!}" width="120" alt="">
            </a>
        </div>
    </div>
    <div class="col-lg-4 col text-right">
        <div class="row justify-content-end">
        @if(student()->check())
            <!-- begin:user image --------------------------------------------------->
                <div class="col-auto pr-0">
                    <a href="{!! route('student.portfolio') !!}" class="img-after-login  br-5 fs-14">


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

                <div class="col-auto px-2  ">

                    <a href="#" class="bell-after-login student_notifications_count">
                        <div>
                            <span>

                                 {!! App\Models\Mawhoob_Notification::orderByDesc('id')->where('notify_for', 'mawhob')
                                 ->where('student_id', student()->id())->where('notify_class','unread')->count() !!}

                            </span>
                            <i class="fas fa-bell"></i>
                        </div>
                    </a>


                    <div class="p-2 br-5 box-noty" uk-dropdown="mode: click ; pos: top-right">

                        <span id="student_notify_section"></span>


                    </div>

                </div>

                <!-- end:user notifications --------------------------------------------------->

            @else
                <div class="col-auto pl-0">
                    <a href="{!! route('get.student.login') !!}" class="btn btn-primary px-3 br-20 fs-14">
                        {!! trans('site.login') !!}
                    </a>
                </div>
                <div class="col-auto pl-0">
                    <a href="{!! route('student.registration.policy') !!}"
                       class=" btn btn-outline-light br-20 mx-1 fs-14">
                        {!! trans('site.sign_up') !!}
                    </a>
                </div>
            @endif

            @if(setting()->lang_front_button_status == 'on')

                @if(Lang()=='ar')
                    <div class="col-auto pl-0">
                        <a href="/en" class="btn btn-outline-light br-50 fs-14 w-h">
                            {!! trans('site.en') !!}
                        </a>
                    </div>
                @else
                    <div class="col-auto pl-0">
                        <a href="/ar" class="btn btn-outline-light br-20 fs-14 w-h">
                            {!! trans('site.ar') !!}
                        </a>
                    </div>
                @endif
            @endif


        </div>
    </div>
</div>


@push('js')
    <script type="text/javascript">
        ////////////////////////////////////////////////////////////////////////////
        //Notifications
        $('#student_notify_section').load("{!! route('student.get.notifications') !!}");
        /*setInterval(
             function () {
                 $('#student_notify_section').load("{!! route('student.get.notifications') !!}");
                $(".student_notifications_count").load(location.href + " .student_notifications_count");
            }, 1000);*/
    </script>
@endpush
