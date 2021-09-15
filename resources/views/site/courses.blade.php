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
            <h2>{!! trans('site.courses') !!}</h2>
            <p>{!! Lang()=='ar'?staticStrings()->courses_description_ar:staticStrings()->courses_description_en !!}</p>
        </div>
        <div class="back-sub-header"><img src="{!! asset('site/img/Courses.jpg') !!}" alt=""></div>
    </section>


    @include('site.courses.latest-courses')
    @include('site.courses.why-choose-us')
    @include('site.courses.categories')
    @include('site.courses.our-courses')

@endsection
