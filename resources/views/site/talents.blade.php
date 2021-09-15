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
            <h2>{!! trans('site.talents') !!}</h2>
            <p>{!! Lang()=='ar'?staticStrings()->talents_description_ar:staticStrings()->talents_description_en !!}</p>
        </div>
        <div class="back-sub-header">
            <img src="{!! asset('site/img/header-2.jpg') !!}" alt="">
        </div>
    </section>

    <section class=" content-section py-5 px-4 px-md-0">
        <div class=" container">
            @include('site.talents.sounds')
            @include('site.talents.videos')
            @include('site.talents.success-stories')
        </div>
    </section>

@endsection
