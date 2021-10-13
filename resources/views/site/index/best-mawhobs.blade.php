<section class="best-mwhobs mb-5 py-5">
    <div class=" container">
        <div class="text-center mb-5 ">
            <h2 class=" text-bold mb-3" data-aos="fade-up" data-aos-duration="1000">
                {!! trans('site.best_mawhoobs') !!}
            </h2>
            <p data-aos="fade-up" data-aos-duration="1500">
                {!! Lang()=='ar'?indexPage()->best_mawhobs_description_ar:indexPage()->best_mawhobs_description_en  !!}
            </p>
        </div>

        @if($bestMawhoobs->isEmpty())
            <img src="{!! asset('site/images/noRecordFound.svg') !!}"
                 class="img-fluid" id="no_data_img"
                 title="{!! trans('site.no_date') !!}">
        @else
            <div class="uk-slider-container-offset" uk-slider="autoplay: true ; autoplay-interval:3000">
                <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1">

                    <ul class="uk-slider-items uk-child-width-1@s uk-child-width-1-3@m
                          uk-child-width-1-5@l uk-grid best-mwhobs-list d-flex  justify-content-center">


                        @foreach($bestMawhoobs as $bestMawhoob)
                            <li>
                                <div class="">
                                    <div class="uk-card-media-top">
                                        <img
                                            src="{!! asset(Storage::url($bestMawhoob->mawhob->photo)) !!}"
                                            alt="">
                                    </div>
                                    <div class="uk-card-body p-3 text-center">
                                        <div class="uk-card-title fs-18 mb-0 text-dark">
                                            @if(Lang()=='ar')
                                                {!! $bestMawhoob->mawhob->mawhob_full_name !!}
                                            @else
                                                {!! $bestMawhoob->mawhob->mawhob_full_name_en !!}
                                            @endif
                                        </div>
                                        <div>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach

                    </ul>


                </div>
            </div>
        @endif
    </div>
</section>
