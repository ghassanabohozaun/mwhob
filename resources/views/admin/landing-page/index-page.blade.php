@extends('layouts.admin')
@section('title') @endsection
@section('content')

    <form class="form" action="{!! route('admin.index.page') !!}" method="POST"
          id="form_index_page_store"
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
                                {{trans('menu.index')}}
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
                                                            {{trans('landing.mawhobs_description_ar')}}
                                                        </label>
                                                        <textarea
                                                            maxlength="300"
                                                            onkeyup="limitText('mawhobs_description_ar' , 'mawhobs_description_ar_char_count')"
                                                            dir="rtl" rows="4"
                                                            class="form-control  form-control-lg"
                                                            name="mawhobs_description_ar" id="mawhobs_description_ar"
                                                            placeholder=" {{trans('landing.enter_mawhobs_description_ar')}}"
                                                            autocomplete="off">{!! indexPage()->mawhobs_description_ar !!}</textarea>
                                                        <div class="form-text text-warning"
                                                             id="mawhobs_description_ar_char_count"></div>

                                                        <span class="form-text text-danger"
                                                              id="mawhobs_description_ar_error"></span>
                                                    </div>
                                                    <!--end::Group-->

                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label>
                                                            {{trans('landing.mawhobs_description_en')}}
                                                        </label>
                                                        <textarea
                                                            maxlength="300"
                                                            onkeyup="limitText('mawhobs_description_en' , 'mawhobs_description_en_char_count')"
                                                            dir="ltr" rows="4"
                                                            class="form-control  form-control-lg"
                                                            name="mawhobs_description_en" id="mawhobs_description_en"
                                                            type="text"
                                                            placeholder=" {{trans('landing.enter_mawhobs_description_en')}}"
                                                            autocomplete="off">{!! indexPage()->mawhobs_description_en !!}</textarea>
                                                        <div class="form-text text-warning"
                                                             id="mawhobs_description_en_char_count"></div>
                                                        <span class="form-text text-danger"
                                                              id="mawhobs_description_en_error"></span>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.courses_description_ar')}}</label>
                                                        <textarea
                                                            maxlength="300"
                                                            onkeyup="limitText('courses_description_ar' , 'courses_description_ar_char_count')"
                                                            class="form-control" rows="4"
                                                            placeholder="{{trans('landing.enter_courses_description_ar')}}"
                                                            name="courses_description_ar" dir="rtl"
                                                            id="courses_description_ar">{!! indexPage()->courses_description_ar !!}</textarea>
                                                        <div class="form-text text-warning"
                                                             id="courses_description_ar_char_count"></div>
                                                        <span class="form-text text-danger"
                                                              id="courses_description_ar_error"></span>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.courses_description_en')}}</label>
                                                        <textarea
                                                            maxlength="300"
                                                            onkeyup="limitText('courses_description_en' , 'courses_description_en_char_count')"
                                                            class="form-control" rows="4"
                                                            placeholder="{{trans('landing.enter_courses_description_en')}}"
                                                            name="courses_description_en" dir="ltr"
                                                            id="courses_description_en">{!! indexPage()->courses_description_en !!}</textarea>
                                                        <div class="form-text text-warning"
                                                             id="courses_description_en_char_count"></div>

                                                        <span class="form-text text-danger"
                                                              id="courses_description_en_error"></span>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.best_mawhobs_description_ar')}}</label>
                                                        <textarea class="form-control" rows="4"
                                                                  placeholder="{{trans('landing.enter_best_mawhobs_description_ar')}}"
                                                                  name="best_mawhobs_description_ar" dir="rtl"
                                                                  id="best_mawhobs_description_ar">{!! indexPage()->best_mawhobs_description_ar !!}</textarea>
                                                        <span class="form-text text-danger"
                                                              id="best_mawhobs_description_ar_error"></span>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.best_mawhobs_description_en')}}</label>
                                                        <textarea class="form-control" rows="4"
                                                                  placeholder="{{trans('landing.enter_best_mawhobs_description_en')}}"
                                                                  name="best_mawhobs_description_en" dir="ltr"
                                                                  id="best_mawhobs_description_en">{!! indexPage()->best_mawhobs_description_en !!}</textarea>
                                                        <span class="form-text text-danger"
                                                              id="best_mawhobs_description_en_error"></span>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!-------------------------------------------------->
                                                    <!--begin::Group-->
                                                    <div class="form-group ">
                                                        <label
                                                            class="col-xl-3 col-lg-3 col-form-label text-left">{{trans('landing.best_app_image')}}</label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <div
                                                                class="image-input image-input-outline"
                                                                id="kt_best_app_image">
                                                                <div class="image-input-wrapper"
                                                                     style="background-image: url({{asset(Storage::url(indexPage()->best_app_image))}});"></div>
                                                                <label
                                                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                                    data-action="change" data-toggle="tooltip"
                                                                    title=""
                                                                    data-original-title="{{trans('general.change_image')}}">
                                                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                                                    <input type="file" name="best_app_image"
                                                                           id="best_app_image"/>
                                                                    <input type="hidden"
                                                                           name="best_app_image_remove"/>
                                                                </label>

                                                                <span
                                                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                                    data-action="cancel" data-toggle="tooltip"
                                                                    title="Cancel avatar">
                                                                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                                 </span>
                                                            </div>
                                                            <span
                                                                class="form-text text-muted">{{trans('settings.image_format_allow')}}</span>
                                                            <span class="form-text text-danger"
                                                                  id="best_app_image_error"></span>
                                                        </div>
                                                    </div>
                                                    <!--begin::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.best_app_description_ar')}}</label>
                                                        <textarea class="form-control" rows="4"
                                                                  placeholder="{{trans('landing.enter_best_app_description_ar')}}"
                                                                  name="best_app_description_ar" dir="rtl"
                                                                  id="best_app_description_ar">{!! indexPage()->best_app_description_ar !!}</textarea>
                                                        <span class="form-text text-danger"
                                                              id="best_app_description_ar_error"></span>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.best_app_description_en')}}</label>
                                                        <textarea class="form-control" rows="4"
                                                                  placeholder="{{trans('landing.enter_best_app_description_en')}}"
                                                                  name="best_app_description_en" dir="ltr"
                                                                  id="best_app_description_en">{!! indexPage()->best_app_description_en !!}</textarea>
                                                        <span class="form-text text-danger"
                                                              id="best_app_description_en_error"></span>
                                                    </div>
                                                    <!--end::Group-->

                                                    <!-------------------------------------------------->


                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.best_courses_description_ar')}}</label>
                                                        <textarea class="form-control" rows="4"
                                                                  placeholder="{{trans('landing.enter_best_courses_description_ar')}}"
                                                                  name="best_courses_description_ar" dir="rtl"
                                                                  id="best_courses_description_ar">{!! indexPage()->best_courses_description_ar !!}</textarea>
                                                        <span class="form-text text-danger"
                                                              id="best_courses_description_ar_error"></span>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.best_courses_description_en')}}</label>
                                                        <textarea class="form-control" rows="4"
                                                                  placeholder="{{trans('landing.enter_best_courses_description_en')}}"
                                                                  name="best_courses_description_en" dir="ltr"
                                                                  id="best_courses_description_en">{!! indexPage()->best_courses_description_en !!}</textarea>
                                                        <span class="form-text text-danger"
                                                              id="best_courses_description_en_error"></span>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group ">
                                                        <label
                                                            class="col-xl-3 col-lg-3 col-form-label text-left">{{trans('landing.about_team_image')}}</label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <div
                                                                class="image-input image-input-outline"
                                                                id="kt_about_team_image">
                                                                <div class="image-input-wrapper"
                                                                     style="background-image: url({{asset(Storage::url(indexPage()->about_team_image))}});"></div>
                                                                <label
                                                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                                    data-action="change" data-toggle="tooltip"
                                                                    title=""
                                                                    data-original-title="{{trans('general.change_image')}}">
                                                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                                                    <input type="file" name="about_team_image"
                                                                           id="about_team_image"/>
                                                                    <input type="hidden"
                                                                           name="about_team_image_remove"/>
                                                                </label>

                                                                <span
                                                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                                    data-action="cancel" data-toggle="tooltip"
                                                                    title="Cancel avatar">
                                                                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                                 </span>
                                                            </div>
                                                            <span
                                                                class="form-text text-muted">{{trans('settings.image_format_allow')}}</span>
                                                            <span class="form-text text-danger"
                                                                  id="about_team_image_error"></span>
                                                        </div>
                                                    </div>
                                                    <!--begin::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.about_team_ar')}}</label>
                                                        <textarea class="form-control" rows="4"
                                                                  placeholder="{{trans('landing.enter_about_team_ar')}}"
                                                                  name="about_team_ar" dir="rtl"
                                                                  id="about_team_ar">{!! indexPage()->about_team_ar !!}</textarea>
                                                        <span class="form-text text-danger"
                                                              id="about_team_ar_error"></span>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.about_team_en')}}</label>
                                                        <textarea class="form-control" rows="4"
                                                                  placeholder="{{trans('landing.enter_about_team_en')}}"
                                                                  name="about_team_en" dir="ltr"
                                                                  id="about_team_en">{!! indexPage()->about_team_en !!}</textarea>
                                                        <span class="form-text text-danger"
                                                              id="about_team_en_error"></span>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.our_mission_ar')}}</label>
                                                        <textarea class="form-control" rows="4"
                                                                  placeholder="{{trans('landing.enter_our_mission_ar')}}"
                                                                  name="our_mission_ar" dir="rtl"
                                                                  id="our_mission_ar">{!! indexPage()->our_mission_ar !!}</textarea>
                                                        <span class="form-text text-danger"
                                                              id="our_mission_ar_error"></span>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.our_mission_en')}}</label>
                                                        <textarea class="form-control" rows="4"
                                                                  placeholder="{{trans('landing.enter_our_mission_en')}}"
                                                                  name="our_mission_en" dir="ltr"
                                                                  id="our_mission_en">{!! indexPage()->our_mission_en !!}</textarea>
                                                        <span class="form-text text-danger"
                                                              id="our_mission_en_error"></span>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label>
                                                            {{trans('landing.best_mawhobs')}}
                                                        </label>

                                                        <select class="form-control mawhobs_select_2"
                                                                multiple="multiple"
                                                                name="best_mawhobs[]" id="best_mawhobs"
                                                                style="width: 100%">

                                                        </select>
                                                        <span class="form-text text-danger"
                                                              id="best_mawhobs_error"></span>

                                                        <!--begin::body-->

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


        var about_team_image = new KTImageInput('kt_about_team_image');
        var best_app_image = new KTImageInput('kt_best_app_image');


        /////////////////////////////////////////////////////////////////////
        // Data of Select 2
        var dataSelect = [
            {
                "text": "{!! trans('general.select_from_list') !!}",
                "children": [
                        @foreach($mawhobs as $mawhob)
                    {
                        "id": "{{$mawhob->id}}",
                        "text": "{{$mawhob->mawhob_full_name }}",
                        @if(check_best_mawhob($mawhob->id))
                        "selected": true,
                        @endif
                    },
                    @endforeach
                ],
            },

        ];


        /////////////////////////////////////////////////////////////////////
        // Select 2
        $('.mawhobs_select_2').select2({
            data: dataSelect,
            placeholder: '{!! trans('general.select_from_list') !!}',
            escapeMarkup: function (markup) {
                return markup;
            },
            language: {
                inputTooShort: function () {
                    return "{!! trans('general.inputTooShort') !!}";
                },
                inputTooLong: function () {
                    return "{!! trans('general.inputTooLong') !!}";
                },
                errorLoading: function () {
                    return "{!! trans('general.errorLoading') !!}";
                },
                noResults: function () {
                    return "<span>{!! trans('general.noResults2') !!}";
                },
                searching: function () {
                    return " {!! trans('general.searching') !!}";
                }
            },
        });


        //////////////////////////////////////////////////////
        $('#form_index_page_store').on('submit', function (e) {
            e.preventDefault();
            //////////////////////////////////////////////////////////////
            $('#mawhobs_description_ar').css('border-color', '');
            $('#mawhobs_description_en').css('border-color', '');
            $('#courses_description_ar').css('border-color', '');
            $('#courses_description_en').css('border-color', '');
            $('#best_mawhobs_description_ar').css('border-color', '');
            $('#best_mawhobs_description_en').css('border-color', '');
            $('#best_app_image').css('border-color', '');
            $('#best_app_description_ar').css('border-color', '');
            $('#best_app_description_en').css('border-color', '');
            $('#best_courses_description_ar').css('border-color', '');
            $('#best_courses_description_en').css('border-color', '');
            $('#about_team_ar').css('border-color', '');
            $('#about_team_image').css('border-color', '');
            $('#about_team_en').css('border-color', '');
            $('#our_mission_ar').css('border-color', '');
            $('#our_mission_en').css('border-color', '');
            $('#best_mawhobs').css('border-color', '');


            $('#mawhobs_description_ar_error').text('');
            $('#mawhobs_description_en_error').text('');
            $('#courses_description_ar_error').text('');
            $('#courses_description_en_error').text('');
            $('#best_mawhobs_description_ar_error').text('');
            $('#best_mawhobs_description_en_error').text('');
            $('#best_app_image_error').text('');
            $('#best_app_description_ar_error').text('');
            $('#best_app_description_en_error').text('');
            $('#best_courses_description_ar_error').text('');
            $('#best_courses_description_en_error').text('');
            $('#about_team_image_error').text('');
            $('#about_team_ar_error').text('');
            $('#about_team_en_error').text('');
            $('#our_mission_ar_error').text('');
            $('#our_mission_en_error').text('');
            $('#best_mawhobs_error').text('');

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
                            customClass: {confirmButton: 'update_index_page_button'}
                        });
                        $('.update_index_page_button').click(function () {
                            $('html, body').animate({scrollTop: 5}, 300);
                            //window.location.href="{!! route('admin.index.page') !!}"

                            $('#mawhobs_description_ar_char_count').text('');
                            $('#mawhobs_description_en_char_count').text('');
                            $('#courses_description_ar_char_count').text('');
                            $('#courses_description_en_char_count').text('');
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

