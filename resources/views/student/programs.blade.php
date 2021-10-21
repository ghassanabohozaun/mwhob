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


                <div class=" col-lg-9" id="programs_sections">
                    <div
                        class=" with-screen-titel row justify-content-between align-items-center p-2 br-10 bg-light mx-0 mb-3 mt-3 mt-md-0">
                        <div class="col-auto title-with-icon d-flex align-items-center px-1">
                            <span class="mr-2">
                                 <img src="{!! asset('site/img/icons8-sandbox-24.png') !!}" width="20">
                            </span>
                            <span class="fs-14 text-bold">
                                {!! trans('site.programs') !!}
                            </span>
                        </div>

                    </div>
                    @if($mawhobEnrollPrograms->isEmpty())
                        <img src="{!! asset('site/images/noRecordFound.svg') !!}"
                             class="img-fluid" id="no_data_img"
                             title="{!! trans('site.no_date') !!}">
                    @else
                        <div id="programs_data">
                            @include('student.programs-paging')
                        </div>
                    @endif

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
                url: "student/programs/paging?page=" + page,
                success: function (data) {
                    $('#programs_data').html(data);
                    $('html, body').animate({
                        scrollTop: $("#programs_section").offset().top
                    }, 1000);
                }
            });
        }

    </script>
@endpush
