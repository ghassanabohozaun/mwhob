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

    @include('site.includes.header')

    <section class="sub-header">
        <div class=" container text-center content-header">
            <h2>{!! trans('site.contests') !!}</h2>
            <p>
                {!! Lang()=='ar'? staticStrings()->contests_description_ar:staticStrings()->contests_description_en  !!}
            </p>
        </div>
        <div class="back-sub-header"><img src="{!! asset('site/img/Contests.jpg') !!}" alt=""></div>
    </section>


    @include('site.contests.last-winners')

    <section class=" bg-primary py-5 mb-5 mt-3">
        <div class=" container text-center">
            <div class=" fs-28 text-bold text-white my-4">
                {!! trans('site.as_for_life_to_be_daring_adventure_or_nothing') !!}
            </div>
        </div>
    </section>

    @include('site.contests.last-contests')



@endsection
