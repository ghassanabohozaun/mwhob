@extends('layouts.site')
@section('title') {!! trans('site.mawhob') !!} @endsection
@section('metaTags')
    <meta name="description"
          content="{!! Lang()=='ar' ? setting()->site_description_ar : setting()->site_description_en !!}">
    <meta name="keywords"
          content="{!! Lang()=='ar' ? setting()->site_keywords_ar : setting()->site_keywords_en !!}">
    <meta name="application-name" content="{!! Lang()=='ar' ? setting()->site_name_ar : setting()->site_name_en !!}"/>
    <meta name="author" content="{!! Lang()=='ar' ? setting()->site_name_ar : setting()->site_name_en !!}"/>
@endsection

@push('css')
@endpush
@section('content')

@include('site.includes.orange-header')

<section class=" content-section py-5 px-4 px-md-0">
    <div class=" container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-6">
                <div>

                    <h2 data-aos="fade-down"
                        data-aos-duration="1200">{!! Lang()=='ar'?aboutMawob()->title_ar:aboutMawob()->title_en !!}</h2>

                    <p data-aos="fade-down" data-aos-duration="1500" class="my-3">
                        {!! Lang()=='ar'?aboutMawob()->details_ar:aboutMawob()->details_en !!}</h2>
                    </p>
                </div>

            </div>
            <div class="col-lg-5">
                <div class="box-video-right" data-aos="fade-left" data-aos-duration="1800">
                    <a href="#" class="link-to-video" uk-toggle="target: +">
                        <i class="fas fa-play-circle"></i></a>
                <!--<iframe hidden
                            src="{!! asset(Storage::url(aboutMawob()->video)) !!}"
                            width="100%" height="400" frameborder="0" allowfullscreen uk-responsive></iframe> -->


                </div>
            </div>
        </div>
    </div>
</section>

@endsection
