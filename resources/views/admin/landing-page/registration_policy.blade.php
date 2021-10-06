@extends('layouts.admin')
@section('title') @endsection
@section('content')

    <form class="form" action="{!! route('admin.registration.policy') !!}" method="POST"
          id="form_registration_policy_store"
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
                                {{trans('menu.registration_policy')}}
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
                                                            {{trans('landing.policy_title_ar')}}
                                                        </label>
                                                        <input value="{!! registrationPolicy()->policy_title_ar !!}"
                                                               class="form-control  form-control-lg"
                                                               name="policy_title_ar" id="policy_title_ar" type="text"
                                                               placeholder=" {{trans('landing.enter_policy_title_ar')}}"
                                                               autocomplete="off"/>
                                                        <span class="form-text text-danger"
                                                              id="policy_title_ar_error"></span>
                                                    </div>
                                                    <!--end::Group-->
                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label>
                                                            {{trans('landing.policy_title_en')}}
                                                        </label>
                                                        <input value="{!! registrationPolicy()->policy_title_en !!}"
                                                               class="form-control  form-control-lg"
                                                               name="policy_title_en" id="policy_title_en" type="text"
                                                               placeholder=" {{trans('landing.enter_policy_title_en')}}"
                                                               autocomplete="off"/>
                                                        <span class="form-text text-danger"
                                                              id="policy_title_en_error"></span>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.policy_details_ar')}}</label>
                                                        <textarea class="form-control summernote"
                                                                  placeholder="{{trans('landing.policy_details_ar')}}"
                                                                  name="policy_details_ar"
                                                                  id="policy_details_ar">{!! registrationPolicy()->policy_details_ar !!}</textarea>
                                                        <span class="form-text text-danger"
                                                              id="policy_details_ar_error"></span>
                                                    </div>
                                                    <!--end::Group-->

                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.policy_details_en')}}</label>
                                                        <textarea class="form-control summernote"
                                                                  placeholder="{{trans('landing.enter_policy_details_en')}}"
                                                                  name="policy_details_en"
                                                                  id="policy_details_en">{!! registrationPolicy()->policy_details_en !!}</textarea>
                                                        <span class="form-text text-danger"
                                                              id="policy_details_en_error"></span>
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


        //////////////////////////////////////////////////////
        $('#form_registration_policy_store').on('submit', function (e) {
            e.preventDefault();
            //////////////////////////////////////////////////////////////
            $('#policy_title_ar').css('border-color', '');
            $('#policy_title_en').css('border-color', '');
            $('#policy_details_ar').css('border-color', '');
            $('#policy_details_en').css('border-color', '');

            $('#policy_title_ar_error').text('');
            $('#policy_title_en_error').text('');
            $('#policy_details_ar_error').text('');
            $('#policy_details_en_error').text('');
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
                            customClass: {confirmButton: 'update_registration_policy_button'}
                        });
                        $('.update_registration_policy_button').click(function () {
                            $('html, body').animate({scrollTop: 5}, 300);
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

