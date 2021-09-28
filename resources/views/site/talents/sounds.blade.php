<div class="row shadow br-10 mb-5">
    <div class="col-lg-4 p-0">
        <img class="left-img-h-100 cover" width="100%"
             src="{!! asset('site/img/img-item.jpg') !!}"
             alt="{!! trans('site.sound_track') !!}">
    </div>

    <div class="col-lg-8">
        <div class="content-item-t py-4">
            <div class="fs-18  text-bold">{!! trans('site.sound_track') !!}</div>
            <p class="my-2">
                {!! Lang()=='ar'?staticStrings()->soundtrack_description_ar:staticStrings()->soundtrack_description_en !!}
            </p>
            <div class="fs-30 text-warning text-bold">
                {!! $soundsCount !!}+
                <span class="fs-14 text-dark uk-text-normal">{!! trans('site.audio_file') !!}</span>
            </div>

            @if($sounds->isEmpty())

                <img src="{!! asset('site/images/noRecordFound.svg') !!}"
                     class="img-fluid" id="no_data_img"
                     title="{!! trans('site.no_date') !!}">
            @else
                <div class="row mt-4 mx-0">
                    @foreach($sounds as $sound)
                        <div class="col-md-6 mb-3">
                            <div class="row item-itunes p-2 br-5">
                                <div class="col-2 px-0 py-2 text-center">
                                    <img src="{!! asset('site/img/itunes.svg') !!}" width="80%"
                                         alt="{!! Lang()=='ar'?$sound->name_ar:$sound->name_en !!}">
                                </div>
                                <div class="col-7 px-2">
                                    <div class="title-itunes fs-16 text-bold">
                                        {!! Lang()=='ar'?$sound->name_ar:$sound->name_en !!}
                                    </div>
                                    <div class="d-flex align-items-center mt-1">
                                        <div class="img-views">
                                            <img src="{!! asset(Storage::url(App\Models\MawhobSound::with('mawhob')
                                               ->where('sound_id',$sound->id)->first()
                                                ->mawhob->photo)) !!}" class="rounded-circle"
                                                 alt="{!! Lang()=='ar'?$sound->name_ar:$sound->name_en !!}">
                                        </div>
                                        <div class="fs-12 ml-1">

                                            @if(Lang()=='ar')
                                                {!! App\Models\MawhobSound::with('mawhob')
                                                   ->where('sound_id',$sound->id)->first()
                                                    ->mawhob->mawhob_full_name!!}
                                            @else
                                                {!! App\Models\MawhobSound::with('mawhob')
                                                  ->where('sound_id',$sound->id)->first()
                                                   ->mawhob->mawhob_full_name_en!!}
                                            @endif

                                            -
                                            {!! $sound->views == null?'0': $sound->views  !!}
                                            {!! trans('site.view') !!}
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="col-3 fs-16 text-center">{!! $sound->length !!} {!! trans('site.minutes') !!}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
        <div class=" text-right pb-3 read-more">
            <a href="{!! route('sounds') !!}">
                {!! trans('site.more') !!}
                <i class="fas ml-1 fa-chevron-right"></i>
            </a>
        </div>
    </div>
</div>
