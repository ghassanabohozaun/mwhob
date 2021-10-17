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
            <h2 class="mb-3">
                {!! trans('site.talents') !!}
                @if(Lang()=='ar') / @else \ @endif
                {!! trans('site.success_stories_categories') !!}
                @if(Lang()=='ar') / @else \ @endif
                {!! trans('site.story') !!}
            </h2>

            <p class="text-center">
                {!! Lang()=='ar'?staticStrings()->success_story_person_description_ar:staticStrings()->success_story_person_description_en !!}
            </p>
        </div>
        <div class="back-sub-header">
            <img src="{!! asset('site/img/Success-Stories-Category.jpg') !!}" alt="">
        </div>
    </section>




    <section class=" content-category">
        <div class=" container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-4">
                    <div class="img-left">
                        <img src="{!! asset(Storage::url($story->story_image)) !!}" width="100%" alt="">
                    </div>
                </div>
                <div class="col-lg-6 p-5">
                    <div class="fs-14 text-warning text-bold">{!! trans('site.iam_almowhob') !!}</div>
                    <h2 class="my-4 text-bold">
                        @if(Lang()=='ar')
                            {!! $story->mawhob->mawhob_full_name !!}
                        @else
                            {!! $story->mawhob->mawhob_full_name_en !!}
                        @endif
                    </h2>
                    <p>
                        @if(Lang() == 'ar')
                            {!! \Illuminate\Support\Str::limit(strip_tags($story->about_mawhob_ar),$limit = 250, $end = '...')!!}
                        @else
                            {!! \Illuminate\Support\Str::limit(strip_tags($story->about_mawhob_en ),$limit = 250, $end = '...')!!}
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </section>





    <section class="our-Category3 d-lg-flex align-items-center justify-content-center">
        <div class=" container">
            <div class="row align-items-center justify-content-around">
                <!-- begin:right ---------------------------------------------->
                <div class="col-lg-6">
                    <div class=" text-bold fs-24 mb-3 text-white">
                        {!! trans('site.about_an_mawhoob') !!}
                    </div>
                    <p class=" text-white">
                        {!! Lang()=='ar'?$story->about_mawhob_ar:$story->about_mawhob_en !!}
                    </p>
                </div>
                <!-- end:right ---------------------------------------------->
                <!-- begin:left ---------------------------------------------->
                <div class="col-lg-5">
                    <div class="card p-4 br-5 story_experience">
                        <div class="fs-18 text-bold">{!! trans('site.experiences') !!}</div>

                        @if(App\Models\MawhobExperience::where('story_id',$story->id)->get()->isEmpty())
                            <img src="{!! asset('site/images/noRecordFound.svg') !!}"
                                 class="img-fluid" id="no_data_img"
                                 title="{!! trans('site.no_date') !!}">
                        @else
                            @foreach(App\Models\MawhobExperience::orderBy('experience_percentage','desc')->where('story_id',$story->id)->get() as $experience )

                                <div class=" mb-3">
                                    <p class=" text-right mb-1 fs-12 text-dark">
                                        {!! Lang()=='ar'?$experience->experience_name_ar:$experience->experience_name_en !!}
                                        {!! $experience->experience_percentage !!}%
                                    </p>
                                    <div class="progress">
                                        <div class="progress-bar bg-warning" role="progressbar"
                                             style="width:{!! $experience->experience_percentage !!}%"
                                             aria-valuenow="{!! $experience->experience_percentage !!}"
                                             aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            @endforeach
                        @endif


                    </div>
                </div>
                <!-- end:left ---------------------------------------------->
            </div>
        </div>
    </section>




    <section class="Portfolio py-5 ">
        <div class=" container">
            <h2 class=" text-center mb-3 text-bold">{!! trans('site.portfolio') !!}</h2>
            <p class=" text-center mb-3"></p>


            @if($mawhobSounds->isEmpty() && $mawhobSounds->isEmpty())
                <img src="{!! asset('site/images/noRecordFound.svg') !!}"
                     class="img-fluid" id="no_data_img"
                     title="{!! trans('site.no_date') !!}">
            @else

            <!--begin:videos ----------------------------------------------->
                <h3 class="my_text_decoration">{!! trans('site.videos') !!}</h3>
                @if($mawhobVideos->isEmpty())
                    <img src="{!! asset('site/images/noRecordFound.svg') !!}"
                         class="img-fluid" id="no_data_img"
                         title="{!! trans('site.no_date') !!}">
                @else
                    <div class="row mt-4 pt-4" uk-lightbox>
                        @foreach($mawhobVideos as $mawhobVideo)
                            <div class="col-lg-4 col-md-6  mb-4">
                                <div class="item-course">
                                    <div class="video-with-icon">
                                        <div
                                            class="uk-background-cover uk-height-medium uk-panel uk-flex uk-flex-center uk-flex-middle br-5"
                                            style="background-image: url({!! asset(Storage::url($mawhobVideo->video->video_image)) !!}); height: 220px;">
                                            <p class="uk-h4">
                                                @if($mawhobVideo->video->video_class =='uploaded_video')
                                                    <a href="{!! Storage::url($mawhobVideo->video->short_upload_video_link) !!}"
                                                       class="my_video_count" data-id="{{$mawhobVideo->video->id}}">
                                                        <i class="fas fs-28 text-white fa-play-circle"></i>
                                                    </a>
                                                @elseif($mawhobVideo->video->video_class =='youtube')
                                                    <a href="https://www.youtube.com/watch?v={!!$mawhobVideo->video->short_youtube_link !!}"
                                                       class="my_video_count" data-id="{{$mawhobVideo->video->id}}">
                                                        <i class="fas fs-28 text-white fa-play-circle"></i>
                                                    </a>
                                                @else
                                                    <a href="https://vimeo.com/{!! $mawhobVideo->video->short_vimeo_link !!}"
                                                       class="my_video_count" data-id="{{$mawhobVideo->video->id}}">
                                                        <i class="fas fs-28 text-white fa-play-circle"></i>
                                                    </a>
                                                @endif

                                            </p>
                                        </div>
                                    </div>
                                    <div class="content-item">
                                        <div class="row justify-content-between align-items-center mb-3">
                                            <div class=" col-auto date-item fs-16 text-bold text-dark">
                                                {!! Lang()=='ar'?$mawhobVideo->video->name_ar:$mawhobVideo->video->name_en !!}
                                            </div>
                                            <div class="col-auto">
                                            <span class=" fs-14 ">
                                                {!! $mawhobVideo->video->length !!} {!! trans('site.minutes') !!}
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
            <!--end:videos ----------------------------------------------->

                <!--begin:sounds ----------------------------------------------->

                <h3 class="my_text_decoration">{!! trans('site.sounds') !!}</h3>
                @if($mawhobSounds->isEmpty())

                    <img src="{!! asset('site/images/noRecordFound.svg') !!}"
                         class="img-fluid" id="no_data_img"
                         title="{!! trans('site.no_date') !!}">
                @else
                    <div class="row mt-4 pt-4">
                        @foreach($mawhobSounds as $mawhobSound)
                            <div class="col-lg-4 col-md-6  mb-4">
                                <div class="item-course">
                                    <div class="sound-with-icon">
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
                                            <div class=" col-auto date-item fs-16 text-bold text-dark">
                                                {!! Lang()=='ar'?$mawhobSound->sound->name_ar:$mawhobSound->sound->name_en !!}
                                            </div>
                                            <div class="col-auto">
                                            <span class=" fs-14 ">
                                                {!! $mawhobSound->sound->length !!} {!! trans('site.minutes') !!}
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
                    <!--end:sounds ----------------------------------------------->

                @endif
            @endif

        </div>
    </section>
@endsection

@push('js')
    <script type="text/javascript">
        /////////////////////////////////////////////////////////////////
        // video count
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

        })

        /////////////////////////////////////////////////////////////////
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
