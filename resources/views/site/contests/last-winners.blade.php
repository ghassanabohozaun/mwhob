<section class=" content-section py-5 px-4 px-md-0">
    <div class=" container">
        <div class=" mt-4 mb-2  fs-24  ">{!! trans('site.latest') !!}
            <span class="text-bold text-warning">{!! trans('site.winners') !!}</span>
        </div>
        <p class="mb-5 ">

            {!! Lang()=='ar'?staticStrings()->latest_winners_description_ar:staticStrings()->latest_winners_description_en !!}
        </p>

        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slider>

                    @if($mawhob_winners->isEmpty())
                        <img src="{!! asset('site/images/noRecordFound.svg') !!}"
                             class="img-fluid" id="no_data_img"
                             title="{!! trans('site.no_date') !!}">
                    @else
                        <ul class="uk-slider-items uk-child-width-1-2 uk-child-width-1-4@m uk-grid">
                            @foreach($mawhob_winners as $mawhob_winner)
                                <li>
                                    <div
                                        class="uk-background-cover bg-dark-opcity uk-height-medium uk-panel uk-flex uk-flex-bottom uk-flex-middle br-10"
                                        style="background-image: url({!! asset(Storage::url($mawhob_winner->mawhob->photo)) !!});
                                            height: 400px;">
                                        <div class="uk-position-top-right p-3 ">
                                            <img src="{!! asset('site/img/n1.svg') !!}" width="30"
                                                 alt="{!! trans('site.winners') !!}">
                                        </div>
                                        <div class=" p-3 text-white">
                                            <div class="uk-h4 text-white mb-1  text-bold text-warning">
                                                @if(Lang()=='ar')
                                                    {!! $mawhob_winner->mawhob->mawhob_full_name !!}
                                                @else
                                                    {!! $mawhob_winner->mawhob->mawhob_full_name_en !!}
                                                @endif
                                            </div>
                                            <p class=" text-white">
                                                {!! Lang()=='ar'? $mawhob_winner->mawhob_winner_description_ar:$mawhob_winner->mawhob_winner_description_en !!}
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>


                        <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#"
                           uk-slidenav-previous uk-slider-item="previous"></a>
                        <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next
                           uk-slider-item="next"></a>
                    @endif


                </div>

            </div>
        </div>
    </div>


</section>
