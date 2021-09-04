<div class="row" uk-lightbox>
    @foreach($sounds as $sound)
        <div class="col-lg-4 col-md-6  mb-4">
            <div class="item-course">
                <div class="img-course">
                    <img src="{!! asset(Storage::url($sound->sound_image)) !!}"
                         alt="">
                </div>
                <div class="content-item">
                    <div class="row justify-content-between align-items-center mb-3">
                        <div class=" col-auto date-item fs-14 text-bold text-dark ">
                            @if($sound->sound_class =='uploaded_sound')
                                <a href="{!! Storage::url($sound->short_upload_sound_link) !!}"
                                   class="text-dark my_sound_count" data-id="{{$sound->id}}">
                                    {!! Lang()=='ar'?$sound->name_ar:$sound->name_en !!}
                                </a>
                            @elseif($sound->sound_class =='youtube')
                                <a href="https://www.youtube.com/watch?v={!!$sound->short_youtube_link !!}"
                                   class="text-dark my_sound_count" data-id="{{$sound->id}}">
                                    {!! Lang()=='ar'?$sound->name_ar:$sound->name_en !!}
                                </a>
                            @else
                                <a href="https://vimeo.com/{!! $sound->short_vimeo_link !!}"
                                   class="text-dark my_sound_count" data-id="{{$sound->id}}">
                                    {!! Lang()=='ar'?$sound->name_ar:$sound->name_en !!}
                                </a>
                            @endif
                        </div>

                        <div class="col-auto">
                            <span class=" fs-14 ">{!! $sound->length !!} {!! trans('site.minutes') !!}</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mt-1">
                        <div class="img-views">
                            <img src="{!! asset(Storage::url(App\Models\MawhobSound::with('mawhob')
                                                               ->where('sound_id',$sound->id)->first()
                                                               ->mawhob->photo))
                                                               !!}"
                                 alt=""
                                 width="30" class="rounded-circle">
                        </div>
                        <div class="fs-12 ml-1">
                            {!! App\Models\MawhobSound::with('mawhob')
                                ->where('sound_id',$sound->id)->first()
                                ->mawhob->mawhob_full_name
                             !!}
                            - {!!  $sound->views == null? '0': $sound->views!!} {!! trans('site.view') !!}
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
                {{$sounds->links('vendor.pagination.bootstrap-4')}}
            </div>
        </div>
    </div>
</section>



@push('js')
    <script type="text/javascript">


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
