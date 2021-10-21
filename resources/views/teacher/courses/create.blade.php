@extends('layouts.teacher')
@section('title') @endsection
@section('content')

    <form class="form" action="{{route('teacher.store.course')}}" method="POST" id="form_course_add">
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
                            <a href="{{route('teacher.courses')}}" class="text-muted">
                                {{trans('menu.courses')}}
                            </a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="" class="text-muted">
                                {{trans('menu.add_new_course')}}
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
                        <div class="card card-custom card-shadowless rounded-top-0">
                            <!--begin::Body-->
                            <div class="card-body p-0">
                                <div class="row justify-content-center py-8 px-8 py-lg-15 px-lg-10">
                                    <div class="col-xl-12 col-xxl-10">

                                        <div class="row justify-content-center">
                                            <div class="col-xl-9">

                                                <!--begin::body-->
                                                <div class="my-5">


                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                            {{trans('courses.course_image')}}
                                                        </label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <div
                                                                class="image-input image-input-outline"
                                                                id="kt_course_image_icon">
                                                            <!--  style="background-image: url({{--asset(Storage::url(setting()->site_icon))--}})"-->
                                                                <div class="image-input-wrapper"></div>
                                                                <label
                                                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                                    data-action="change" data-toggle="tooltip" title=""
                                                                    data-original-title="{{trans('general.change_image')}}">
                                                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                                                    <input type="file" name="course_image"
                                                                           id="course_image"
                                                                           class="table-responsive-sm">
                                                                    <input type="hidden" name="photo_remove"/>
                                                                </label>
                                                                <span data-action="cancel" data-toggle="tooltip"
                                                                      class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                                      title="Cancel avatar">
                                                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                                 </span>
                                                            </div>
                                                            <span class="form-text text-muted">
                                                                {{trans('general.image_format_allow')}}
                                                            </span>
                                                            <span class="form-text text-danger"
                                                                  id="course_image_error"></span>
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                            {{trans('courses.title_ar')}}
                                                        </label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <input
                                                                class="form-control  form-control-lg"
                                                                name="title_ar" id="title_ar" type="text"
                                                                placeholder=" {{trans('courses.enter_title_ar')}}"
                                                                autocomplete="off"/>
                                                            <span class="form-text text-danger"
                                                                  id="title_ar_error"></span>
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                            {{trans('courses.title_en')}}
                                                        </label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <input
                                                                class="form-control  form-control-lg"
                                                                name="title_en" id="title_en" type="text"
                                                                placeholder=" {{trans('courses.enter_title_en')}}"
                                                                autocomplete="off"/>
                                                            <span class="form-text text-danger"
                                                                  id="title_en_error"></span>
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                            {{trans('courses.description_ar')}}
                                                        </label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <textarea rows="5"
                                                                      maxlength="200"
                                                                      onkeyup="limitText('description_ar' , 'ar_char_count')"
                                                                      class="form-control  form-control-lg"
                                                                      name="description_ar"
                                                                      id="description_ar" type="text"
                                                                      placeholder=" {{trans('courses.enter_description_ar')}}"
                                                                      autocomplete="off"></textarea>
                                                            <div class="form-text text-warning"
                                                                 id="ar_char_count"></div>

                                                            <span class="form-text text-danger"
                                                                  id="description_ar_error"></span>
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                            {{trans('courses.description_en')}}
                                                        </label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <textarea rows="5"
                                                                      maxlength="200"
                                                                      onkeyup="limitText('description_en' , 'en_char_count')"
                                                                      class="form-control  form-control-lg"
                                                                      name="description_en"
                                                                      id="description_en" type="text"
                                                                      placeholder=" {{trans('courses.enter_description_en')}}"
                                                                      autocomplete="off"></textarea>
                                                            <div class="form-text text-warning"
                                                                 id="en_char_count"></div>

                                                            <span class="form-text text-danger"
                                                                  id="description_en_error"></span>

                                                        </div>
                                                    </div>
                                                    <!--end::Group-->

                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                            {{trans('courses.start_at')}}
                                                        </label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <div class="input-group start_at">
                                                                <input type="text" class="form-control"
                                                                       id="start_at" name="start_at"
                                                                       readonly
                                                                       placeholder="{{trans('courses.enter_start_at')}}"/>
                                                                <div class="input-group-append">
                                                             <span class="input-group-text"><i
                                                                     class="la la-calendar-check-o"></i>
                                                             </span>
                                                                </div>
                                                            </div>
                                                            <span class="form-text text-danger"
                                                                  id="start_at_error"></span>
                                                        </div>
                                                        <!--end::Group-->
                                                    </div>
                                                    <!--end::Group-->

                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                            {{trans('courses.end_at')}}
                                                        </label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <div class="input-group end_at">
                                                                <input type="text" class="form-control"
                                                                       id="end_at" name="end_at"
                                                                       readonly
                                                                       placeholder="{{trans('courses.enter_end_at')}}"/>
                                                                <div class="input-group-append">
                                                             <span class="input-group-text"><i
                                                                     class="la la-calendar-check-o"></i>
                                                             </span>
                                                                </div>
                                                            </div>
                                                            <span class="form-text text-danger"
                                                                  id="end_at_error"></span>
                                                        </div>
                                                        <!--end::Group-->
                                                    </div>
                                                    <!--end::Group-->

                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                            {{trans('courses.hours')}}
                                                        </label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <input
                                                                class="form-control  form-control-lg"
                                                                name="hours" id="hours" type="text"
                                                                placeholder=" {{trans('courses.enter_hours')}}"
                                                                autocomplete="off"/>
                                                            <span class="form-text text-danger"
                                                                  id="hours_error"></span>
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                            {{trans('courses.cost')}}
                                                        </label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <input
                                                                class="form-control  form-control-lg"
                                                                name="cost" id="cost" type="text"
                                                                placeholder=" {{trans('courses.enter_cost')}}"
                                                                autocomplete="off"/>
                                                            <span class="form-text text-danger"
                                                                  id="cost_error"></span>
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->




                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                            {{trans('courses.category_id')}}
                                                        </label>
                                                        <div class="col-lg-9 col-xl-9">

                                                            <select
                                                                class="form-control  form-control-lg"
                                                                name="category_id" id="category_id" type="text">

                                                                <option value="">
                                                                    {{trans('general.select_from_list')}}
                                                                </option>

                                                                @if($categories && $categories->count()>0)
                                                                    @foreach($categories as $category)
                                                                        <option value="{!! $category->id !!}">
                                                                            @if(Lang()=='ar')
                                                                                {!! $category->name_ar !!}
                                                                            @else
                                                                                {!! $category->name_en !!}
                                                                            @endif
                                                                        </option>
                                                                    @endforeach
                                                                @endif

                                                            </select>
                                                            <span class="form-text text-danger"
                                                                  id="category_id_error"></span>
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->

                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                            {{trans('courses.zoom_link')}}
                                                        </label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <textarea rows="3"
                                                                      class="form-control  form-control-lg"
                                                                      name="zoom_link" id="zoom_link" type="text"
                                                                      placeholder=" {{trans('courses.enter_zoom_link')}}"
                                                                      autocomplete="off"></textarea>
                                                            <span class="form-text text-danger"
                                                                  id="zoom_link_error"></span>
                                                        </div>
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
        $('#start_at').datepicker({
            format: "yyyy-mm-dd",
            todayBtn: true,
            clearBtn: false,
            orientation: "bottom auto",
            language: "{{LaravelLocalization::getCurrentLocale()}}",
            autoclose: true,
            todayHighlight: true,
        });
        //////////////////////////////////////////////////////
        $('#end_at').datepicker({
            format: "yyyy-mm-dd",
            todayBtn: true,
            clearBtn: false,
            orientation: "bottom auto",
            language: "{{LaravelLocalization::getCurrentLocale()}}",
            autoclose: true,
            todayHighlight: true,
        });
        //////////////////////////////////////////////////////

        var course_image_icon = new
        KTImageInput('kt_course_image_icon');
        //////////////////////////////////////////////////////

        $('#form_course_add').on('submit', function (e) {
            e.preventDefault();
            $.notifyClose();
            //////////////////////////////////////////////////////////////
            $('#course_image').css('border-color', '');
            $('#title_ar').css('border-color', '');
            $('#title_en').css('border-color', '');
            $('#description_ar').css('border-color', '');
            $('#description_en').css('border-color', '');
            $('#hours').css('border-color', '');
            $('#cost').css('border-color', '');
            $('#category_id').css('border-color', '');
            $('#zoom_link').css('border-color', '');
            $('#start_at').css('border-color', '');
            $('#end_at').css('border-color', '');

            $('#course_image_error').text('');
            $('#title_ar_error').text('');
            $('#title_en_error').text('');
            $('#description_ar_error').text('');
            $('#description_en_error').text('');
            $('#hours_error').text('');
            $('#cost_error').text('');
            $('#category_id_error').text('');
            $('#zoom_link_error').text('');
            $('#start_at_error').text('');
            $('#end_at_error').text('');
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
                            customClass: {confirmButton: 'add_course_button'}
                        });
                        $('.add_course_button').click(function () {
                            window.location.href = "{{route('teacher.courses')}}";
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
