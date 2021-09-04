<div class="row shadow br-10 mb-5">
    <div class="col-lg-4 p-0">
        <img class="left-img-h-100 cover" width="100%"
             src="{!! asset('site/img/video-editing.jpg') !!}"
             alt="{!! trans('site.videos') !!}">
    </div>

    <div class="col-lg-8">
        <div class="content-item-t py-4">
            <div class="fs-18 text-bold">{!! trans('site.videos') !!}</div>
            <p class="my-2">
                {!! Lang()=='ar'?staticStrings()->videos_description_ar:staticStrings()->videos_description_en !!}
            </p>
            <div class="fs-30 text-success text-bold">{!! $videosCount !!}+
                <span class="fs-14 text-dark uk-text-normal">{!! trans('site.video_file') !!}</span>
            </div>

            @if($videos->isEmpty())

                <img src="{!! asset('site/images/noRecordFound.svg') !!}"
                     class="img-fluid" id="no_data_img"
                     title="{!! trans('site.no_date') !!}">
            @else
                <div class="row mt-4 mx-0" uk-lightbox>
                    @foreach($videos as $video)
                        <div class="col-lg-3 col-6 mb-md-0 mb-3">
                            <div class="video-with-icon">
                                <div
                                    class="uk-background-cover uk-height-medium uk-panel uk-flex uk-flex-center uk-flex-middle br-5"
                                    style="background-image: url({!! asset(Storage::url($video->video_image)) !!}); height: 120px;">
                                    <p class="uk-h4">
                                        @if($video->video_class =='uploaded_video')
                                            <a href="{!! Storage::url($video->short_upload_video_link) !!}"
                                               class="my_video_count" data-id="{{$video->id}}">
                                                <i class="fas fs-28 text-white fa-play-circle"></i>
                                            </a>
                                        @elseif($video->video_class =='youtube')
                                            <a href="https://www.youtube.com/watch?v={!!$video->short_youtube_link !!}"
                                               class="my_video_count" data-id="{{$video->id}}">
                                                <i class="fas fs-28 text-white fa-play-circle"></i>
                                            </a>
                                        @else
                                            <a href="https://vimeo.com/{!! $video->short_vimeo_link !!}"
                                               class="my_video_count" data-id="{{$video->id}}">
                                                <i class="fas fs-28 text-white fa-play-circle"></i>
                                            </a>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
        <div class=" text-right pb-3 read-more">
            <a href="{!! route('videos') !!}">
                {!! trans('site.more') !!}
                <i class="fas ml-1 fa-chevron-right"></i>
            </a>
        </div>
    </div>
</div>
@push('js')
    <script type="text/javascript">
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
    </script>
@endpush
