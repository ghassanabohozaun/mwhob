@push('css')

@endpush
<section class="about-mwhob my-5 py-lg-5">
    <div class=" container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-6">
                <div>

                    <h2 data-aos="fade-down"
                        data-aos-duration="1200">{!! Lang()=='ar'?aboutMawob()->title_ar:aboutMawob()->title_en !!}</h2>

                    <p data-aos="fade-down" data-aos-duration="1500" class="my-3">
                        {!! Lang()=='ar'?aboutMawob()->summary_ar:aboutMawob()->summary_en !!}</h2>
                    </p>
                </div>
                <div data-aos="fade-down" data-aos-duration="1800" class="mb-3">
                    <a href="{!! route('about.mawhoob') !!}">{!! trans('site.read_more') !!}</a>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="box-video-right" data-aos="fade-left" data-aos-duration="1800">
                    <a href="#" class="link-to-video" uk-toggle="target: +">
                        <i class="fas fa-play-circle"></i></a>


                    <iframe hidden=""
                            src="https://www.youtube-nocookie.com/embed/{!! aboutMawob()->video !!}?autoplay=0&amp;showinfo=0&amp;rel=0&amp;modestbranding=1&amp;playsinline=1"
                            width="100%" height="400" frameborder="0" allowfullscreen="" uk-responsive=""
                            class="uk-responsive-width"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

@push('js')
    <script type="text/javascript">
        $("iframe").each(function () {
            var src = $(this).attr('src');
            $(this).attr('src', src);
        });
    </script>
@endpush
