<section class=" content-section py-5 px-4 px-md-0">
    <div class=" container">
        <div class=" mt-4 mb-2  fs-24  ">{!! trans('site.latest') !!}
            <span class="text-bold text-warning">{!! trans('site.courses') !!}</span></div>
        <p class="mb-5 ">
            {!! Lang()=='ar'?staticStrings()->courses_description_ar:staticStrings()->courses_description_en !!}
        </p>

        <div class="row justify-content-center">
            <div class="col-lg-12">

                @if($latestCourses->isEmpty())
                    <img src="{!! asset('site/images/noRecordFound.svg') !!}"
                         class="img-fluid" id="no_data_img" title="{!! trans('site.no_date') !!}">
                @else
                    <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slider>
                        <ul class="uk-slider-items uk-child-width-1-2 uk-child-width-1-3@m uk-grid d-flex  justify-content-center">

                            @foreach($latestCourses as $latestCourse)
                                <li>
                                    <div class="item-course">
                                        <div class="img-course">
                                            <img src="{!! asset(Storage::url($latestCourse->course_image)) !!}"
                                                 alt="{!! Lang()=='ar'?$latestCourse->title_ar:$latestCourse->title_en !!}">
                                        </div>
                                        <div class="content-item">
                                            <div class="row justify-content-between align-items-center">
                                                <div class=" col-auto date-item fs-12">
                                                    {!! Lang()=='ar'?$latestCourse->category->name_ar:$latestCourse->category->name_en !!}
                                                </div>
                                                <div class="col-auto">
                                                    <span class=" btn bg-warning-light py-1 br-20 text-warning">
                                                        {!! $latestCourse->hours !!}  {!! trans('site.hours') !!}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="fs-16 text-bold my-2 text-dark">
                                                {!! Lang()=='ar'?$latestCourse->title_ar:$latestCourse->title_en !!}
                                            </div>
                                            <p class="mb-3 fs-12">
                                                {!! Lang()=='ar'?$latestCourse->description_ar:$latestCourse->description_en !!}
                                            </p>

                                            <div class="row mt-4 mb-4 mx-0 bg-light text-dark p-2 br-5">
                                                <div class="col-lg-6 px-1">
                                                    <div class="fs-12">
                                                        <span>{!! trans('site.start_at') !!}</span>
                                                        <span dir="{!! Lang()=='ar'?'rtl':'ltr' !!}"> {!! $latestCourse->start_at !!} </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 px-1">
                                                    <div class="fs-12">
                                                        <span>{!! trans('site.end_at') !!}</span>
                                                        <span dir="{!! Lang()=='ar'?'rtl':'ltr' !!}"> {!! $latestCourse->end_at !!} </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row justify-content-between align-items-center">
                                                <div class="col-auto">


                                                        @if(student()->check())
                                                            @if( App\Models\MawhobEnrollCourse::where('course_id', $latestCourse->id)
                                                        ->where('mawhob_id', student()->id())->get()->count() >0)
                                                                <a  href="javascript:void(0)"  class="btn btn-primary br-30 text-bold">
                                                                    {!! trans('site.previously_registered') !!}
                                                                </a>
                                                            @else
                                                                <a href="#" class="btn btn-primary br-30 text-bold
                                                                       auth_student_course_enroll_button"
                                                                   data-id="{!! $latestCourse->id !!}">
                                                                    {!! trans('site.enroll_now') !!}
                                                                </a>
                                                            @endif
                                                        @else
                                                            <a href="#" class="btn btn-primary br-30 text-bold
                                                                  not_auth_student_course_enroll_button">
                                                                {!! trans('site.enroll_now') !!}
                                                            </a>
                                                        @endif

                                                </div>
                                                <div class="col-auto d-flex align-items-center">
                                                    @if($latestCourse->discount!=null)
                                                        <span
                                                            class="net-price mr-2">{!! $latestCourse->discount !!}$</span>
                                                        <span class="old-price">{!! $latestCourse->cost !!}$</span>
                                                    @else
                                                        <span class="my_price">{!! $latestCourse->cost !!}$</span>
                                                    @endif
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach

                        </ul>
                        <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#"
                           uk-slidenav-previous uk-slider-item="previous">
                        </a>
                        <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next
                           uk-slider-item="next">
                        </a>
                    </div>
                @endif

            </div>
        </div>
    </div>


</section>
