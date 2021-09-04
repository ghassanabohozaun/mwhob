<div class="slider">
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
        <div class="carousel-inner">

            @foreach($sliders as $key=>$slider)
                <div class="carousel-item {!!$key == 0 ? 'active' : '' !!}">
                    <img uk-scrollspy="cls: uk-animation-kenburns; repeat: true"
                         src="{!! asset(Storage::url($slider->photo)) !!}"
                         class="d-block w-100" alt="{!! $slider->title_{Lang()} !!}">
                    <div class="carousel-caption d-none d-md-block">
                        <div class=" container">
                            <div class=" row align-items-center">
                                <div class="col">

                                    @if($slider->details_status == trans('sliders.show'))
                                        <h2 class="text-bold">{!! Lang()=='ar'?$slider->title_ar:$slider->title_en !!}</h2>

                                        <p class="my-3 text-white">
                                            {!! Lang()=='ar'?$slider->details_ar:$slider->details_en !!}
                                        </p>
                                    @endif

                                    @if($slider->button_status == trans('sliders.show'))
                                        <div>
                                            <a href="{!! route('programs') !!}"
                                               class="btn btn-primary br-20 px-3 fs-14 mr-2">
                                                {!! trans('site.i_want_to_get_practice') !!}
                                            </a>
                                            @if(student()->check())
                                                <a href="{!! route('student.portfolio') !!}"
                                                   class="btn btn-outline-light br-20 px-3 fs-14">
                                                    {!! trans('site.need_to_show_my_talent') !!}
                                                </a>
                                            @else
                                                <a href="{!! route('get.student.login') !!}"
                                                   class="btn btn-outline-light br-20 px-3 fs-14">
                                                    {!! trans('site.need_to_show_my_talent') !!}
                                                </a>
                                            @endif

                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

