@extends('layouts.admin')
@section('title') @endsection
@section('content')

    <form class="form" action="{{route('admin.store.video')}}" method="POST" id="form_video_add">
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
                            <a href="{{route('admin.videos')}}" class="text-muted">
                                {{trans('menu.videos')}}
                            </a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="" class="text-muted">
                                {{trans('menu.add_new_video')}}
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
                        <div class="card card-custom card-shadowless rounded-top-0" id="card_languages_add">
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
                                                            {{trans('videos.video_image')}}
                                                        </label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <div
                                                                class="image-input image-input-outline"
                                                                id="kt_video_image">
                                                                <div class="image-input-wrapper"></div>
                                                                <label
                                                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                                    data-action="change" data-toggle="tooltip" title=""
                                                                    data-original-title="{{trans('general.change_image')}}">
                                                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                                                    <input type="file" name="video_image"
                                                                           id="video_image"
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
                                                                  id="video_image_error"></span>
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                            {{trans('videos.name_ar')}}
                                                        </label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <input
                                                                class="form-control  form-control-lg"
                                                                name="name_ar" id="name_ar" type="text"
                                                                placeholder=" {{trans('videos.enter_name_ar')}}"
                                                                autocomplete="off"/>
                                                            <span class="form-text text-danger"
                                                                  id="name_ar_error"></span>
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                            {{trans('videos.name_en')}}
                                                        </label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <input
                                                                class="form-control  form-control-lg"
                                                                name="name_en" id="name_en" type="text"
                                                                placeholder=" {{trans('videos.enter_name_en')}}"
                                                                autocomplete="off"/>
                                                            <span class="form-text text-danger"
                                                                  id="name_en_error"></span>
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                            {{trans('videos.date')}}
                                                        </label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control"
                                                                       id="date" name="date" readonly
                                                                       placeholder="{{trans('videos.enter_date')}}"/>
                                                                <div class="input-group-append">
                                                             <span class="input-group-text"><i
                                                                     class="la la-calendar-check-o"></i>
                                                             </span>
                                                                </div>
                                                            </div>
                                                            <span class="form-text text-danger"
                                                                  id="date_error"></span>
                                                        </div>
                                                        <!--end::Group-->
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                            {{trans('videos.length')}}
                                                        </label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <input
                                                                class="form-control  form-control-lg"
                                                                name="length" id="length" type="text"
                                                                placeholder=" {{trans('videos.enter_length')}}"
                                                                autocomplete="off"/>
                                                            <span class="form-text text-danger"
                                                                  id="length_error"></span>
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                            {{trans('videos.mawhobs')}}
                                                        </label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <select class="form-control mawhobs_select_2"
                                                                    multiple="multiple"
                                                                    name="mawhobs[]" id="mawhobs" style="width: 100%">

                                                                <option value=''>
                                                                    {!! trans('general.select_from_list') !!}
                                                                </option>

                                                                @foreach($mawhobs as $mawhob)
                                                                    <option value='{!! $mawhob->id !!}'>
                                                                        @if(Lang()=='ar')
                                                                            {!! $mawhob->mawhob_full_name !!}
                                                                        @else
                                                                            {!! $mawhob->mawhob_full_name_en !!}
                                                                        @endif
                                                                    </option>
                                                                @endforeach

                                                            </select>
                                                            <span class="form-text text-danger"
                                                                  id="mawhobs_error"></span>
                                                        </div>
                                                        <!--begin::body-->

                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                            {{trans('videos.video_class')}}
                                                        </label>
                                                        <div class="col-lg-9 col-md-9">
                                                            <div class="form-check pl-0 radio-inline">
                                                                <label class="radio radio-outline">
                                                                    <input type="radio" id="video_class"
                                                                           name="video_class" checked
                                                                           value="youtube"/>
                                                                    <span></span>
                                                                    {{trans('videos.youtube')}}
                                                                </label>
                                                                <label class="radio radio-outline">
                                                                    <input type="radio" id="video_class"
                                                                           name="video_class"
                                                                           value="vimeo"/>
                                                                    <span></span>
                                                                    {{trans('videos.vimeo')}}
                                                                </label>

                                                                <label class="radio radio-outline">
                                                                    <input type="radio" id="video_class"
                                                                           name="video_class"
                                                                           value="uploaded_video"/>
                                                                    <span></span>
                                                                    {{trans('videos.uploaded_video')}}
                                                                </label>

                                                            </div>
                                                        </div>
                                                        <!--begin::body-->

                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group row youtube_section">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                            {{trans('videos.youtube_link')}}
                                                        </label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <input
                                                                class="form-control form-control-lg"
                                                                name="youtube_link" id="youtube_link" type="text"
                                                                placeholder=" {{trans('videos.enter_youtube_link')}}"
                                                                autocomplete="off"/>

                                                            <span class="form-text text-muted">
                                                                {{trans('general.example')}} : &nbsp;
                                                                https://www.youtube.com/watch?v=7bOptq-NPJQ
                                                            </span>
                                                            <span class="form-text text-danger"
                                                                  id="youtube_link_error"></span>
                                                        </div>

                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group row vimeo_section">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                            {{trans('videos.vimeo_link')}}
                                                        </label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <input
                                                                class="form-control form-control-lg"
                                                                name="vimeo_link" id="vimeo_link" type="text"
                                                                placeholder=" {{trans('videos.enter_vimeo_link')}}"
                                                                autocomplete="off"/>

                                                            <span class="form-text text-muted">
                                                                {{trans('general.example')}} : &nbsp;
                                                              https://vimeo.com/232955578
                                                            </span>
                                                            <span class="form-text text-danger"
                                                                  id="vimeo_link_error"></span>
                                                        </div>

                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="upload_video_section">
                                                        <div class="form-group row">
                                                            <label class="col-xl-3 col-lg-3 col-form-label">
                                                                {{trans('videos.upload_video_link')}}
                                                            </label>
                                                            <div class="col-lg-9 col-xl-9">
                                                                <input
                                                                    class="form-control form-control-lg"
                                                                    type="file" name="upload_video_link"
                                                                    id="upload_video_link"
                                                                    placeholder=""/>
                                                                <span class="form-text text-danger"
                                                                      id="uploadStatus">
                                                                    <img
                                                                        src="{!! asset('adminBoard/images/ajax-loader.gif') !!}"/>
                                                                </span>
                                                                <span class="form-text text-danger"
                                                                      id="upload_video_link_error"></span>
                                                            </div>
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

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>


@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script type="text/javascript">


        $('.mawhobs_select_2').select2({
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
            }
        );


        ////////////////////////////////////////////////////////////////////////////////////
        $('.vimeo_section').addClass('d-none');
        $('.upload_video_section').addClass('d-none');

        $('input[type=radio][name=video_class]').change(function () {
            if (this.value == 'youtube') {
                $(".progress-bar").width('0');
                $('.youtube_section').removeClass('d-none');
                $('.vimeo_section').addClass('d-none');
                $('.upload_video_section').addClass('d-none');
            } else if (this.value == 'vimeo') {
                $(".progress-bar").width('0');
                $('.youtube_section').addClass('d-none');
                $('.vimeo_section').removeClass('d-none');
                $('.upload_video_section').addClass('d-none');
            } else if (this.value == 'uploaded_video') {
                $(".progress-bar").width('0');
                $('.youtube_section').addClass('d-none');
                $('.vimeo_section').addClass('d-none');
                $('.upload_video_section').removeClass('d-none');
            }
        });

        //////////////////////////////////////////////////////
        $('#date').datepicker({
            format: "yyyy-mm-dd",
            todayBtn: true,
            clearBtn: false,
            orientation: "bottom auto",
            language: "{{LaravelLocalization::getCurrentLocale()}}",
            autoclose: true,
            todayHighlight: true,
        });

        var video_image = new KTImageInput('kt_video_image');


        $('#uploadStatus').addClass('d-none');
        //////////////////////////////////////////////////////
        $("#form_video_add").on('submit', function (e) {
            e.preventDefault();
            //////////////////////////////////////////////////////////////
            $('#video_image').css('border-color', '');
            $('#name_ar').css('border-color', '');
            $('#name_en').css('border-color', '');
            $('#date').css('border-color', '');
            $('#length').css('border-color', '');
            $('#video_class').css('border-color', '');
            $('#vimeo_link').css('border-color', '');
            $('#youtube_link').css('border-color', '');
            $('#upload_video_link').css('border-color', '');
            $('#mawhobs').css('border-color', '');

            $('#video_image_error').text('');
            $('#name_ar_error').text('');
            $('#name_en_error').text('');
            $('#date_error').text('');
            $('#length_error').text('');
            $('#video_class_error').text('');
            $('#vimeo_link_error').text('');
            $('#youtube_link_error').text('');
            $('#upload_video_link_error').text('');
            $('#mawhobs_error').text('');
            /////////////////////////////////////////////////////////////

            var data = new FormData(this);
            var type = $(this).attr('method');
            var url = $(this).attr('action');


            $.ajax({
                xhr: function () {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function (evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = ((evt.loaded / evt.total) * 100);
                            $('#uploadStatus').removeClass('d-none');
                        }
                    }, false);
                    return xhr;
                },
                url: url,
                type: type,
                data: data,
                dataType: false,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
                    $(".progress-bar").width('0%');
                    KTApp.blockPage({
                        overlayColor: '#000000',
                        state: 'danger',
                        message: "{{trans('general.please_wait')}}",
                    });
                    $('#uploadStatus').removeClass('d-none');
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
                            customClass: {confirmButton: 'add_video_button'}
                        });
                        $('.add_video_button').click(function () {
                            window.location.href = "{{route('admin.videos')}}";
                        });
                    }
                    if (data.status == false) {
                        Swal.fire({
                            title: data.msg,
                            text: "",
                            icon: "warning",
                            allowOutsideClick: false,
                            customClass: {confirmButton: 'invalid_url_button'}
                        });
                        $('.invalid_url_button').click(function () {
                        });
                    }
                },

                error: function (reject) {
                    $('#uploadStatus').addClass('d-none');
                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function (key, value) {
                        $('#' + key + '_error').text(value[0]);
                        $('#' + key).css('border-color', 'red');
                        $('body,html').animate({scrollTop: 20}, 300);
                    });
                },
                complete: function () {
                    $('#uploadStatus').addClass('d-none');
                    KTApp.unblockPage();
                },
            })

        });//end submit


    </script>
@endpush
