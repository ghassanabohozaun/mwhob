<footer>
    <section class="section-footer ">
        <div class=" container">
            <div class="row">

                <div class=" col-lg-4">
                    <div class="logo-footer  mt-4 mt-md-0">
                        <img data-aos="fade-down" data-aos-duration="1000" src="{!! asset('site/img/logo.svg') !!}"
                             width="170" alt="">
                    </div>
                    <p data-aos="fade-down" data-aos-duration="700" class="text-white my-3">
                        {!! Lang()=='ar'?indexPage()->mawhobs_description_ar:indexPage()->mawhobs_description_en !!}
                    </p>
                    <ul class="list-social-media" data-aos="fade-down" data-aos-duration="300">
                        <li>
                            <a href="{!! setting()->site_facebook !!}" target="_blank">
                                <img src="{!! asset('site/img/facebook.svg') !!}" alt="{!! trans('site.facebook') !!}">
                            </a>
                        </li>
                        <li>
                            <a href="{!! setting()->site_instagram !!}" target="_blank">
                                <img src="{!! asset('site/img/insta.svg') !!}" alt="{!! trans('site.instagram') !!}">
                            </a>
                        </li>
                        <li>
                            <a href="{!! setting()->site_twitter !!}" target="_blank">
                                <img src="{!! asset('site/img/twitter.svg') !!}" alt="{!! trans('site.twitter') !!}">
                            </a>
                        </li>
                        <li>
                            <a href="{!! setting()->site_youtube !!}" target="_blank">
                                <img src="{!! asset('site/img/youtube.svg') !!}" alt="{!! trans('site.youtube') !!}">
                            </a>
                        </li>
                    </ul>
                </div>


                <div class=" col-lg-4" data-aos="fade-in" data-aos-duration="1200">
                    <h3 class=" text-primary text-bold mb-3  mt-4 mt-md-0">{!! trans('site.related_links') !!}</h3>
                    <div class="row footer-links">

                        <div class="col-md-4 mb-1 pb-1">
                            <a class=" text-white fs-14" href="{!! route('index') !!}">
                                {!! trans('site.mawhoob') !!}
                            </a>
                        </div>


                        <div class="col-md-6  mb-1 pb-1">
                            <a class=" text-white fs-14" href="{!! route('about.mawhoob') !!}">
                                {!! trans('site.about_mawhoob') !!}
                            </a>
                        </div>
                        <div class="col-md-4  mb-1 pb-1">
                            <a class=" text-white fs-14" href="{!! route('programs') !!}">
                                {!! trans('site.programs') !!}
                            </a>
                        </div>
                        <div class="col-md-6  mb-1 pb-1">
                            <a class=" text-white fs-14" href="{!! route('contests') !!}">
                                {!! trans('site.contests') !!}
                            </a>
                        </div>
                        <div class="col-md-4  mb-1 pb-1">
                            <a class=" text-white fs-14" href="{!! route('courses') !!}">
                                {!! trans('site.courses') !!}
                            </a>
                        </div>
                        <div class="col-md-6  mb-1 pb-1">
                            <a class=" text-white fs-14" href="{!! route('summer.camps') !!}">
                                {!! trans('site.summer_camps') !!}
                            </a>
                        </div>
                        <div class="col-md-4  mb-1 pb-1">
                            <a class=" text-white fs-14" href="{!! route('talents') !!}">
                                {!! trans('site.talents') !!}
                            </a>
                        </div>
                        <div class="col-md-6  mb-1 pb-1">
                            <a class=" text-white fs-14" href="{!! route('magazine') !!}">
                                {!! trans('site.mawhoob_magazine') !!}
                            </a>
                        </div>
                        <div class="col-md-4  mb-1 pb-1">
                            <a class=" text-white fs-14" href="{!! route('index')!!}#contact">
                                {!! trans('site.contact') !!}
                            </a>
                        </div>
                        <div class="col-md-6  mb-1 pb-1">
                            <a class=" text-white fs-14" href="{!! route('success.stories.categories') !!}">
                                {!! trans('site.success_stories') !!}
                            </a>
                        </div>
                        <div class="col-md-4  mb-1 pb-1">
                            <a class=" text-white fs-14" href="{!! route('sounds') !!}">
                                {!! trans('site.sounds') !!}
                            </a>
                        </div>

                        <div class="col-md-6 mb-1 pb-1">
                            <a class=" text-white fs-14" href="{!! route('videos') !!}">
                                {!! trans('site.videos') !!}
                            </a>
                        </div>
                    </div>
                </div>


                <!-- Begin: Media --------------------------------------------------------------------------->
                <div class=" col-lg-4">
                    <h3 class=" text-primary text-bold mb-3 mt-4 mt-md-0">{!! trans('site.media') !!}</h3>
                    <div class="media-footer">
                        <div class="row" uk-lightbox>
                            @if(footerImages()->isEmpty())
                                <img src="{!! asset('site/images/noRecordFound.svg') !!}"
                                     class="img-fluid" id="no_data_img"
                                     title="{!! trans('site.no_date') !!}">
                            @else
                                @foreach(footerImages() as $footerImage)
                                    <div class="col-md-4 col-6 px-2" data-aos="fade-down" data-aos-duration="1700">
                                        <a href="{!! asset(Storage::url($footerImage->full_path_after_upload)) !!}">
                                            <img
                                                src="{!! asset(Storage::url($footerImage->full_path_after_upload)) !!}"
                                                alt="{!! trans('site.footer_images') !!}">
                                        </a>
                                    </div>
                                @endforeach
                            @endif

                        </div>
                    </div>
                </div>
                <!-- End: Media --------------------------------------------------------------------------->
            </div>
        </div>
    </section>
</footer>

<section class="sub-footer p-3 bg-light text-center fs-14">{!! trans('site.copy_right') !!}</section>

