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







    <section class="content-section mt-4 mb-4 py-4 px-4 px-md-0 ">
        <div class="container" data-aos="fade-up" data-aos-duration="1500">
            <div class="row justify-content-between align-items-center">

                <!-- begin:: Alert --------------------------------------------------------------------------------->
                <div class="col-lg-12 col-md-12 mb-12">
                    @if(\Illuminate\Support\Facades\Session::has('success'))
                        <div class="alert alert-success font-weight-bold" role="alert">
                            {{\Illuminate\Support\Facades\Session::get('success')}}
                        </div>
                    @else
                        @if( App\Models\MawhobEnrollCourse::where('course_id', $course->id)
                            ->where('mawhob_id', student()->id())->get()->count() >0)
                            <div class="alert alert-success font-weight-bold" role="alert">
                                {!! trans('site.you_have_already_purchased_the_course') !!}
                            </div>
                        @endif
                    @endif
                </div>
                <!-- end:: Alert --------------------------------------------------------------------------------->

                <!-- begin::course -------------------------------------------------------------------------------->
                <div class="col-lg-12 col-md-12 mb-12">
                    <div class="box-program p-4 br-5">
                        <div class=" container py-4">

                            <div class="course-dt">
                                <div class="cor-img">
                                    <img
                                        src="{!! asset(\Illuminate\Support\Facades\Storage::url($course->course_image)) !!}"
                                        width="100%" style="height: 100%" alt="">
                                </div>
                                <div class="row  py-3 mt-4">
                                    <div class="col-md-10">
                                        <div class="text-bold">
                                            {!! Lang()=='ar'?$course->title_ar:$course->title_en !!}
                                        </div>
                                    </div>
                                    <div class="col-auto d-flex align-items-center">
                                        @if($course->discount!=null || $course->discount!=0)
                                            <span class="net-price mr-2">{!! $course->discount !!}$</span>
                                            <span class="old-price">{!! $course->cost !!}$</span>
                                        @else
                                            <span class="my_price">{!! $course->cost !!}$</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mt-1 mx-0 bg-light p-2 br-5">
                                    <div class="col-lg-6 px-1">
                                        <div class="fs-12">
                                            <span>{!! trans('site.start_at') !!}</span>
                                            <span
                                                dir="{!! Lang()=='ar'?'rtl':'ltr' !!}"> {!! $course->start_at !!} </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 px-1">
                                        <div class="fs-12 text-right">
                                            <span>{!! trans('site.end_at') !!}</span>
                                            <span
                                                dir="{!! Lang()=='ar'?'rtl':'ltr' !!}"> {!! $course->end_at !!} </span>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <div class="fs-18 mt-3 text-bold mb-2">{!! trans('site.course_details') !!}</div>
                                    <div class="fs-14 mb-4">
                                        {!! Lang()=='ar'?$course->description_ar:$course->description_en !!}
                                    </div>
                                </div>

                                @if( App\Models\MawhobEnrollCourse::where('course_id', $course->id)
                                                         ->where('mawhob_id', student()->id())->get()->count()  == 0)
                                    <div class="row mt-4">
                                        <!-- begin: Paypal ----------------------------------------------------------->
                                        <div class="col-lg-6 col-md-6 mb-6">
                                            <form action="{!! route('paypal.pay') !!}" method="POST">
                                                @csrf
                                                <input class="form-control" type="hidden" name="item_type"
                                                       value="course">
                                                <input class="form-control" type="hidden" name="item_id"
                                                       value="{!! $course->id !!}">
                                                <input class="form-control" type="hidden" name="mawhob_id"
                                                       value="{!! student()->id()!!}">

                                                @if($course->discount == null || $course->discount == 0)
                                                    <input class="form-control" type="hidden" name="item_price"
                                                           value="{!! $course->cost !!}">
                                                @else
                                                    <input class="form-control" type="hidden" name="item_price"
                                                           value="{!! $course->discount !!}">
                                                @endif
                                                <input class="form-control" type="hidden" name="item_name"
                                                       value="{!!Lang()=='ar'? $course->title_ar :  $course->title_en !!}">
                                                <button type="submit" class=" btn btn-primary   btn-block ">
                                                    <div class=" d-flex align-items-center justify-content-between">
                                                        <div>{!! trans('site.pay_by_paypal') !!}</div>
                                                        <div></div>
                                                    </div>
                                                </button>
                                            </form>
                                        </div>
                                        <!-- end: Paypal ------------------------------------------------------------->

                                        <!-- begin: PalPay ------------------------------------------------------------>
                                        <div class="col-lg-6 col-md-6 mb-6">
                                            <form>
                                                @csrf
                                                <button type="button" class=" btn btn-primary  btn-block ">
                                                    <div class=" d-flex align-items-center justify-content-between">
                                                        <div>{!! trans('site.pay_by_palpay') !!}</div>
                                                        <div></div>
                                                    </div>
                                                </button>
                                            </form>
                                        </div>
                                        <!-- end: PalPay -------------------------------------------------------------->
                                    </div>
                                @endif


                            </div>
                        </div>
                    </div>
                </div>
                <!-- end::course ---------------------------------------------------------------------------------->

            </div>
        </div>
    </section>




@endsection
