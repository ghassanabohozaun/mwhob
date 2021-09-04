<section class="best-app ">
    <div class=" container">
        <div class="row justify-content-around align-items-center">
            <div class="col-lg-6">
                <div data-aos="fade-right" data-aos-duration="1200">
                    <img src="{!! asset('site/img/logo.svg') !!}" width="140"
                         alt=" {!! trans('site.mawhoob_the_best_app_to_show_your_talents') !!}">
                </div>
                <div data-aos="fade-left" data-aos-duration="1200" class="text-white fs-30 my-3 text-bold">
                    {!! trans('site.mawhoob_the_best_app_to_show_your_talents') !!}
                </div>
                <div>

                    <a href="{!! route('programs') !!}" data-aos="fade-up" data-aos-duration="1200"
                       class="btn btn-primary br-20 px-3 fs-14 mr-2">
                        {!! trans('site.i_want_to_get_practice') !!}
                    </a>
                    @if(student()->check())
                        <a href="{!! route('student.portfolio')!!}" data-aos="fade-up" data-aos-duration="1500"
                           class="btn btn-outline-light br-20 px-3 fs-14">
                            {!! trans('site.need_to_show_my_talent') !!}
                        </a>
                    @else
                        <a href="{!! route('get.student.login')!!}" data-aos="fade-up" data-aos-duration="1500"
                           class="btn btn-outline-light br-20 px-3 fs-14">
                            {!! trans('site.need_to_show_my_talent') !!}
                        </a>
                    @endif

                </div>
            </div>
            <div class="col-lg-5  d-none d-lg-block">
                <div class="img-right">
                    <img data-aos="fade-right" data-aos-duration="1500" src="{!! asset('site/img/woman.png') !!}"
                         alt="{!! trans('site.mawhoob_the_best_app_to_show_your_talents') !!}">
                </div>
            </div>
        </div>
    </div>
</section>
