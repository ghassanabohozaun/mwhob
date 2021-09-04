<section class="our-mission ">
    <div class=" container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-6 col-md-9">
                <div class="box-mission p-5  my-5 text-center position-relative">
                    <img class="right-top" src="{!! asset('site/img/cotachen.svg') !!}"
                         alt=" {!! Lang()=='ar'?indexPage()->our_mission_ar:indexPage()->our_mission_en !!}">
                    <img class="left-bottom" src="{!! asset('site/img/cotachen.svg') !!}"
                         alt=" {!! Lang()=='ar'?indexPage()->our_mission_ar:indexPage()->our_mission_en !!}">
                    <h2 class=" text-bold mb-2" data-aos="fade-down" data-aos-duration="1000">
                        {!! trans('site.our_mission') !!}
                    </h2>
                    <p class=" fs-20" data-aos="fade-down" data-aos-duration="500" >
                        {!! Lang()=='ar'?indexPage()->our_mission_ar:indexPage()->our_mission_en !!}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
