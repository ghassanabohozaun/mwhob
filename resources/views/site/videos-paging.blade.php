<div class="row" uk-lightbox>
    @foreach($videos as $video)
        <div class="col-lg-4 col-md-6  mb-4">
            <div class="item-course">
                <div class="video-with-icon">
                    <div
                        class="uk-background-cover uk-height-medium uk-panel  uk-flex uk-flex-center uk-flex-middle br-5"
                        style="background-image: url({!! asset(Storage::url($video->video_image)) !!});
                            height: 220px;">
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

                <div class="content-item">
                    <div class="row justify-content-between align-items-center mb-3">
                        <div class=" col-auto date-item fs-14 text-bold text-dark">
                            <a href="#" class="text-dark">
                                {!! Lang()=='ar'? $video->name_ar:$video->name_en !!}
                            </a>
                        </div>
                        <div class="col-auto">
                            <span class=" fs-14 ">{!!$video->length  !!} {!! trans('site.minutes') !!}</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mt-1">
                        <div class="img-views">
                            <img src="{!! asset(Storage::url(App\Models\MawhobVideo::with('mawhob')
                                                          ->where('video_id',$video->id)->first()
                                                          ->mawhob->photo)) !!}"
                                 width="30" class="rounded-circle" alt="">
                        </div>

                        <div class="fs-12 ml-1">
                            @if(Lang()=='ar')
                                {!! App\Models\MawhobVideo::with('mawhob')
                                     ->where('video_id',$video->id)->first()
                                      ->mawhob->mawhob_full_name
                                 !!}
                            @else
                                {!! App\Models\MawhobVideo::with('mawhob')
                                     ->where('video_id',$video->id)->first()
                                      ->mawhob->mawhob_full_name_en
                                 !!}
                            @endif


                            - {!!  $video->views == null? '0': $video->views!!} {!! trans('site.view') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

</div>
<section class="content-section">
    <div class="container">
        <div class="row">
            <div class="pagination_section">
                {{$videos->links('vendor.pagination.bootstrap-4')}}
            </div>
        </div>
    </div>
</section>


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
