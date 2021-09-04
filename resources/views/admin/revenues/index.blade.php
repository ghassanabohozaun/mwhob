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
                        <a href="javascript:void(0);" class="text-muted">
                            {{trans('menu.revenues')}}
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

                            <!--begin: search-->
                            <form class="kt-form kt-form--fit mb-15">
                                <div class="row mb-6">

                                    <div class="col-lg-3 mb-lg-0 mb-6">
                                        <label>{!! trans('courses.search_name') !!}:</label>
                                        <input type="text" class="form-control datatable-input"
                                               name="search_name" id="search_name" autocomplete="off"
                                               placeholder="{!! trans('courses.enter_search_name') !!}">
                                    </div>

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

                                </div>


                                <div class="row mt-8">
                                    <div class="col-lg-12">
                                        <button type="button" class="btn btn-primary btn-primary--icon"
                                                id="revenues_search_btn">
                                            <span>
                                                <i class="la la-search"></i>
                                                <span>{!! trans('general.search') !!}</span>
                                            </span>
                                        </button>
                                        &nbsp;&nbsp;
                                        <button type="button" class="btn btn-secondary btn-secondary--icon"
                                                id="revenues_reset_btn">
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
                                            <table class="table d-table" id="my_revenues_data_table">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>@lang('revenues.mawhob_id')</th>
                                                    <th>@lang('revenues.value')</th>
                                                    <th>@lang('revenues.date')</th>
                                                    <th>@lang('revenues.details')</th>
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
    <script>

        loadData();

        function loadData(search_name = '', date_from = '', date_to = '') {
            $("#my_revenues_data_table").DataTable({
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
                    url: '{!! route('admin.get.revenues') !!}',
                    data: {search_name: search_name, date_from: date_from, date_to: date_to},
                },
                columns: [
                    {data: "id"},
                    {data: "mawhob_id"},
                    {data: "value"},
                    {data: "date"},
                    {data: "details"},
                ],

            });
        }

        /////////////////////////////////////////////////////////////
        // courses search btn
        $('body').on('click', '#revenues_search_btn', function (e) {
            e.preventDefault();
            var search_name = $('#search_name').val();
            var date_from = $('#date_from').val();
            var date_to = $('#date_to').val();

            loadData(search_name, date_from, date_to);
            /////////////////////////////////////////// reset
            $('#search_name').val('');
            $('#date_from').val('');
            $('#date_to').val('');
        })
        ////////////////////////////////////////////// ///////////////
        // course reset btn
        $('body').on('click', '#revenues_reset_btn', function (e) {
            $('#name_ar').val('');
            $('#date_from').val('');
            $('#date_to').val('');
            $('#my_revenues_data_table').DataTable().ajax.reload();
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

    </script>
@endpush

@push('css')

@endpush
