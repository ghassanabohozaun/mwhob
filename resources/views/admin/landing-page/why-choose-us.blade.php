@extends('layouts.admin')
@section('title') @endsection
@section('content')

    <form class="form" action="{!! route('admin.why.choose.us') !!}" method="POST"
          id="form_why_choose_us_store"
          enctype="multipart/form-data">
    @csrf
    <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div
                class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex align-items-center flex-wrap mr-2">

                    <!--begin::Actions-->
                    <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>

                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);" class="text-muted">
                                {{trans('menu.landing_page')}}
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="" class="text-muted">
                                {{trans('menu.why_choose_us')}}
                            </a>
                        </li>

                    </ul>

                    <!--end::Actions-->
                </div>
                <!--end::Info-->

                <!--begin::Toolbar-->
                <div class="d-flex align-items-center">
                    <button type="submit"
                            class="btn btn-primary btn-sm font-weight-bold font-size-base  mr-1">
                        <i class="fa fa-save"></i>
                        {{trans('general.save')}}
                    </button>
                </div>
                <!--end::Toolbar-->
            </div>
        </div>
        <!--end::Subheader-->


        <!--begin::content-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class=" container-fluid ">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-lg-12">
                        <!--begin::Card-->
                        <!--begin::Card-->
                        <div class="card card-custom card-shadowless rounded-top-0" id="card_settings_store">
                            <!--begin::Body-->
                            <div class="card-body p-0">
                                <div class="row justify-content-center py-8 px-8 py-lg-15 px-lg-10">
                                    <div class="col-xl-12 col-xxl-10">

                                        <div class="row justify-content-center">
                                            <div class="col-xl-9">

                                                <!--begin::body-->
                                                <div class="my-5">

                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label>
                                                            {{trans('landing.why_choose_us_ar')}}
                                                        </label>
                                                        <textarea
                                                            maxlength="300"
                                                            onkeyup="limitText('why_choose_us_ar' , 'why_choose_us_ar_char_count')"
                                                            dir="rtl" rows="4"
                                                            class="form-control  form-control-lg"
                                                            name="why_choose_us_ar" id="why_choose_us_ar"
                                                            placeholder=" {{trans('landing.enter_why_choose_us_ar')}}"
                                                            autocomplete="off">{!! whyChooseUs()->why_choose_us_ar !!}</textarea>
                                                        <div class="form-text text-warning"
                                                             id="why_choose_us_ar_char_count"></div>

                                                        <span class="form-text text-danger"
                                                              id="why_choose_us_ar_error"></span>
                                                    </div>
                                                    <!--end::Group-->

                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label>
                                                            {{trans('landing.why_choose_us_en')}}
                                                        </label>
                                                        <textarea
                                                            maxlength="300"
                                                            onkeyup="limitText('why_choose_us_en' , 'why_choose_us_en_char_count')"
                                                            dir="ltr" rows="4"
                                                            class="form-control  form-control-lg"
                                                            name="why_choose_us_en" id="why_choose_us_en"
                                                            type="text"
                                                            placeholder=" {{trans('landing.enter_why_choose_us_en')}}"
                                                            autocomplete="off">{!! whyChooseUs()->why_choose_us_en !!}</textarea>
                                                        <div class="form-text text-warning"
                                                             id="why_choose_us_en_char_count"></div>
                                                        <span class="form-text text-danger"
                                                              id="why_choose_us_en_error"></span>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.reason_1')}}</label>
                                                        <input value="{!! whyChooseUs()->reason_1 !!}"
                                                            type="text"
                                                            class="form-control"
                                                            placeholder="{{trans('landing.enter_reason_1')}}"
                                                            name="reason_1" dir="rtl"
                                                            id="reason_1"/>
                                                        <span class="form-text text-danger"
                                                              id="reason_1_error"></span>
                                                    </div>
                                                    <!--end::Group-->

                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.reason_en_1')}}</label>
                                                        <input value="{!! whyChooseUs()->reason_en_1 !!}"
                                                               type="text"
                                                               class="form-control"
                                                               placeholder="{{trans('landing.enter_reason_en_1')}}"
                                                               name="reason_en_1" dir="ltr"
                                                               id="reason_en_1"/>
                                                        <span class="form-text text-danger"
                                                              id="reason_en_1_error"></span>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.reason_2')}}</label>
                                                        <input  value="{!! whyChooseUs()->reason_2 !!}"
                                                            type="text"
                                                               class="form-control"
                                                               placeholder="{{trans('landing.enter_reason_2')}}"
                                                               name="reason_2" dir="rtl"
                                                               id="reason_2"/>
                                                        <span class="form-text text-danger"
                                                              id="reason_2_error"></span>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.reason_en_2')}}</label>
                                                        <input value="{!! whyChooseUs()->reason_en_2 !!}"
                                                               type="text"
                                                               class="form-control"
                                                               placeholder="{{trans('landing.enter_reason_en_2')}}"
                                                               name="reason_en_2" dir="ltr"
                                                               id="reason_en_2"/>
                                                        <span class="form-text text-danger"
                                                              id="reason_en_2_error"></span>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.reason_3')}}</label>
                                                        <input  value="{!! whyChooseUs()->reason_3 !!}"
                                                            type="text"
                                                               class="form-control"
                                                               placeholder="{{trans('landing.enter_reason_3')}}"
                                                               name="reason_3" dir="rtl"
                                                               id="reason_3"/>
                                                        <span class="form-text text-danger"
                                                              id="reason_3_error"></span>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.reason_en_3')}}</label>
                                                        <input value="{!! whyChooseUs()->reason_en_3 !!}"
                                                               type="text"
                                                               class="form-control"
                                                               placeholder="{{trans('landing.enter_reason_en_3')}}"
                                                               name="reason_en_3" dir="ltr"
                                                               id="reason_en_3"/>
                                                        <span class="form-text text-danger"
                                                              id="reason_en_3_error"></span>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.reason_4')}}</label>
                                                        <input  value="{!! whyChooseUs()->reason_4 !!}"
                                                            type="text"
                                                               class="form-control"
                                                               placeholder="{{trans('landing.enter_reason_4')}}"
                                                               name="reason_4" dir="rtl"
                                                               id="reason_4"/>
                                                        <span class="form-text text-danger"
                                                              id="reason_4_error"></span>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.reason_en_4')}}</label>
                                                        <input value="{!! whyChooseUs()->reason_en_4 !!}"
                                                               type="text"
                                                               class="form-control"
                                                               placeholder="{{trans('landing.enter_reason_en_4')}}"
                                                               name="reason_en_4" dir="ltr"
                                                               id="reason_en_4"/>
                                                        <span class="form-text text-danger"
                                                              id="reason_en_4_error"></span>
                                                    </div>
                                                    <!--end::Group-->



                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.reason_5')}}</label>
                                                        <input value="{!! whyChooseUs()->reason_5 !!}"
                                                            type="text"
                                                               class="form-control"
                                                               placeholder="{{trans('landing.enter_reason_5')}}"
                                                               name="reason_5" dir="rtl"
                                                               id="reason_5"/>
                                                        <span class="form-text text-danger"
                                                              id="reason_5_error"></span>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.reason_en_5')}}</label>
                                                        <input value="{!! whyChooseUs()->reason_en_5 !!}"
                                                               type="text"
                                                               class="form-control"
                                                               placeholder="{{trans('landing.enter_reason_en_5')}}"
                                                               name="reason_en_5" dir="ltr"
                                                               id="reason_en_5"/>
                                                        <span class="form-text text-danger"
                                                              id="reason_en_5_error"></span>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.reason_6')}}</label>
                                                        <input   value="{!! whyChooseUs()->reason_6 !!}"
                                                            type="text"
                                                               class="form-control"
                                                               placeholder="{{trans('landing.enter_reason_6')}}"
                                                               name="reason_6" dir="rtl"
                                                               id="reason_6"/>
                                                        <span class="form-text text-danger"
                                                              id="reason_6_error"></span>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.reason_en_6')}}</label>
                                                        <input value="{!! whyChooseUs()->reason_en_6 !!}"
                                                               type="text"
                                                               class="form-control"
                                                               placeholder="{{trans('landing.enter_reason_en_6')}}"
                                                               name="reason_en_6" dir="ltr"
                                                               id="reason_en_6"/>
                                                        <span class="form-text text-danger"
                                                              id="reason_en_6_error"></span>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.reason_7')}}</label>
                                                        <input  value="{!! whyChooseUs()->reason_7 !!}"
                                                            type="text"
                                                               class="form-control"
                                                               placeholder="{{trans('landing.enter_reason_7')}}"
                                                               name="reason_7" dir="rtl"
                                                               id="reason_7"/>
                                                        <span class="form-text text-danger"
                                                              id="reason_7_error"></span>
                                                    </div>
                                                    <!--end::Group-->

                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.reason_en_7')}}</label>
                                                        <input value="{!! whyChooseUs()->reason_en_7 !!}"
                                                               type="text"
                                                               class="form-control"
                                                               placeholder="{{trans('landing.enter_reason_en_7')}}"
                                                               name="reason_en_7" dir="ltr"
                                                               id="reason_en_7"/>
                                                        <span class="form-text text-danger"
                                                              id="reason_en_7_error"></span>
                                                    </div>
                                                    <!--end::Group-->

                                                </div>
                                                <!--begin::body-->

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Card-->
                    </div>
                </div>

            </div>
        </div>
        <!--end::content-->

    </form>
@endsection

@push('js')


    <script type="text/javascript">


        why_choose_us_ar
        //////////////////////////////////////////////////////
        $('#form_why_choose_us_store').on('submit', function (e) {
            e.preventDefault();
            //////////////////////////////////////////////////////////////
            $('#why_choose_us_ar').css('border-color', '');
            $('#why_choose_us_en').css('border-color', '');
            $('#reason_1').css('border-color', '');
            $('#reason_2').css('border-color', '');
            $('#reason_3').css('border-color', '');
            $('#reason_4').css('border-color', '');
            $('#reason_5').css('border-color', '');
            $('#reason_6').css('border-color', '');
            $('#reason_7').css('border-color', '');
            $('#reason_en_1').css('border-color', '');
            $('#reason_en_2').css('border-color', '');
            $('#reason_en_3').css('border-color', '');
            $('#reason_en_4').css('border-color', '');
            $('#reason_en_5').css('border-color', '');
            $('#reason_en_6').css('border-color', '');
            $('#reason_en_7').css('border-color', '');

            $('#why_choose_us_ar_error').text('');
            $('#why_choose_us_en_error').text('');
            $('#reason_1_error').text('');
            $('#reason_2_error').text('');
            $('#reason_3_error').text('');
            $('#reason_4_error').text('');
            $('#reason_5_error').text('');
            $('#reason_6_error').text('');
            $('#reason_7_error').text('');
            $('#reason_en_1_error').text('');
            $('#reason_en_2_error').text('');
            $('#reason_en_3_error').text('');
            $('#reason_en_4_error').text('');
            $('#reason_en_5_error').text('');
            $('#reason_en_6_error').text('');
            $('#reason_en_7_error').text('');
            /////////////////////////////////////////////////////////////
            var data = new FormData(this);
            var type = $(this).attr('method');
            var url = $(this).attr('action');

            $.ajax({
                url: url,
                type: type,
                data: data,
                dataType: false,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
                    KTApp.blockPage({
                        overlayColor: '#000000',
                        state: 'danger',
                        message: "{{trans('general.please_wait')}}",
                    });
                },
                success: function (data) {
                    KTApp.unblockPage();
                    console.log(data);
                    if (data.status == true) {
                        Swal.fire({
                            title: data.msg,
                            text: "",
                            icon: "success",
                            allowOutsideClick: false,
                            customClass: {confirmButton: 'update_why_choose_us_button'}
                        });
                        $('.update_why_choose_us_button').click(function () {
                            $('html, body').animate({scrollTop: 5}, 300);

                            $('#why_choose_us_ar_char_count').text('');
                            $('#why_choose_us_en_char_count').text('');

                        });
                    }
                },

                error: function (reject) {
                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function (key, value) {
                        $('#' + key + '_error').text(value[0]);
                        $('#' + key).css('border-color', 'red');
                        $('body,html').animate({scrollTop: 20}, 300);
                    });
                },
                complete: function () {
                    KTApp.unblockPage();
                },
            })

        });//end submit


    </script>
@endpush

