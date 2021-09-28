@extends('layouts.student')
@section('title') {!! trans('site.mawhob') !!} @endsection
@section('metaTags')
    <meta name="description"
          content="{!! Lang()=='ar' ? setting()->site_description_ar : setting()->site_description_en !!}">
    <meta name="keywords"
          content="{!! Lang()=='ar' ? setting()->site_keywords_ar : setting()->site_keywords_en !!}">
    <meta name="application-name" content="{!! Lang()=='ar' ? setting()->site_name_ar : setting()->site_name_en !!}"/>
    <meta name="author" content="{!! Lang()=='ar' ? setting()->site_name_ar : setting()->site_name_en !!}"/>
@endsection

@section('content')

    <section class="py-3">
        <div class=" container">
            <div class="row">
                <div class="col-lg-12">
                    <section>
                        <div class=" container py-4">
                            <div class="course-dt">
                                <div class="cor-img">
                                    <img src="{!! asset(Storage::url($course->course_image)) !!}"
                                         alt="">
                                </div>
                                <div class="row  py-3 mt-4">
                                    <div class="col-md-10">
                                        <div class="text-bold">
                                            {!! Lang()=='ar'?$course->title_ar:$course->title_en !!}
                                        </div>
                                    </div>

                                    <div class="col-auto d-flex align-items-center">
                                        @if($course->discount!=null)
                                            <span class="net-price mr-2">{!! $course->discount !!}$</span>
                                            <span class="old-price">{!! $course->cost !!}$</span>
                                        @else
                                            <span class="my_price">{!! $course->cost !!}$</span>
                                        @endif
                                    </div>

                                </div>
                                <div class="row align-items-center my-4 mx-0 bg-light br-5 p-2">
                                    <div class="col-lg-3 border-right">
                                        <div class="img-text d-flex align-items-center">
                                            <div class="img mr-2">

                                                @if($course->teacher->teacher_photo == null)
                                                    @if($course->teacher->teacher_gender == trans('general.male'))
                                                        <img src="{{asset('adminBoard/images/male.jpeg')}}" alt="">
                                                    @else
                                                        <img src="{{asset('adminBoard/images/female.jpeg')}}" alt="">
                                                    @endif
                                                @else
                                                    <img src="{{asset(Storage::url($course->teacher->teacher_photo))}}"
                                                         alt="">
                                                @endif
                                            </div>
                                            <div class="title">
                                                @if(Lang()=='ar')
                                                    {!! $course->teacher->teacher_full_name !!}
                                                @else
                                                    {!! $course->teacher->teacher_full_name_en !!}
                                                @endif
                                            </div>
                                        </div>

                                    </div>

                                    @if($lecture)
                                        <div class="col-lg-6 my-2 my-md-0">
                                        <span>
                                            <img src="{!! asset('site/img/calendar.svg') !!}" width="30"
                                                 alt=""></span>
                                            <span>
                                            {!! trans('site.next_lecture') !!} :
                                            {!! $lecture->lecture_date !!}
                                            -
                                            {!! trans('general.from') !!}
                                            ({!! $lecture->lecture_from !!})
                                            {!! trans('general.to') !!}
                                            ({!! $lecture->lecture_to !!})
                                        </span>

                                        </div>
                                        <div class="col-lg-3">
                                            <span id="refresh_lecture_date">
                                                  @if($lecture->status == 'on')
                                                    <a href="{!! $course->zoom_link !!}" target="_blank"
                                                       class="btn btn-primary w-100 py-2 br-5">
                                                    {!! trans('site.go_to_lecture') !!}
                                                </a>
                                                @else
                                                    <a href="javascript:void(0)"
                                                       class="btn btn-primary w-100 py-2 br-5">
                                                    {!! trans('site.lecture_link_no_active') !!}
                                                </a>
                                                @endif
                                            </span>

                                        </div>
                                    @else
                                        <div class="offset-5 col-lg-4" style="color: #a71d2a;font-weight: bolder">
                                            {!! trans('site.no_lecture_dates_available') !!}
                                        </div>
                                    @endif
                                </div>


                                <div>
                                    <div class="fs-18 mt-3 text-bold mb-2">{!! trans('site.course_details') !!}</div>
                                    <div class="fs-14 mb-4">
                                        {!! Lang()=='ar'?$course->description_ar:$course->description_en !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>


@endsection

@push('js')

    <script type="text/javascript">


    </script>

@endpush
