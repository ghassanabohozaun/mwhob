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
            <h2>{!! trans('site.mawhoob_magazine') !!}</h2>
            <p>{!! Lang()=='ar'? staticStrings()->magazine_description_ar:staticStrings()->magazine_description_en  !!}</p>
        </div>
        <div class="back-sub-header"><img src="{!! asset('site/img/Magazine.png') !!}" alt=""></div>
    </section>
    <section class=" content-section py-5 my-5 px-4 px-md-0">
        <div class="container text-center py-5 my-5">
            <h1 class="py-4  fs-30">{!! trans('site.coming_soon') !!}</h1>
        </div>
    </section>

@endsection
