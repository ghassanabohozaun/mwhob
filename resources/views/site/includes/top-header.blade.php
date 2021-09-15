<div class="row justify-content-between align-items-center my-3">
    <div class="col-auto">
        <div class="logo-header">
            <a href="{!! route('index') !!}">
                <img src="{!! asset('site/img/logo.svg') !!}" width="120" alt="">
            </a>
        </div>
    </div>
    <div class="col-lg-4 col text-right">
    @if(student()->check())
        <!-- begin:user image --------------------------------------------------->

            <a href="{!! route('student.portfolio') !!}" class="img-after-login   px-3 br-5 fs-14">
                

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
            <!-- end:user image --------------------------------------------------->
            <!-- begin:user notifications --------------------------------------------------->

            <a href="#" class="bell-after-login br-20 mx-1 fs-14">
                <div>
                    <span>12</span>
                    <i class="fas fa-bell"></i>
                </div>
            </a>
            <!-- end:user notifications --------------------------------------------------->

        @else
            <a href="{!! route('get.student.login') !!}" class="btn btn-primary px-3 br-20 fs-14">
                {!! trans('site.login') !!}
            </a>
            <a href="{!! route('student.signup') !!}" class=" btn btn-outline-light br-20 mx-1 fs-14">
                {!! trans('site.sign_up') !!}
            </a>
        @endif


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
</div>
