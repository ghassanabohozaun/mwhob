<div class="player-screen" id="player_screen">
    <audio id="my_audio" preload="auto" controls>
        <source src="https://www.w3schools.com/html/horse.mp3">
    </audio>
</div>


<div class="row justify-content-center">


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
                            <a href="#"
                               class="text-dark play_sound_btn my_sound_count" data-id="{{$sound->id}}">
                                {!! Lang()=='ar'?$sound->name_ar:$sound->name_en !!}
                            </a>
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
                            @if(Lang()=='ar')
                                {!! App\Models\MawhobSound::with('mawhob')
                                    ->where('sound_id',$sound->id)->first()
                                    ->mawhob->mawhob_full_name
                                 !!}
                            @else
                                {!! App\Models\MawhobSound::with('mawhob')
                                   ->where('sound_id',$sound->id)->first()
                                   ->mawhob->mawhob_full_name_en
                                !!}
                            @endif
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

    <script src="{!! asset('site/player/js/audioplayer.js') !!}"></script>

    <script type="text/javascript">
        $('audio').audioPlayer();
        ////////////////////////////////////////////////////////////////////////
        // Player
        $(document).on('click', '.play_sound_btn', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            $.get("{{route('admin.sound.view')}}", {id, id}, function (data) {
                console.log(data);
                $('.player-screen').find('source').attr("src", "{{url('/')}}/storage/" + data.data.sound_file);
                document.getElementById('my_audio').play();
            });
        });


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
