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
            <h2 class="mb-3">{!! trans('site.summer_camps') !!}</h2>
            <p class="text-center">
                {!! Lang()=='ar'? staticStrings()->summer_camps_description_ar:staticStrings()->summer_camps_description_en  !!}
            </p>
        </div>
        <div class="back-sub-header">
            <img src="{!! asset('site/img/Programs.jpg') !!}"
                 alt="{!! trans('site.summer_camps') !!}">
        </div>
    </section>

    <section class=" content-section py-5 px-4 px-md-0" id="summer_camps_section">
        <div class=" container">
            <div class=" mt-4 mb-2  fs-24 ">
                {!! trans('site.latest') !!}
                <span class="text-bold text-warning">{!! trans('site.summer_camps') !!}</span>
            </div>
            <p class="mb-5 ">
                {!! Lang()=='ar'? staticStrings()->summer_camps_description_ar:staticStrings()->summer_camps_description_en  !!}
            </p>

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    @if($summerCamps->isEmpty())
                        <img src="{!! asset('site/images/noRecordFound.svg') !!}"
                             class="img-fluid" id="no_data_img"
                             title="{!! trans('site.no_date') !!}">
                    @else
                        <div id="summer_camps_data">
                            @include('site.summer-camps-paging')
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
                url: "/{!! Lang() !!}/summer-camps/paging?page=" + page,
                success: function (data) {
                    $('#summer_camps_data').html(data);
                    $('html, body').animate({
                        scrollTop: $("#summer_camps_section").offset().top
                    }, 1000);
                }
            });
        }

    </script>
@endpush
