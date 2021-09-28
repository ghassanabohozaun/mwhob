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

                <div class="col-auto px-2">

                    <a href="#" class="bell-after-login">
                        <div>
                            <span>
                                {!! App\Models\Mawhoob_Notification::orderByDesc('id')->where('notify_for', 'mawhob')
                                 ->where('student_id', student()->id())->where('notify_class','unread')->count() !!}
                            </span>
                            <i class="fas fa-bell"></i>
                        </div>
                    </a>
                    <div class="p-2 br-5 box-noty" uk-dropdown="mode: click ; pos: top-right">

                        @if(App\Models\Mawhoob_Notification::orderByDesc('id')->where('notify_for', 'mawhob')
                                 ->where('student_id', student()->id())->count() == 0)
                            <div class="item-noty  p-2 br-5">
                                <a href="#">
                                    <div class="text-bold text-primary">{!! trans('site.no_notifications') !!}</div>
                                </a>
                            </div>
                        @else
                            @foreach(App\Models\Mawhoob_Notification::orderByDesc('id')->where('notify_for', 'mawhob')
                                ->where('student_id', student()->id())->take(5)->get() as $notifcation)
                                <div class="item-noty  p-2 br-5 text-right">
                                    <a href="#">
                                        <div class="text-bold text-primary">
                                            {!! Lang()=='ar'?$notifcation->title_ar:$notifcation->title_en !!}
                                        </div>
                                        <div class="fs-12 text-dark">
                                            {!! Lang()=='ar'?$notifcation->details_ar:$notifcation->details_en !!}
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @endif



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
                    <a href="{!! route('student.signup') !!}" class=" btn btn-outline-light br-20 mx-1 fs-14">
                        {!! trans('site.sign_up') !!}
                    </a>
                </div>
            @endif


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


        </div>
    </div>
</div>
