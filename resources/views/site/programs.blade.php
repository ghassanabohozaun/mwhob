@extends('layouts.site')
@section('title') {!! trans('site.mawhob') !!} @endsection
@section('metaTags')
    <meta name="description"
          content="{!! Lang()=='ar' ? setting()->site_description_ar : setting()->site_description_en !!}">
    <meta name="keywords"
          content="{!! Lang()=='ar' ? setting()->site_keywords_ar : setting()->site_keywords_en !!}">
    <meta name="application-name" content="{!! Lang()=='ar' ? setting()->site_name_ar : setting()->site_name_en !!}"/>
    <meta name="author" content="{!! Lang()=='ar' ? setting()->site_name_ar : setting()->site_name_en !!}"/>
@endsection

@push('css')
@endpush
@section('content')

    @include('site.includes.header')


    <section class="sub-header">
        <div class=" container text-center content-header">
            <h2 class="mb-3">{!! trans('site.our_programs') !!}</h2>
            <p class="text-center">
                {!! Lang()=='ar'?staticStrings()->programs_description_ar:staticStrings()->programs_description_en !!}
            </p>
        </div>
        <div class="back-sub-header"><img src="{!! asset('site/img/Programs.jpg') !!}" alt=""></div>
    </section>

    <section class=" content-section py-5 px-4 px-md-0" id="programs_section">
        <div class=" container">
            <h2 class=" mt-4 mb-2 text-center text-bold ">{!! trans('site.incubation_programs')!!}</h2>
            <p class="mb-5 text-center">
                {!! Lang()=='ar'?staticStrings()->programs_description_ar:staticStrings()->programs_description_en !!}
            </p>

            @if($programs->isEmpty())
                <img src="{!! asset('site/images/noRecordFound.svg') !!}"
                     class="img-fluid" id="no_data_img"
                     title="{!! trans('site.no_date') !!}">
            @else
                <div id="programs_data">
                    @include('site.programs-paging')
                </div>
            @endif

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
                url: "/{!! Lang() !!}/programs/paging?page=" + page,
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
