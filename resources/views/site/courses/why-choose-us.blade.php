<section class="  mt-3">
    <div class="row align-items-center mx-0">
        <div class="col-lg-6 px-0">
            <img src="{!! asset('site/img/img-courses.jpg') !!}" width="100%" alt="">
        </div>
        <div class="col-lg-6">
            <div class="right-courses p-4">
                <div class="fs-18 text-bold">{!! trans('site.why_you_should') !!}</div>
                <div class="fs-35 text-warning text-bold mb-4">{!! trans('site.choose_us') !!}</div>
                <p>{!! Lang()=='ar'?whyChooseUs()->why_choose_us_ar:whyChooseUs()->why_choose_us_en !!}</p>
                <ul class=" list-check my-4 mx-5">
                    <li>{!! Lang()=='ar'?whyChooseUs()->reason_1:whyChooseUs()->reason_en_1 !!}</li>
                    <li>{!! Lang()=='ar'?whyChooseUs()->reason_2:whyChooseUs()->reason_en_2 !!}</li>
                    <li>{!! Lang()=='ar'?whyChooseUs()->reason_3:whyChooseUs()->reason_en_3 !!}</li>
                    <li>{!! Lang()=='ar'?whyChooseUs()->reason_4:whyChooseUs()->reason_en_4 !!}</li>
                    <li>{!! Lang()=='ar'?whyChooseUs()->reason_5:whyChooseUs()->reason_en_5 !!}</li>
                    <li>{!! Lang()=='ar'?whyChooseUs()->reason_6:whyChooseUs()->reason_en_6 !!}</li>
                    <li>{!! Lang()=='ar'?whyChooseUs()->reason_7:whyChooseUs()->reason_en_7 !!}</li>
                </ul>
            </div>
        </div>
    </div>
</section>
