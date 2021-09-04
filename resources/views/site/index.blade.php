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
    @include('site.index.slider')
    @include('site.index.sub-slider')
    @include('site.index.about-mawhob')
    @include('site.index.best-mawhobs')
    @include('site.index.best-app')
    @include('site.index.best-courses')
    @include('site.index.about-team')
    @include('site.index.mission')
    @include('site.index.contact-us')
@endsection
