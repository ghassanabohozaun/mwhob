@extends('layouts.teacher')
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
                        <a href="javascript:void(0);" class="text-muted">
                            {{trans('menu.courses')}}
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

            <!--begin::Toolbar-->
            <div class="d-flex align-items-center">
                <a href="{!! route('teacher.create.course') !!}"
                   class="btn btn-primary btn-sm font-weight-bold font-size-base  mr-1">
                    <i class="fa fa-plus-square"></i>
                    {{trans('menu.add_new_course')}}
                </a>
                &nbsp;
            </div>
            <!--end::Toolbar-->
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

                            <!--begin: search-->
                            <form class="kt-form kt-form--fit mb-15">
                                <div class="row mb-6">

                                    <!--begin::Group-->
                                    <div class="col-lg-3 mb-lg-0 mb-6">
                                        <label>
                                            {{trans('courses.category_id')}}
                                        </label>

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
                                    <!--end::Group-->

                                    <div class="col-lg-6  mb-lg-0 mb-6">
                                        <label>{!! trans('courses.date') !!}:</label>
                                        <div class="input-daterange input-group">

                                            <input type="text" class="form-control datatable-input"
                                                   id="date_from" name="date_from" autocomplete="off"
                                                   placeholder="{!! trans('general.from') !!}">

                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="la la-ellipsis-h"></i>
                                                </span>
                                            </div>

                                            <input type="text" class="form-control datatable-input"
                                                   id="date_to" name="date_to" autocomplete="off"
                                                   placeholder="{!! trans('general.to') !!}">
                                        </div>
                                    </div>

                                    <div class="col-lg-3  mb-lg-0 mb-6">
                                        <label>{!! trans('courses.active') !!}:</label>
                                        <select class="form-control datatable-input" data-col-index="6"
                                                id="active" name="active">
                                            <option value="">{!! trans('general.select_from_list') !!}</option>
                                            <option value="enable">{!! trans('general.enable') !!}</option>
                                            <option value="disable">{!! trans('general.disable') !!}</option>

                                        </select>
                                    </div>
                                </div>


                                <div class="row mt-8">
                                    <div class="col-lg-12">
                                        <button type="button" class="btn btn-primary btn-primary--icon"
                                                id="courses_search_btn">
                                            <span>
                                                <i class="la la-search"></i>
                                                <span>{!! trans('general.search') !!}</span>
                                            </span>
                                        </button>
                                        &nbsp;&nbsp;
                                        <button type="button" class="btn btn-secondary btn-secondary--icon"
                                                id="course_reset_btn">
                                            <span><i class="la la-close"></i>
                                                <span>{!! trans('general.reset') !!}
                                                </span>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <!--begin: search-->


                            <div class="portlet-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="dtable scroll">
                                            <!--begin: Datatable -->
                                            <table class="table d-table" id="my_courses_data_table">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>@lang('courses.course_image')</th>
                                                    <th>@lang('courses.title_ar')</th>
                                                    <th>@lang('courses.title_en')</th>
                                                    <th>@lang('courses.hours')</th>
                                                    <th>@lang('courses.cost')</th>
                                                    <th>@lang('courses.category_id')</th>
                                                    <th>@lang('courses.zoom_link')</th>
                                                    <th>@lang('courses.active')</th>
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

    @include('teacher.courses.modals.show-course-details')



@endsection
@push('js')

    <script
        src="{{asset('adminBoard/assets/plugins/custom/datatables/datatables.bundle.js')}}"
        type="text/javascript"></script>
    <script>

        loadData();

        function loadData(category_id = '', date_from = '', date_to = '', active = '') {
            $("#my_courses_data_table").DataTable({
                responsive: !0,
                dom: "<'row'<'col-sm-12'tr>>\n\t\t\t<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>",
                lengthMenu: [5, 10, 25, 50],
                pageLength: 10,
                language: {
                    lengthMenu: "@lang('general.show') _MENU_",
                    info: "@lang('general.entries_from') _START_ @lang('general.to') _END_ @lang('general.form') _TOTAL_",
                    infoEmpty: "@lang('general.entries_from') 0 @lang('general.to') 0 @lang('general.form') 0",
                    infoFiltered: "(@lang('filtered_from') _MAX_ @lang('general.from_entries'))",
                    processing: "@lang('general.processing')",
                    loadingRecords: "@lang('general.loadingRecords')",
                    zeroRecords: "@lang('general.not_result')",
                    emptyTable: "@lang('general.not_values')",
                    paginate: {
                        first: "@lang('general.first')",
                        previous: "@lang('general.previous')",
                        next: "@lang('general.next')",
                        last: "@lang('general.last')"
                    }
                },
                searchDelay: 500,
                processing: false,
                serverSide: false,
                select: false,
                searching: false,
                "bDestroy": true,
                order: [[0, "desc"]],
                ajax: {
                    url: '{!! route('teacher.get.courses') !!}',
                    data: {category_id: category_id, date_from: date_from, date_to: date_to, active: active},
                },
                columns: [
                    {data: "id"},
                    {data: "course_image"},
                    {data: "title_ar"},
                    {data: "title_en"},
                    {data: "hours"},
                    {data: "cost"},
                    {data: "category_id"},
                    {data: "zoom_link"},
                    {data: "active"},
                    {data: "actions"},
                ],

            });
        }

        /////////////////////////////////////////////////////////////
        // courses search btn
        $('body').on('click', '#courses_search_btn', function (e) {
            e.preventDefault();
            var category_id = $('#category_id').val();
            var active = $('#active').val();
            var date_from = $('#date_from').val();
            var date_to = $('#date_to').val();

            loadData(category_id, date_from, date_to, active);
            /////////////////////////////////////////// reset
            $('#category_id').val('');
            $('#active').val('');
            $('#date_from').val('');
            $('#date_to').val('');
        })
        ////////////////////////////////////////////// ///////////////
        // course reset btn
        $('body').on('click', '#course_reset_btn', function (e) {

            $('#category_id').val('');
            $('#active').val('');
            $('#date_from').val('');
            $('#date_to').val('');
            $('#my_courses_data_table').DataTable().ajax.reload();
        });

        /////////////////////////////////////////////////////////////////
        $('#date_from').datepicker({
            format: "yyyy-mm-dd",
            todayBtn: true,
            clearBtn: false,
            orientation: "bottom auto",
            language: "{{LaravelLocalization::getCurrentLocale()}}",
            autoclose: true,
            todayHighlight: true,
        });

        $('#date_to').datepicker({
            format: "yyyy-mm-dd",
            todayBtn: true,
            clearBtn: false,
            orientation: "bottom auto",
            language: "{{LaravelLocalization::getCurrentLocale()}}",
            autoclose: true,
            todayHighlight: true,
        });

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
                url: "{{route('teacher.course.change.status')}}",
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
                        });
                    }
                },//end success
            })
        });

        /////////////////////////////////////////////////////////////////
        // switch active
        var switchActive = false;
        $('body').on('change', '.change_active', function (e) {
            e.preventDefault();
            var id = $(this).data('id');

            if ($(this).is(':checked')) {
                switchActive = $(this).is(':checked');
            } else {
                switchActive = $(this).is(':checked');
            }

            $.ajax({
                url: "{{route('teacher.course.change.active')}}",
                data: {switchActive: switchActive, id: id},
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
                            customClass: {confirmButton: 'switch_active_toggle'}
                        });
                        $('.switch_active_toggle').click(function () {
                        });
                    }
                },//end success
            })
        });

    </script>
@endpush

@push('css')

@endpush
