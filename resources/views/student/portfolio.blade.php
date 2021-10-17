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

    <section class="py-3 min_height_480">
        <div class=" container">
            <div class="row">


                @include('student.includes.sidebar')


                <div class=" col-lg-9">
                    <div class=" with-screen-titel row justify-content-between
                                align-items-center p-2 br-10 bg-light mx-0 mb-3 mt-3 mt-md-0">
                        <div class="col-auto title-with-icon d-flex align-items-center px-1">
                            <span class="mr-2">
                                <img src="{!! asset('site/img/suitcase.svg') !!}"
                                     width="25" alt="">
                            </span>
                            <span
                                class="fs-14 text-bold">{!!  trans('site.portfolio') !!}
                            </span>
                        </div>
                        <div class="col-auto px-md-0">
                            <a href="#" class=" btn btn-info px-4 br-10 fs-14">{!! trans('site.add_work') !!}</a>
                        </div>
                    </div>


                    @if($mawhobVideos->isEmpty() && $mawhobSounds->isEmpty())
                        <img src="{!! asset('site/images/noRecordFound.svg') !!}"
                             class="img-fluid" id="no_data_img"
                             title="{!! trans('site.no_date') !!}">
                    @else


                    <!-- begin : videos --------------------------------------------------------------->
                        <h3 class="my_text_decoration">
                            {!! trans('site.my_videos') !!}
                        </h3>
                        @if($mawhobVideos->isEmpty())
                            <img src="{!! asset('site/images/noRecordFound.svg') !!}"
                                 class="img-fluid" id="no_data_img"
                                 title="{!! trans('site.no_date') !!}">
                        @else
                            <div class="row" uk-lightbox>

                                @foreach($mawhobVideos as $mawhobVideo)
                                    <div class="col-lg-4 col-md-6  mb-4">
                                        <div class="item-course">
                                            <div class="video-with-icon">
                                                <div
                                                    class="uk-background-cover uk-height-medium uk-panel uk-flex uk-flex-center uk-flex-middle br-5"
                                                    style="background-image: url({!! asset(Storage::url($mawhobVideo->video->video_image)) !!});
                                                        height: 220px;">
                                                    <p class="uk-h4">
                                                        @if($mawhobVideo->video->video_class =='uploaded_video')
                                                            <a href="{!! Storage::url($mawhobVideo->video->short_upload_video_link) !!}"
                                                               class="my_video_count"
                                                               data-id="{{$mawhobVideo->video->id}}">
                                                                <i class="fas fs-28 text-white fa-play-circle"></i>
                                                            </a>
                                                        @elseif($mawhobVideo->video->video_class =='youtube')
                                                            <a href="https://www.youtube.com/watch?v={!!$mawhobVideo->video->short_youtube_link !!}"
                                                               class="my_video_count"
                                                               data-id="{{$mawhobVideo->video->id}}">
                                                                <i class="fas fs-28 text-white fa-play-circle"></i>
                                                            </a>
                                                        @else
                                                            <a href="https://vimeo.com/{!! $mawhobVideo->video->short_vimeo_link !!}"
                                                               class="my_video_count"
                                                               data-id="{{$mawhobVideo->video->id}}">
                                                                <i class="fas fs-28 text-white fa-play-circle"></i>
                                                            </a>
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="content-item">
                                                <div class="row justify-content-between align-items-center mb-3">
                                                    <div class=" col-auto date-item fs-14 text-bold text-dark">
                                                        <a href="#" class="text-dark">
                                                            {!! Lang()=='ar'? $mawhobVideo->video->name_ar:$mawhobVideo->video->name_en !!}
                                                        </a>
                                                    </div>
                                                    <div class="col-auto">
                                                    <span class=" fs-14 ">
                                                     {!!$mawhobVideo->video->length  !!} {!! trans('site.minutes') !!}
                                                    </span>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center mt-1">
                                                    <div class="fs-12 ml-1">
                                                        {!!  $mawhobVideo->video->views == null? '0': $mawhobVideo->video->views!!}
                                                        {!! trans('site.view') !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        @endif
                    <!-- end : videos --------------------------------------------------------------->


                        <!-- begin : videos --------------------------------------------------------------->
                        <h3 class="my_text_decoration">
                            {!! trans('site.my_sounds') !!}
                        </h3>
                        @if($mawhobSounds->isEmpty())

                            <img src="{!! asset('site/images/noRecordFound.svg') !!}"
                                 class="img-fluid" id="no_data_img"
                                 title="{!! trans('site.no_date') !!}">
                        @else
                            <div class="row">

                                @foreach($mawhobSounds as $mawhobSound)
                                    <div class="col-lg-4 col-md-6  mb-4">
                                        <div class="item-course">
                                            <div class="video-with-icon">
                                                <div
                                                    class="uk-background-cover uk-height-medium uk-panel uk-flex uk-flex-center uk-flex-middle br-5"
                                                    style="background-image: url({!! asset(Storage::url($mawhobSound->sound->sound_image)) !!});
                                                        height: 220px;">
                                                    <p>
                                                        <a href="{!! Storage::url($mawhobSound->sound->sound_file) !!}"
                                                           target="_blank"
                                                           data-id="{{$mawhobSound->sound->id}}">
                                                            <i class="fas fs-28 text-white fa-download"></i>
                                                        </a>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="content-item">
                                                <div class="row justify-content-between align-items-center mb-3">
                                                    <div class=" col-auto date-item fs-14 text-bold text-dark">
                                                        <a href="javascript:void(0)" class="text-dark">
                                                            {!! Lang()=='ar'? $mawhobSound->sound->name_ar:$mawhobSound->sound->name_en !!}
                                                        </a>
                                                    </div>
                                                    <div class="col-auto">
                                                    <span class=" fs-14 ">
                                                     {!!$mawhobSound->sound->length  !!} {!! trans('site.minutes') !!}
                                                    </span>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center mt-1">
                                                    <div class="fs-12 ml-1">
                                                        {!!  $mawhobSound->sound->views == null? '0': $mawhobSound->sound->views!!}
                                                        {!! trans('site.view') !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        @endif
                    <!-- end : videos --------------------------------------------------------------->


                    @endif
                </div>

            </div>
        </div>
    </section>

@endsection

@push('js')
    <script type="text/javascript">

        /////////////////////////////////////////////////////////////
        // sound count
        $('body').on('click', '.my_video_count', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                url: '{!! route('video.views') !!}',
                data: {id, id},
                type: 'post',
                dataType: 'json',
                success: function (data) {
                    console.log();
                }
            })

        });


        /////////////////////////////////////////////////////////////
        // sound count
        $('body').on('click', '.my_sound_count', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                url: '{!! route('sound.views') !!}',
                data: {id, id},
                type: 'post',
                dataType: 'json',
                success: function (data) {
                    console.log();
                }
            })

        })

    </script>
@endpush


