@extends('layouts.admin')
@section('title') @endsection
@section('content')

    <form class="form" action="{{route('admin.update.contest')}}" method="POST" id="form_contest_update">
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
                            <a href="{{route('admin.contests')}}" class="text-muted">
                                {{trans('menu.contests')}}
                            </a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="" class="text-muted">
                                {{trans('contests.update_contest')}}
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
                                                    <div class="d-none form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                            ID
                                                        </label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <input value="{{$contest->id}}"
                                                                   class="form-control  form-control-lg"
                                                                   name="id" id="id" type="hidden"
                                                                   autocomplete="off"/>

                                                        </div>
                                                    </div>
                                                    <!--end::Group-->

                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                            {{trans('contests.contest_image')}}
                                                        </label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <div
                                                                class="image-input image-input-outline"
                                                                id="kt_contest_image">

                                                                <div class="image-input-wrapper"
                                                                     style="background-image: url({{asset(Storage::url($contest->contest_image))}})">
                                                                </div>
                                                                <label
                                                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                                    data-action="change" data-toggle="tooltip" title=""
                                                                    data-original-title="{{trans('general.change_image')}}">
                                                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                                                    <input type="file" name="contest_image"
                                                                           id="contest_image"
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
                                                                  id="contest_image_error"></span>
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                            {{trans('contests.end_date')}}
                                                        </label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <div class="input-group end_date">
                                                                <input type="text" class="form-control"
                                                                       id="end_date" name="end_date"
                                                                       readonly value="{!! $contest->end_date !!}"
                                                                       placeholder="{{trans('contests.enter_end_date')}}"/>
                                                                <div class="input-group-append">
                                                             <span class="input-group-text"><i
                                                                     class="la la-calendar-check-o"></i>
                                                             </span>
                                                                </div>
                                                            </div>
                                                            <span class="form-text text-danger"
                                                                  id="end_date_error"></span>
                                                        </div>
                                                        <!--end::Group-->
                                                    </div>
                                                    <!--end::Group-->

                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                            {{trans('contests.name_ar')}}
                                                        </label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <input value="{!! $contest->name_ar !!}"
                                                                   class="form-control  form-control-lg"
                                                                   name="name_ar" id="name_ar" type="text"
                                                                   placeholder=" {{trans('contests.enter_name_ar')}}"
                                                                   autocomplete="off"/>
                                                            <span class="form-text text-danger"
                                                                  id="name_ar_error"></span>
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                            {{trans('contests.name_en')}}
                                                        </label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <input value="{!! $contest->name_en !!}"
                                                                   class="form-control  form-control-lg"
                                                                   name="name_en" id="name_en" type="text"
                                                                   placeholder=" {{trans('contests.enter_name_en')}}"
                                                                   autocomplete="off"/>
                                                            <span class="form-text text-danger"
                                                                  id="name_en_error"></span>
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                            {{trans('contests.short_description_ar')}}
                                                        </label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <textarea rows="5"
                                                                      maxlength="200"
                                                                      onkeyup="limitText('short_description_ar' , 'ar_char_count')"
                                                                      class="form-control  form-control-lg"
                                                                      name="short_description_ar"
                                                                      id="short_description_ar"
                                                                      type="text"
                                                                      placeholder=" {{trans('contests.enter_short_description_ar')}}"
                                                                      autocomplete="off">{!! $contest->short_description_ar !!}</textarea>
                                                            <div class="form-text text-warning"
                                                                 id="ar_char_count"></div>

                                                            <span class="form-text text-danger"
                                                                  id="short_description_ar_error"></span>

                                                        </div>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                            {{trans('contests.short_description_en')}}
                                                        </label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <textarea rows="5"
                                                                      maxlength="200"
                                                                      onkeyup="limitText('short_description_en' , 'en_char_count')"
                                                                      class="form-control  form-control-lg"
                                                                      name="short_description_en"
                                                                      id="short_description_en"
                                                                      type="text"
                                                                      placeholder=" {{trans('contests.enter_short_description_en')}}"
                                                                      autocomplete="off">{!! $contest->short_description_en !!}</textarea>
                                                            <div class="form-text text-warning"
                                                                 id="en_char_count"></div>

                                                            <span class="form-text text-danger"
                                                                  id="short_description_en_error"></span>

                                                        </div>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                            {{trans('contests.prize')}}
                                                        </label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <input value="{!! $contest->prize !!}"
                                                                   class="form-control  form-control-lg"
                                                                   name="prize" id="prize" type="text"
                                                                   placeholder=" {{trans('contests.enter_prize')}}"
                                                                   autocomplete="off"/>
                                                            <span class="form-text text-danger"
                                                                  id="prize_error"></span>
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
        $('#end_date').datepicker({
            format: "yyyy-mm-dd",
            todayBtn: true,
            clearBtn: false,
            orientation: "bottom auto",
            language: "{{LaravelLocalization::getCurrentLocale()}}",
            autoclose: true,
            todayHighlight: true,
        });

        var contest_image = new KTImageInput('kt_contest_image');


        //////////////////////////////////////////////////////
        $('#form_contest_update').on('submit', function (e) {
            e.preventDefault();
            $.notifyClose();
            //////////////////////////////////////////////////////////////
            $('#contest_image').css('border-color', '');
            $('#name_ar').css('border-color', '');
            $('#name_en').css('border-color', '');
            $('#short_description_ar').css('border-color', '');
            $('#short_description_en').css('border-color', '');
            $('#end_date').css('border-color', '');
            $('#prize').css('border-color', '');

            $('#contest_image_error').text('');
            $('#name_ar_error').text('');
            $('#name_en_error').text('');
            $('#short_description_ar_error').text('');
            $('#short_description_en_error').text('');
            $('#end_date_error').text('');
            $('#prize_error').text('');
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
                            customClass: {confirmButton: 'update_contest_button'}
                        });
                        $('.update_contest_button').click(function () {
                            window.location.href = "{{route('admin.contests')}}";
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
