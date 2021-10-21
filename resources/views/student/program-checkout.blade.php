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


                <div class="col-lg-12 col-md-12 mb-12">
                    @if(\Illuminate\Support\Facades\Session::has('success'))
                        <div class="alert alert-success font-weight-bold" role="alert">
                            {{\Illuminate\Support\Facades\Session::get('success')}}
                        </div>
                    @else
                        @if( App\Models\MawhobEnrollProgram::where('program_id', $program->id)
                       ->where('mawhob_id', student()->id())->get()->count() >0)
                            <div class="alert alert-success font-weight-bold" role="alert">
                                {!! trans('site.you_have_already_purchased_the_program') !!}
                            </div>
                        @endif
                    @endif

                </div>


                <!-- begin::program ---------------------------------------------------------->
                <div class="col-lg-12 col-md-12 mb-12">
                    <div class="box-program p-4 br-5">
                        <div class="row align-items-center justify-content-between mb-3">
                            <div class="col-auto">
                                <img src="{!! asset(Storage::url($program->icon)) !!}"
                                     width="60" alt="">
                            </div>
                            <div class="col-auto text-center">
                                <h2 class=" text-bold">{!! $program->hours !!}</h2>
                                <div class=" fs-14">{!! trans('site.hours') !!}</div>
                            </div>
                        </div>
                        <div class="title-pr fs-18 text-bold mt-4">
                            {!! Lang()=='ar'?$program->name_ar:$program->name_en !!}
                        </div>
                        <p class="mt-3">
                            {!! Lang()=='ar'?$program->short_description_ar:$program->short_description_en !!}
                        </p>

                        <div class="row mt-4 mx-0 bg-light p-2 br-5">
                            <div class="col-lg-6 px-1">
                                <div class="fs-12">
                                    <span>{!! trans('site.start_at') !!}</span>
                                    <span dir="{!! Lang()=='ar'?'rtl':'ltr' !!}"> {!! $program->start_at !!} </span>
                                </div>
                            </div>
                            <div class="col-lg-6 px-1">
                                <div class="fs-12 text-right">
                                    <span>{!! trans('site.end_at') !!}</span>
                                    <span dir="{!! Lang()=='ar'?'rtl':'ltr' !!}"> {!! $program->end_at !!} </span>
                                </div>
                            </div>
                        </div>

                        <div class="work-plan text-bold fs-16 mt-4 mb-2">{!! trans('site.work_plane') !!}</div>
                        <div
                            class="file-link d-flex justify-content-between align-items-center   px-2 py-2 br-5">
                            <div class="fs-14">
                                <img src="{!! asset('site/img/pdf-file.svg') !!}" width="16" alt="">
                                <span class=" d-inline-block ">
                            {!! trans('site.download_work_plane') !!}
                        </span>
                            </div>
                            <div class="download">
                                <a href="{!! asset(Storage::url($program->work_plan)) !!}"
                                   target="_blank">
                                    <i class="far fa-arrow-alt-circle-down text-dark">
                                    </i>
                                </a>
                            </div>
                        </div>

                        <div class="row mt-4 mx-0 bg-light p-2 br-5">
                            <div class="col-lg-6 px-1 ">
                                <div class="fs-16-i text-black font-weight-bold ">
                                    <span>{!! trans('site.price') !!} : </span>
                                    <span dir="{!! Lang()=='ar'?'rtl':'ltr' !!}"> {!! $program->price !!} $ </span>
                                </div>
                            </div>
                            <div class="col-lg-6 px-1">
                                <div class="fs-16-i text-primary text-right font-weight-bold">
                                    <span>{!! trans('site.The_price_after_discount') !!} : </span>
                                    <span dir="{!! Lang()=='ar'?'rtl':'ltr' !!}">
                                        @if($program->discount == null || $program->discount == 0)
                                            {!! $program->price !!} $
                                        @else
                                            {!! $program->discount !!} $
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>


                        @if( App\Models\MawhobEnrollProgram::where('program_id', $program->id)
                       ->where('mawhob_id', student()->id())->get()->count()  == 0)
                            <div class="row mt-4 pb-10">
                                <!-- begin: Paypal ----------------------------------------------------------->
                                <div class="col-lg-6 col-md-6 mb-6">
                                    <form action="{!! route('paypal.pay') !!}" method="POST">
                                        @csrf
                                        <input class="form-control" type="hidden" name="item_type"
                                               value="program">
                                        <input class="form-control" type="hidden" name="item_id"
                                               value="{!! $program->id !!}">
                                        <input class="form-control" type="hidden" name="mawhob_id"
                                               value="{!! student()->id()!!}">

                                        @if($program->discount == null || $program->discount == 0)
                                            <input class="form-control" type="hidden" name="item_price"
                                                   value="{!! $program->price !!}">
                                        @else
                                            <input class="form-control" type="hidden" name="item_price"
                                                   value="{!! $program->discount !!}">
                                        @endif
                                        <input class="form-control" type="hidden" name="item_name"
                                               value="{!!Lang()=='ar'? $program->name_ar : $program->name_en !!}">
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
                <!-- end::program ---------------------------------------------------------->


            </div>

        </div>
    </section>

@endsection

