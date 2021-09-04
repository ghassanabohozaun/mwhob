@extends('layouts.student')
@section('title') {!! trans('site.mawhob') !!} @endsection
@section('metaTags')
    <meta name="description"
          content="{!! Lang()=='ar' ? setting()->site_description_ar : setting()->site_description_en !!}">
    <meta name="keywords"
          content="{!! Lang()=='ar' ? setting()->site_keywords_ar : setting()->site_keywords_en !!}">
    <meta name="application-name" content="{!! Lang()=='ar' ? setting()->site_name_ar : setting()->site_name_en !!}"/>
    <meta name="author" content="{!! Lang()=='ar' ? setting()->site_name_ar : setting()->site_name_en !!}"/>
@endsection

@section('content')

    <section class="c-panel">
        <div class="  ">
            <div class="row mx-0 align-items-center">
                <!-- begin:left ------------------------------------------------------------->

                <div class="col-lg-6 px-0 left-background-login d-none d-lg-block">
                    <div class="img-left-login ">
                        <img src="{!! asset('site.img/img-login.jpg') !!}img/img-login.jpg" class=" uk-background-fixed"
                             width="100%" alt="">
                    </div>
                </div>
                <!-- end:left ------------------------------------------------------------->

                <!-- begin:right ------------------------------------------------------------->
                <div class="col-lg-6 d-flex align-items-center block-login">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="  p-5 text-center">
                                <div class="title-block-login text-bold text-warning fs-24">
                                    {!! trans('site.login') !!}
                                </div>
                                <div class="fs-12 my-3">
                                    {!! trans('site.login_description') !!}

                                </div>
                                <form style="width: 420px"  action="{!! route('student.login') !!}"
                                      method="POST" enctype="multipart/form-data">
                                    @csrf

                                    @if(\Illuminate\Support\Facades\Session::has('error'))
                                        <div class="alert alert-danger font-weight-bold" role="alert">
                                            {{\Illuminate\Support\Facades\Session::get('error')}}
                                        </div>
                                    @endif


                                    <div class="form-group text-left mt-4">
                                        <label for="Mobile" class=" ">{!! trans('site.mobile_no') !!}</label>
                                        <input type="number" class="form-control"
                                               id="mawhob_mobile_no" name="mawhob_mobile_no"
                                               autocomplete="off"
                                               placeholder="{!! trans('site.enter_mobile_no') !!}">

                                        @error('mawhob_mobile_no')
                                        <span class="text-danger font-weight-bold"
                                              style="font-size: 14px ;">{{$message}}</span>
                                        @enderror
                                    </div>


                                    <div class="form-group text-left">
                                        <label for="exampleInputPassword1">{!! trans('site.password') !!}</label>
                                        <input type="password" class="form-control"
                                               id="password" name="password"
                                               placeholder="{!! trans('site.enter_password') !!}">
                                        @error('password')
                                        <span class="text-danger font-weight-bold" style="font-size: 14px ;">{{$message}}</span>
                                        @enderror
                                    </div>


                                    <div class="form-group  text-left">
                                        {!! trans('site.dont_have_account') !!}
                                        <a href="{!! route('student.signup') !!}" class=" text-dark text-bold">
                                            {!! trans('site.create_account') !!}
                                        </a>
                                    </div>
                                    <button
                                            class="btn btn-primary px-5 br-20">{!! trans('site.login') !!}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end:right ------------------------------------------------------------->

            </div>
        </div>
    </section>

@endsection
