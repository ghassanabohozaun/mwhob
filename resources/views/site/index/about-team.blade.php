<section class="about-team my-5">
    <div class=" container">
        <div class="row align-items-center position-relative">
            <img class="img-about-team d-none d-lg-block" data-aos="flip-right" data-aos-duration="1200"
                 src="{!! asset('site/img/about-team.jpg') !!}" height="75%" alt="{!! trans('site.about_team') !!}">
            <div class="col-lg-10 shadow-lg p-5 ">
                <div class="row">

                    <div class="col-lg-10">
                        <div class="about-team-box text-center p-lg-5 p-3">
                            <h2 class=" text-bold" data-aos="fade-down" data-aos-duration="1200">
                                {!! trans('site.about_team') !!}
                            </h2>
                            <p class="my-3" data-aos="fade-down" data-aos-duration="1500">
                                {!! Lang()=='ar'?indexPage()->about_team_ar:indexPage()->about_team_en !!}
                            </p>
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <div class="row">
                                        @if($teams->isEmpty())
                                            <img src="{!! asset(Storage::url(indexPage()->about_team_image)) !!}"
                                                 class="img-fluid" id="no_data_img"
                                                 title="{!! trans('site.no_date') !!}">
                                        @else
                                            @foreach($teams as $team)
                                                <div class="col text-center">
                                                    <div class="img-team-user" data-aos="fade-up"
                                                         data-aos-duration="1200">
                                                        <img
                                                            src="{!! asset(Storage::url($team->team_image)) !!}"
                                                            width="70"
                                                            alt="{!! Lang()=='ar'?$team->name_ar:$team->name_en !!}">
                                                    </div>
                                                    <div
                                                        class="title-team-user text-primary">
                                                        {!! Lang()=='ar'?$team->name_ar:$team->name_en !!}
                                                    </div>
                                                    <div
                                                        class="title-this-user"> {!! Lang()=='ar'?$team->position_ar:$team->position_en !!}</div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-lg-3">

            </div>
        </div>
    </div>
</section>
