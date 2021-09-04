@extends('layouts.admin')
@section('title') @endsection
@section('content')

    <form class="form" action="{{route('mowhob.store')}}" method="POST"
          id="form_mowhob_store"
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
                            <a href="{!! route('admin.mowhobs') !!}" class="text-muted">
                                {{trans('menu.mowhobs')}}
                            </a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="" class="text-muted">
                                {{trans('menu.add_new_user')}}
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
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                            {{trans('mowhob.photo')}}
                                                        </label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <div
                                                                class="image-input image-input-outline"
                                                                id="kt_mowhob_photo">
                                                            <!--  style="background-image: url({{--asset(Storage::url(setting()->site_icon))--}})"-->
                                                                <div class="image-input-wrapper"></div>
                                                                <label
                                                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                                    data-action="change" data-toggle="tooltip" title=""
                                                                    data-original-title="{{trans('general.change_image')}}">
                                                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                                                    <input type="file" name="photo" id="photo"
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
                                                                class="form-text text-muted">{{trans('general.image_format_allow')}}
                                                            </span>
                                                            <span class="form-text text-danger"
                                                                  id="photo_error"></span>
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                            {{trans('mowhob.mawhob_full_name')}}
                                                        </label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <input
                                                                class="form-control  form-control-lg"
                                                                name="mawhob_full_name" id="mawhob_full_name"
                                                                type="text"
                                                                placeholder=" {{trans('mowhob.enter_mawhob_full_name')}}"
                                                                autocomplete="off"/>
                                                            <span class="form-text text-danger"
                                                                  id="mawhob_full_name_error"></span>
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                            {{trans('mowhob.mawhob_mobile_no')}}
                                                        </label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <input
                                                                class="form-control  form-control-lg"
                                                                name="mawhob_mobile_no" id="mawhob_mobile_no"
                                                                type="text"
                                                                placeholder=" {{trans('mowhob.enter_mawhob_mobile_no')}}"
                                                                autocomplete="off"/>
                                                            <span class="form-text text-danger"
                                                                  id="mawhob_mobile_no_error"></span>
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                            {{trans('mowhob.mawhob_whatsapp_no')}}
                                                        </label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <input
                                                                class="form-control  form-control-lg"
                                                                name="mawhob_whatsapp_no" id="mawhob_whatsapp_no"
                                                                type="text"
                                                                placeholder=" {{trans('mowhob.enter_mawhob_whatsapp_no')}}"
                                                                autocomplete="off"/>
                                                            <span class="form-text text-danger"
                                                                  id="mawhob_whatsapp_no_error"></span>
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->

                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                            {{trans('mowhob.mawhob_birthday')}}
                                                        </label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <div class="input-group date">
                                                                <input type="text" class="form-control"
                                                                       id="mawhob_birthday" name="mawhob_birthday"
                                                                       readonly
                                                                       placeholder="{{trans('mowhob.enter_mawhob_birthday')}}"/>
                                                                <div class="input-group-append">
                                                             <span class="input-group-text"><i
                                                                     class="la la-calendar-check-o"></i>
                                                             </span>
                                                                </div>
                                                            </div>
                                                            <span class="form-text text-danger"
                                                                  id="mawhob_birthday_error"></span>
                                                        </div>
                                                        <!--end::Group-->
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                            {{trans('mowhob.mowhob_gender')}}
                                                        </label>
                                                        <div class="col-lg-9 col-xl-9">

                                                            <select
                                                                class="form-control form-control-lg"
                                                                name="mowhob_gender" id="mowhob_gender" type="text">
                                                                <option value="">
                                                                    {{trans('general.select_from_list')}}
                                                                </option>
                                                                <option value="male">
                                                                    {{trans('general.male')}}
                                                                </option>
                                                                <option value="female">
                                                                    {{trans('general.female')}}
                                                                </option>

                                                            </select>
                                                            <span class="form-text text-danger"
                                                                  id="mowhob_gender_error"></span>
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                            {{trans('mowhob.category_id')}}
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
                                                            {{trans('mowhob.portfolio')}}
                                                        </label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <input
                                                                class="form-control  form-control-lg"
                                                                name="portfolio" id="portfolio" type="text"
                                                                placeholder=" {{trans('mowhob.enter_portfolio')}}"
                                                                autocomplete="off"/>
                                                            <span class="form-text text-danger"
                                                                  id="portfolio_error"></span>
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
        $('#mawhob_birthday').datepicker({
            format: "yyyy-mm-dd",
            todayBtn: true,
            clearBtn: false,
            orientation: "bottom auto",
            language: "{{LaravelLocalization::getCurrentLocale()}}",
            autoclose: true,
            todayHighlight: true,
        });

        var mowhob_photo = new KTImageInput('kt_mowhob_photo');

        /////////////////////////////////////////////////////////
        // Store Mowhob
        $('#form_mowhob_store').on('submit', function (e) {
            e.preventDefault();
            ////////////////////////////////////////////////////
            $('#photo_error').text('');
            $('#mawhob_full_name_error').text('');
            $('#mawhob_mobile_no_error').text('');
            $('#mawhob_whatsapp_no_error').text('');
            $('#mawhob_birthday_error').text('');
            $('#mowhob_gender_error').text('');
            $('#category_id_error').text('');
            $('#portfolio_error').text('');

            $('#photo').css('border-color', '');
            $('#mawhob_full_name').css('border-color', '');
            $('#mawhob_mobile_no').css('border-color', '');
            $('#mawhob_whatsapp_no').css('border-color', '');
            $('#mawhob_birthday').css('border-color', '');
            $('#mowhob_gender').css('border-color', '');
            $('#category_id').css('border-color', '');
            $('#portfolio').css('border-color', '');

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
                            customClass: {confirmButton: 'add_mowhob_button'}
                        });
                        $('.add_mowhob_button').click(function () {
                            window.location.href = "{{route('admin.mowhobs')}}";
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

