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
            <h2>
                {!! trans('site.talents') !!}
                @if(Lang()=='ar') / @else \ @endif
                {!! trans('site.success_stories_categories') !!}
            </h2>
            <p>
                {!! Lang()=='ar'?staticStrings()->success_story_categories_description_ar:staticStrings()->success_story_categories_description_en !!}
            </p>
        </div>
        <div class="back-sub-header">
            <img src="{!! asset('site/img/Success-Stories2.jpg') !!}" alt="">
        </div>
    </section>


    <section class=" content-section py-5 px-4 px-md-0" id="success_stories_categories_section">
        <div class=" container">
            @if($storyCategories->isEmpty())
                <img src="{!! asset('site/images/noRecordFound.svg') !!}"
                     class="img-fluid" id="no_data_img"
                     title="{!! trans('site.no_date') !!}">
            @else
                <div id="success_stories_categories_data">
                    @include('site.success-stories.categories-paging')
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
                url: "/{!! Lang() !!}/success-stories-categories/paging?page=" + page,
                success: function (data) {
                    $('#success_stories_categories_data').html(data);
                    $('html, body').animate({
                        scrollTop: $("#success_stories_categories_section").offset().top
                    }, 1000);
                }
            });
        }

    </script>
@endpush
