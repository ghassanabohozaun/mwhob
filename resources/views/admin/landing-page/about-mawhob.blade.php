@extends('layouts.admin')
@section('title') @endsection
@section('content')

    <form class="form" action="{!! route('admin.about.mawhob') !!}" method="POST"
          id="form_about_mawhob_store"
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
                                {{trans('menu.about_mawhob')}}
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
                                                            {{trans('landing.title_ar')}}
                                                        </label>
                                                        <input value="{!! aboutMawob()->title_ar !!}"
                                                               class="form-control  form-control-lg"
                                                               name="title_ar" id="title_ar" type="text"
                                                               placeholder=" {{trans('landing.enter_title_ar')}}"
                                                               autocomplete="off"/>
                                                        <span class="form-text text-danger"
                                                              id="title_ar_error"></span>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label>
                                                            {{trans('landing.title_en')}}
                                                        </label>
                                                        <input value="{!! aboutMawob()->title_en !!}"
                                                               class="form-control  form-control-lg"
                                                               name="title_en" id="title_en" type="text"
                                                               placeholder=" {{trans('landing.enter_title_en')}}"
                                                               autocomplete="off"/>
                                                        <span class="form-text text-danger"
                                                              id="title_en_error"></span>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.summary_ar')}}</label>
                                                        <textarea class="form-control" rows="7"
                                                                  placeholder="{{trans('landing.enter_summary_ar')}}"
                                                                  name="summary_ar" dir="rtl"
                                                                  id="summary_ar">{!! aboutMawob()->summary_ar !!}</textarea>
                                                        <span class="form-text text-danger"
                                                              id="summary_ar_error"></span>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.summary_en')}}</label>
                                                        <textarea class="form-control " rows="7"
                                                                  placeholder="{{trans('landing.enter_summary_en')}}"
                                                                  name="summary_en" dir="ltr"
                                                                  id="summary_en">{!! aboutMawob()->summary_en !!}</textarea>
                                                        <span class="form-text text-danger"
                                                              id="summary_en_error"></span>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.details_ar')}}</label>
                                                        <textarea class="form-control summernote"
                                                                  placeholder="{{trans('landing.enter_details_ar')}}"
                                                                  name="details_ar"
                                                                  id="details_ar">{!! aboutMawob()->details_ar !!}</textarea>
                                                        <span class="form-text text-danger"
                                                              id="details_ar_error"></span>
                                                    </div>
                                                    <!--end::Group-->

                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.details_en')}}</label>
                                                        <textarea class="form-control summernote"
                                                                  placeholder="{{trans('landing.enter_details_en')}}"
                                                                  name="details_en"
                                                                  id="details_en">{!! aboutMawob()->details_en !!}</textarea>
                                                        <span class="form-text text-danger"
                                                              id="details_en_error"></span>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group ">
                                                        <label>
                                                            {{trans('landing.video')}}
                                                        </label>
                                                        <input value="https://www.youtube.com/watch?v={!! aboutMawob()->video !!}"
                                                               class="form-control form-control-lg"
                                                               type="text" name="video" id="video"
                                                               placeholder="{!! trans('landing.enter_video') !!}"/>
                                                        <span class="form-text text-muted">
                                                                {{trans('general.example')}} :
                                                                 https://www.youtube.com/watch?v=c2pz2mlSfXA
                                                            </span>
                                                        <span class="form-text text-danger" id="video_error">
                                                        </span>
                                                    </div>
                                                    <!--end::Group-->


                                                    @if(aboutMawob()->video == null)
                                                        <div class="form-group" id="video_section">
                                                            <label>
                                                            </label>
                                                            <span class="label label-danger label-inline label-lg">
                                                                   {{trans('landing.no_video')}}
                                                                </span>
                                                        </div>
                                                    @else
                                                        <div class="form-group " id="video_section">
                                                            <label>
                                                                &nbsp;
                                                            </label>
                                                            <span class="label label-dark label-inline label-lg ">
                                                                      <a href="https://www.youtube.com/watch?v={!! aboutMawob()->video !!}"
                                                                         class="text-white" target="_blank">
                                                                    {{trans('landing.show_video')}}
                                                                </a>
                                                                </span>
                                                        </div>
                                                    @endif

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
        $('#form_about_mawhob_store').on('submit', function (e) {
            e.preventDefault();
            //////////////////////////////////////////////////////////////
            $('#title_ar').css('border-color', '');
            $('#title_en').css('border-color', '');
            $('#summary_ar').css('border-color', '');
            $('#summary_en').css('border-color', '');
            $('#details_ar').css('border-color', '');
            $('#details_en').css('border-color', '');
            $('#video').css('border-color', '');


            $('#title_ar_error').text('');
            $('#title_en_error').text('');
            $('#summary_ar_error').text('');
            $('#summary_en_error').text('');
            $('#details_ar_error').text('');
            $('#details_en_error').text('');
            $('#video_error').text('');
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
                            customClass: {confirmButton: 'udate_about_mawhob_button'}
                        });
                        $('.udate_about_mawhob_button').click(function () {
                            $("#video_section").load(location.href + " #video_section");
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

