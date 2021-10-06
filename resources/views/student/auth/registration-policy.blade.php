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
                <div class="col-lg-12 " >
                    <div>
                        <h2 data-aos="fade-down"
                            data-aos-duration="1200">{!! Lang()=='ar'?registrationPolicy()->policy_title_ar:registrationPolicy()->policy_title_en !!}</h2>
                       <br/>
                        <p data-aos="fade-down"  data-aos-duration="1200" class="my-3">
                            {!! Lang()=='ar'?registrationPolicy()->policy_details_ar:registrationPolicy()->policy_details_en !!}</h2>
                        </p>

                        <p class="py-3" data-aos="fade-down"  data-aos-duration="1200">
                            <a href="{!! route('student.signup') !!}" class="btn btn-primary" >
                                {!! trans('site.i_agree_to_the_registration_policy_and_agreement') !!}
                            </a>
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection

