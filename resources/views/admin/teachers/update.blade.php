@extends('layouts.admin')
@section('title') @endsection
@section('content')

    <form class="form" action="{{route('admin.teacher.update')}}" method="POST"
          id="form_teacher_update"
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
                            <a href="{!! route('admin.teachers') !!}" class="text-muted">
                                {{trans('menu.teachers')}}
                            </a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="" class="text-muted">
                                {{trans('teachers.update_teacher')}}
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
                                                    <div class="d-none form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                            ID
                                                        </label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <input value="{{$teacher->id}}"
                                                                   class="form-control  form-control-lg"
                                                                   name="id" id="id" type="hidden"
                                                                   autocomplete="off"/>

                                                        </div>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                            {{trans('teachers.teacher_photo')}}
                                                        </label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <div
                                                                class="image-input image-input-outline"
                                                                id="kt_teacher_photo">
                                                                @if(!$teacher->teacher_photo)
                                                                    <div class="image-input-wrapper"></div>
                                                                @else
                                                                    <div class="image-input-wrapper"
                                                                         style="background-image: url({{asset(Storage::url($teacher->teacher_photo))}})"></div>
                                                                @endif
                                                                <label
                                                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                                    data-action="change" data-toggle="tooltip" title=""
                                                                    data-original-title="{{trans('general.change_image')}}">
                                                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                                                    <input type="file" name="teacher_photo"
                                                                           id="teacher_photo"
                                                                           class="table-responsive-sm">
                                                                    <input type="hidden" name="photo_remove"/>
                                                                </label>

                                                                <span
                                                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                                    data-action="cancel" data-toggle="tooltip"
                                                                    title="Cancel avatar">
                                                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                                 </span>
                                                            </div>
                                                            <span
                                                                class="form-text text-muted">{{trans('general.image_format_allow')}}</span>
                                                            <span class="form-text text-danger"
                                                                  id="teacher_photo_error">
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                            {{trans('teachers.teacher_full_name')}}
                                                        </label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <input value="{!! $teacher->teacher_full_name !!}"
                                                                class="form-control  form-control-lg"
                                                                name="teacher_full_name" id="teacher_full_name"
                                                                type="text"
                                                                placeholder=" {{trans('teachers.enter_teacher_full_name')}}"
                                                                autocomplete="off"/>
                                                            <span class="form-text text-danger"
                                                                  id="teacher_full_name_error"></span>
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                            {{trans('teachers.teacher_full_name_en')}}
                                                        </label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <input value="{!! $teacher->teacher_full_name_en !!}"
                                                                class="form-control  form-control-lg"
                                                                name="teacher_full_name_en" id="teacher_full_name_en"
                                                                type="text"
                                                                placeholder=" {{trans('teachers.enter_teacher_full_name_en')}}"
                                                                autocomplete="off"/>
                                                            <span class="form-text text-danger"
                                                                  id="teacher_full_name_en_error"></span>
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->

                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                            {{trans('teachers.teacher_gender')}}
                                                        </label>
                                                        <div class="col-lg-9 col-xl-9">

                                                            <select
                                                                class="form-control form-control-lg"
                                                                name="teacher_gender" id="teacher_gender" type="text">
                                                                <option value="">
                                                                    {{trans('general.select_from_list')}}
                                                                </option>
                                                                <option value="male"
                                                                    {!! $teacher->teacher_gender == trans('general.male')?'selected':'' !!}>
                                                                    {{trans('general.male')}}
                                                                </option>
                                                                <option value="female"
                                                                    {!! $teacher->teacher_gender == trans('general.female')?'selected':'' !!}>
                                                                    {{trans('general.female')}}
                                                                </option>

                                                            </select>
                                                            <span class="form-text text-danger"
                                                                  id="teacher_gender_error"></span>
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->

                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                            {{trans('teachers.teacher_email')}}
                                                        </label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <input  value="{!! $teacher->teacher_email !!}"
                                                                class="form-control  form-control-lg"
                                                                name="teacher_email" id="teacher_email"
                                                                type="text" disabled="disabled"
                                                                placeholder=" {{trans('teachers.enter_teacher_email')}}"
                                                                autocomplete="off"/>
                                                            <span class="form-text text-danger"
                                                                  id="teacher_email_error"></span>
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->

                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                            {{trans('teachers.password')}}
                                                        </label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <input
                                                                class="form-control  form-control-lg"
                                                                name="password" id="password"
                                                                type="password"
                                                                placeholder="***********"
                                                                autocomplete="off"/>
                                                            <span class="form-text text-danger"
                                                                  id="password_error"></span>
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->

                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                            {{trans('teachers.teacher_bio')}}
                                                        </label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <textarea rows="5"
                                                                      class="form-control form-control-lg"
                                                                      name="teacher_bio" id="teacher_bio"
                                                                      type="text"
                                                                      placeholder=" {{trans('teachers.enter_teacher_bio')}}"
                                                                      autocomplete="off">{!! $teacher->teacher_bio !!}</textarea>
                                                            <span class="form-text text-danger"
                                                                  id="teacher_bio_error"></span>
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                            {{trans('teachers.teacher_mobile_no')}}
                                                        </label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <input value="{!! $teacher->teacher_mobile_no !!}"
                                                                class="form-control  form-control-lg"
                                                                name="teacher_mobile_no" id="teacher_mobile_no"
                                                                type="text"
                                                                placeholder=" {{trans('teachers.enter_teacher_mobile_no')}}"
                                                                autocomplete="off"/>
                                                            <span class="form-text text-danger"
                                                                  id="teacher_mobile_no_error"></span>
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                            {{trans('teachers.teacher_whatsapp_no')}}
                                                        </label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <input  value="{!! $teacher->teacher_whatsapp_no !!}"
                                                                class="form-control  form-control-lg"
                                                                name="teacher_whatsapp_no" id="teacher_whatsapp_no"
                                                                type="text"
                                                                placeholder=" {{trans('teachers.enter_teacher_whatsapp_no')}}"
                                                                autocomplete="off"/>
                                                            <span class="form-text text-danger"
                                                                  id="teacher_whatsapp_no_error"></span>
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                            {{trans('teachers.teacher_qualification')}}
                                                        </label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <input value="{!! $teacher->teacher_qualification !!}"
                                                                class="form-control  form-control-lg"
                                                                name="teacher_qualification" id="teacher_qualification"
                                                                type="text"
                                                                placeholder=" {{trans('teachers.enter_teacher_qualification')}}"
                                                                autocomplete="off"/>
                                                            <span class="form-text text-danger"
                                                                  id="teacher_qualification_error"></span>
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                            {{trans('teachers.teacher_photos_and_videos_link')}}
                                                        </label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <input value="{!! $teacher->teacher_photos_and_videos_link !!}"
                                                                class="form-control  form-control-lg"
                                                                name="teacher_photos_and_videos_link"
                                                                id="teacher_photos_and_videos_link"
                                                                type="text"
                                                                placeholder=" {{trans('teachers.enter_teacher_photos_and_videos_link')}}"
                                                                autocomplete="off"/>
                                                            <span class="form-text text-danger"
                                                                  id="teacher_photos_and_videos_link_error"></span>
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                            {{trans('teachers.teacher_cv')}}
                                                        </label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <input
                                                                class="form-control  form-control-lg"
                                                                type="file" name="teacher_cv" id="teacher_cv"
                                                                placeholder=""/>
                                                            <span class="form-text text-danger"
                                                                  id="teacher_cv_error"></span>
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->


                                                    @if($teacher->teacher_cv == null)
                                                        <div class="form-group row teacher_cv_section">
                                                            <label class="col-xl-3 col-lg-3 col-form-label">
                                                            </label>
                                                            <div class="col-lg-9 col-xl-9">
                                                                <span class="label label-danger label-inline label-lg">
                                                                   {{trans('teachers.no_cv')}}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="form-group row teacher_cv_section">
                                                            <label class="col-xl-3 col-lg-3 col-form-label">
                                                            </label>
                                                            <div class="col-lg-9 col-xl-9">
                                                                <span class="label label-dark label-inline label-lg ">
                                                                      <a href="{{Storage::url($teacher->teacher_cv) }}"
                                                                         class="text-white"
                                                                         target="_blank">
                                                                    {{trans('teachers.show_cv')}}
                                                                </a>
                                                                </span>
                                                            </div>
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
        var teacher_photo = new KTImageInput('kt_teacher_photo');
        /////////////////////////////////////////////////////////
        // Store Teacher
        $('#form_teacher_update').on('submit', function (e) {
            e.preventDefault();
            ////////////////////////////////////////////////////
            $('#teacher_photo_error').text('');
            $('#teacher_full_name_error').text('');
            $('#teacher_full_name_en_error').text('');
            $('#teacher_email_error').text('');
            $('#teacher_bio_error').text('');
            $('#password_error').text('');
            $('#teacher_mobile_no_error').text('');
            $('#teacher_whatsapp_no_error').text('');
            $('#teacher_qualification_error').text('');
            $('#teacher_cv_error').text('');
            $('#teacher_photos_and_videos_link_error').text('');
            $('#teacher_gender_error').text('');
            $('#teacher_freeze_error').text('');


            $('#teacher_photo').css('border-color', '');
            $('#teacher_full_name').css('border-color', '');
            $('#teacher_full_name_en').css('border-color', '');
            $('#teacher_email').css('border-color', '');
            $('#teacher_bio').css('border-color', '');
            $('#password').css('border-color', '');
            $('#teacher_mobile_no').css('border-color', '');
            $('#teacher_whatsapp_no').css('border-color', '');
            $('#teacher_qualification').css('border-color', '');
            $('#teacher_cv').css('border-color', '');
            $('#teacher_photos_and_videos_link').css('border-color', '');
            $('#teacher_gender').css('border-color', '');
            $('#teacher_freeze').css('border-color', '');
            ////////////////////////////////////////////////////

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
                            customClass: {confirmButton: 'update_teacher_button'}
                        });
                        $('.update_teacher_button').click(function () {
                            window.location.href = "{{route('admin.teachers')}}";
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
        })


    </script>
@endpush

