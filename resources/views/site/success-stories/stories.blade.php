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
            <h2 class="mb-3">{!! trans('site.talents') !!} --> {!! trans('site.success_stories_categories') !!} -->
                @if(Lang()=='ar')
                    {!! $cat !!}
                @else
                    {!! $cat !!}
                @endif
            </h2>
            <p>
                {!! Lang()=='ar'?staticStrings()->success_story_description_ar:staticStrings()->success_story_description_en !!}
            </p>
        </div>
        <div class="back-sub-header"><img src="{!! asset('site/img/Success-Stories.png') !!}" alt=""></div>
    </section>


    <section class=" content-section py-5 px-4 px-md-0" id="success_stories_section">
        <div class=" container">


            <div class="row justify-content-center">
                <div class="col-lg-11">
                    @if($stories->isEmpty())

                        <img src="{!! asset('site/images/noRecordFound.svg') !!}"
                             class="img-fluid" id="no_data_img"
                             title="{!! trans('site.no_date') !!}">
                    @else
                        <div id="success_stories_data">
                            @include('site.success-stories.stories-paging')
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
                url: '/{!! Lang() !!}/success-stories/paging/' + '{!! $cat !!}' + '?page=' + page,
                success: function (data) {
                    $('#success_stories_data').html(data);
                    $('html, body').animate({
                        scrollTop: $("#success_stories_section").offset().top
                    }, 1000);
                }
            });
        }

    </script>
@endpush
