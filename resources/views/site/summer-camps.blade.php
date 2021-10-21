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
            <h2 class="mb-3">{!! trans('site.summer_camps') !!}</h2>
            <p class="text-center">
                {!! Lang()=='ar'? staticStrings()->summer_camps_description_ar:staticStrings()->summer_camps_description_en  !!}
            </p>
        </div>
        <div class="back-sub-header">
            <img src="{!! asset('site/img/Programs.jpg') !!}"
                 alt="{!! trans('site.summer_camps') !!}">
        </div>
    </section>

    @include('site.summer-camp.latest-summer-camps')
    @include('site.summer-camp.categories')
    @include('site.summer-camp.oldest-summer-camps')

@endsection


