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


                @include('student.includes.sidebar')

                <div class=" col-lg-9" id="courses_section">
                    <div class=" with-screen-titel row justify-content-between align-items-center
                                  p-2 br-10 bg-light mx-0 mb-3 mt-3 mt-md-0">
                        <div class="col-auto title-with-icon d-flex align-items-center px-1">
                            <span class="mr-2">
                                <img src="{!! asset('site/img/Courses.svg') !!}" width="25" alt="">
                            </span>
                            <span class="fs-14 text-bold">{!! trans('site.courses') !!}</span>
                        </div>

                    </div>

                    @if($studentCourses->isEmpty())
                        <h1 class="py-4  fs-30 justify-content-center">
                            <img src="{!! asset('site/images/noRecordFound.svg') !!}"
                                 class="img-fluid" id="no_data_img" title="{!! trans('site.no_date') !!}">
                        </h1>
                    @else

                        <div id="courses_data">
                            @include('student.courses-paging')
                        </div>
                    @endif

                </div>
            </div>
        </div>

    </section>

@endsection
@push('js')
    <script type="text/javascript">

        $(document).on('click', '.pagination a', function (event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetch_data(page);
        });

        function fetch_data(page) {
            $.ajax({
                url: "student/courses/paging?page=" + page,
                success: function (data) {
                    $('#courses_data').html(data);
                    $('html, body').animate({
                        scrollTop: $("#courses_section").offset().top
                    }, 1000);
                }
            });
        }

    </script>
@endpush
