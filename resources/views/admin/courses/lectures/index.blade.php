@extends('layouts.admin')
@section('title') @endsection
@section('content')

    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div
            class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">

                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <!--begin::Actions-->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">

                    <li class="breadcrumb-item">
                        <a href="{!! route('admin.courses') !!}" class="text-muted">
                            {{trans('menu.courses')}}
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0);" class="text-muted">
                            @if(Lang()=='ar')
                                {!! App\Models\Course::find($id)->title_ar !!}
                            @else
                                {!! App\Models\Course::find($id)->title_en !!}
                            @endif
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0);" class="text-muted">
                            {{trans('courses.lectures')}}
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">
                            {{trans('menu.show_all')}}
                        </a>
                    </li>
                </ul>

                <!--end::Actions-->
            </div>
            <!--end::Info-->

        </div>
    </div>
    <!--end::Subheader-->

    <!--begin::content-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class=" container">
            <!--begin::Row-->
            <div class="row">
                <div class="col-lg-12">
                    <!--begin::Card-->
                    <div class="card card-custom" id="card_posts">
                        <div class="card-body">

                            <form class="form" action="{{route('admin.store.lecture')}}"
                                  method="POST" id="form_lecture_add">

                                <!--begin::Group-->
                                <div class="d-none form-group row">
                                    <div class="col-lg-12 col-xl-12">
                                        <input value="{{$id}}"
                                               class="form-control  form-control-lg"
                                               name="id" id="id" type="hidden"
                                               autocomplete="off"/>

                                    </div>
                                </div>
                                <!--end::Group-->

                                <!--begin::Group-->
                                <div class="form-group row">


                                    <div class="col-lg-4">
                                        <label class="col-xl-9 col-lg-9 col-form-label">
                                            {{trans('courses.lecture_date')}}
                                        </label>
                                        <div class="col-lg-12 col-xl-12">
                                            <input
                                                class="form-control  form-control-lg"
                                                name="lecture_date" id="lecture_date" type="text"
                                                placeholder=" {{trans('courses.enter_lecture_date')}}"
                                                autocomplete="off"/>
                                            <span class="form-text text-danger"
                                                  id="lecture_date_error"></span>
                                        </div>
                                    </div>


                                    <div class="col-lg-4">
                                        <label class="col-xl-9 col-lg-9 col-form-label">
                                            {{trans('courses.lecture_from')}}
                                        </label>
                                        <div class="col-lg-12 col-xl-12">
                                            <input value="09:00:00"
                                                   class="form-control  form-control-lg"
                                                   name="lecture_from" id="lecture_from" type="time"
                                                   placeholder=" {{trans('courses.enter_lecture_from')}}"
                                                   autocomplete="off"/>
                                            <span class="form-text text-danger"
                                                  id="lecture_from_error"></span>
                                        </div>
                                    </div>


                                    <div class="col-lg-4">
                                        <label class="col-xl-9 col-lg-9 col-form-label">
                                            {{trans('courses.lecture_to')}}
                                        </label>
                                        <div class="col-lg-12 col-xl-12">
                                            <input value="09:00:00"
                                                   class="form-control  form-control-lg"
                                                   name="lecture_to" id="lecture_to" type="time"
                                                   placeholder=" {{trans('courses.enter_lecture_to')}}"
                                                   autocomplete="off"/>
                                            <span class="form-text text-danger"
                                                  id="lecture_to_error"></span>
                                        </div>
                                    </div>

                                </div>
                                <!--end::Group-->


                                <div class="col-lg-12 col-xl-12">
                                    <button type="submit"
                                            class="btn btn-primary btn-sm font-weight-bold font-size-base  mr-1">
                                        <i class="fa fa-save"></i>
                                        {{trans('general.save')}}
                                    </button>
                                </div>
                            </form>


                            <div class="portlet-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="dtable scroll">
                                            <!--begin: Datatable -->
                                            <table class="table d-table" id="m_table_1">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>@lang('courses.lecture_date')</th>
                                                    <th>@lang('courses.lecture_from')</th>
                                                    <th>@lang('courses.lecture_to')</th>
                                                    <th>@lang('courses.status')</th>
                                                    <th>@lang('courses.lecture_cancel')</th>
                                                    <th>@lang('general.actions')</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end: Datatable-->

                        </div>

                    </div>
                    <!--end::Card-->
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->

        <!--begin::Form-->
    </div>
    <!--end::content-->

@endsection
@push('js')

    <script
        src="{{asset('adminBoard/assets/plugins/custom/datatables/datatables.bundle.js')}}"
        type="text/javascript"></script>
    <script src="{{asset('adminBoard/assets/js/data_table.js')}}" type="text/javascript"></script>

    <script>
        window.data_url = "{!! route('admin.get.lectures',$id) !!}";
        window.columns = [
            {data: "id"},
            {data: "lecture_date"},
            {data: "lecture_from"},
            {data: "lecture_to"},
            {data: "status"},
            {data: "lecture_cancel"},
            {data: "actions"},
        ];

        /////////////////////////////////////////////////////////////////
        $('#lecture_date').datepicker({
            format: "yyyy-mm-dd",
            todayBtn: true,
            clearBtn: false,
            orientation: "bottom auto",
            language: "{{ LaravelLocalization::getCurrentLocale()}}",
            autoclose: true,
            todayHighlight: true,
        });

        /////////////////////////////////////////////////////////////////
        ///  lecture Delete
        $("#form_lecture_add").on('submit', function (e) {
            e.preventDefault();
            //////////////////////////////////////////////////////////////
            $('#lecture_date').css('border-color', '');
            $('#lecture_from').css('border-color', '');
            $('#lecture_to').css('border-color', '');

            $('#lecture_date_error').text('');
            $('#lecture_from_error').text('');
            $('#lecture_to_error').text('');
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
                            customClass: {confirmButton: 'add_lecture_button'}
                        });
                        $('.add_lecture_button').click(function () {
                            updateDataTable();
                            $("#form_lecture_add")[0].reset();
                        });
                    } else if (data.status == false) {
                        Swal.fire({
                            title: data.msg,
                            text: "",
                            icon: "warning",
                            allowOutsideClick: false,
                            customClass: {confirmButton: 'add_error_lecture_button'}
                        });
                        $('.add_error_lecture_button').click(function () {
                            $("#form_lecture_add")[0].reset();
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
                    KTApp.unblockPage();
                },
            })

        });//end submit

        /////////////////////////////////////////////////////////////////
        ///  lecture Delete
        $(document).on('click', '.delete_lecture_btn', function (e) {
            e.preventDefault();
            var id = $(this).data('id');

            Swal.fire({
                title: "{{trans('general.ask_delete_record')}}",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "{{trans('general.yes')}}",
                cancelButtonText: "{{trans('general.no')}}",
                reverseButtons: false,
                allowOutsideClick: false,
            }).then(function (result) {
                if (result.value) {
                    //////////////////////////////////////
                    // Delete User
                    $.ajax({
                        url: '{!! route('admin.destroy.lecture') !!}',
                        data: {id, id},
                        type: 'post',
                        dataType: 'json',
                        success: function (data) {
                            console.log(data);
                            if (data.status == true) {
                                Swal.fire({
                                    title: "{!! trans('general.deleted') !!}",
                                    text: data.msg,
                                    icon: "success",
                                    allowOutsideClick: false,
                                    customClass: {confirmButton: 'delete_course_button'}
                                });
                                $('.delete_course_button').click(function () {
                                    updateDataTable();
                                });
                            } else if (data.status == false) {
                                Swal.fire({
                                    title: "{!! trans('general.deleted') !!}",
                                    text: data.msg,
                                    icon: "warning",
                                    allowOutsideClick: false,
                                    customClass: {confirmButton: 'delete_course_button'}
                                });
                                $('.delete_course_button').click(function () {
                                });
                            }
                        },//end success
                    });

                } else if (result.dismiss === "cancel") {
                    Swal.fire({
                        title: "{!! trans('general.cancelled') !!}",
                        text: "{!! trans('general.cancelled_message') !!}",
                        icon: "error",
                        allowOutsideClick: false,
                        customClass: {confirmButton: 'cancel_delete_course_button'}
                    })
                }
            });

        })

        /////////////////////////////////////////////////////////////////
        // switch status
        var switchStatus = false;
        $('body').on('change', '.change_status', function (e) {
            e.preventDefault();

            var id = $(this).data('id');

            if ($(this).is(':checked')) {
                switchStatus = $(this).is(':checked');
            } else {
                switchStatus = $(this).is(':checked');
            }

            $.ajax({
                url: "{{route('admin.lecture.change.status')}}",
                data: {switchStatus: switchStatus, id: id},
                type: 'post',
                dataType: 'JSON',
                beforeSend: function () {
                    KTApp.blockPage({
                        overlayColor: '#000000',
                        state: 'danger',
                        message: "{{trans('general.please_wait')}}",
                    });
                },//end beforeSend
                success: function (data) {
                    KTApp.unblockPage();
                    console.log(data);
                    if (data.status == true) {
                        Swal.fire({
                            title: data.msg,
                            text: "",
                            icon: "success",
                            allowOutsideClick: false,
                            customClass: {confirmButton: 'switch_status_toggle'}
                        });
                        $('.switch_status_toggle').click(function () {
                            updateDataTable();
                        });
                    }
                },//end success
            })
        });


        /////////////////////////////////////////////////////////////////
        // lecture Cancel
        var lectureCancel = false;
        $('body').on('change', '.change_lecture_cancel', function (e) {
            e.preventDefault();

            var id = $(this).data('id');

            if ($(this).is(':checked')) {
                lectureCancel = $(this).is(':checked');
            } else {
                lectureCancel = $(this).is(':checked');
            }

            $.ajax({
                url: "{{route('admin.lecture.cancel')}}",
                data: {lectureCancel: lectureCancel, id: id},
                type: 'post',
                dataType: 'JSON',
                beforeSend: function () {
                    KTApp.blockPage({
                        overlayColor: '#000000',
                        state: 'danger',
                        message: "{{trans('general.please_wait')}}",
                    });
                },//end beforeSend
                success: function (data) {
                    KTApp.unblockPage();
                    console.log(data);
                    if (data.status == true) {
                        Swal.fire({
                            title: data.msg,
                            text: "",
                            icon: "success",
                            allowOutsideClick: false,
                            customClass: {confirmButton: 'switch_status_toggle'}
                        });
                        $('.switch_status_toggle').click(function () {
                            updateDataTable();
                        });
                    }
                },//end success
            })
        });

    </script>
@endpush

@push('css')

@endpush
