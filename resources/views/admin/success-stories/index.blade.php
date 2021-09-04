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
                            {{trans('menu.success_stories')}}
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
                <a href="{!! route('admin.trashed.stories') !!}"
                   class="btn btn-light-danger">
                    <i class="fa fa-trash"></i>
                    {{trans('general.trash')}}
                </a>
                &nbsp;
                <a href="{!! route('admin.create.story') !!}"
                   class="btn btn-primary btn-sm font-weight-bold font-size-base  mr-1">
                    <i class="fa fa-plus-square"></i>
                    {{trans('menu.add_new_success_story')}}
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
        <div class=" container-fluid ">
            <!--begin::Row-->
            <div class="row">
                <div class="col-lg-12">
                    <!--begin::Card-->
                    <div class="card card-custom" id="card_posts">
                        <div class="card-body">


                            <!--begin::Search-->
                            <form class="kt-form kt-form--fit mb-15">
                                <div class="row mb-6">

                                    <div class="col-lg-3 mb-lg-0 mb-6">
                                        <label>{!! trans('stories.search_name') !!}:</label>
                                        <input type="text" class="form-control datatable-input"
                                               name="search_name" id="search_name" autocomplete="off"
                                               placeholder="{!! trans('stories.enter_search_name') !!}">
                                    </div>

                                    <div class="col-lg-6  mb-lg-0 mb-6">
                                        <label>{!! trans('stories.date') !!}:</label>
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
                                        <label>{!! trans('stories.status') !!}:</label>
                                        <select class="form-control datatable-input" data-col-index="6"
                                                id="status" name="status">
                                            <option value="">{!! trans('general.select_from_list') !!}</option>
                                            <option value="enable">{!! trans('general.enable') !!}</option>
                                            <option value="disable">{!! trans('general.disable') !!}</option>

                                        </select>
                                    </div>
                                </div>


                                <div class="row mt-8">
                                    <div class="col-lg-12">
                                        <button type="button" class="btn btn-primary btn-primary--icon"
                                                id="story_search_btn">
                                            <span>
                                                <i class="la la-search"></i>
                                                <span>{!! trans('general.search') !!}</span>
                                            </span>
                                        </button>
                                        &nbsp;&nbsp;
                                        <button type="button" class="btn btn-secondary btn-secondary--icon"
                                                id="story_reset_btn">
                                            <span><i class="la la-close"></i>
                                                <span>{!! trans('general.reset') !!}
                                                </span>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <!--end::Search-->


                            <!--begin: Datatable-->
                            <div class="portlet-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="dtable scroll">
                                            <!--begin: Datatable -->
                                            <table class="table d-table" id="my_stories_data_table">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>@lang('stories.story_image')</th>
                                                    <th>@lang('stories.mawhob_id')</th>
                                                    <th>@lang('stories.story_category_id')</th>
                                                    <th>@lang('stories.created_at')</th>
                                                    <th>@lang('stories.about_mawhob_ar')</th>
                                                    <th>@lang('stories.about_mawhob_en')</th>
                                                    <th>@lang('stories.status')</th>
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

    @include('admin.success-stories.modals.show-story-details')


@endsection
@push('js')

    <script
        src="{{asset('adminBoard/assets/plugins/custom/datatables/datatables.bundle.js')}}"
        type="text/javascript"></script>
    <script type="text/javascript">
        ///////////////////////////////////////////////////////////////////////////////////////
        /// load data
        loadData();

        function loadData(search_name = '', status = '', date_from = '', date_to = '') {
            $("#my_stories_data_table").DataTable({
                responsive: !0,
                dom: "<'row'<'col-sm-12'tr>>\n\t\t\t<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>",
                lengthMenu: [5, 10, 25, 50],
                pageLength: 10,
                searchDelay: 500,
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
                processing: false,
                serverSide: false,
                select: false,
                searching: false,

                order: [[0, "desc"]],
                ajax: {
                    url: '{!! route('admin.get.stories') !!}',
                    data: {search_name: search_name, status: status, date_from: date_from, date_to: date_to},
                },
                columns: [
                    {data: "id"},
                    {data: "story_image"},
                    {data: "mawhob_id"},
                    {data: "story_category_id"},
                    {data: "created_at"},
                    {data: "about_mawhob_ar"},
                    {data: "about_mawhob_en"},
                    {data: "status"},
                    {data: "actions"},
                ],
                "bDestroy": true
            });
        }

        //////////////////////////////////////////////////////////////////////////////////////
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
        //////////////////////////////////////////////////////////////////////////////////////
        // story search btn
        $('body').on('click', '#story_search_btn', function (e) {
            e.preventDefault();
            var search_name = $('#search_name').val();
            var status = $('#status').val();
            var date_from = $('#date_from').val();
            var date_to = $('#date_to').val();
            loadData(search_name, status, date_from, date_to);
            $('#search_name').val('');
            $('#status').val('');
            $('#date_from').val('');
            $('#date_to').val('');

        })

        //////////////////////////////////////////////////////////////////////////////////////
        // story reset btn
        $('body').on('click', '#story_reset_btn', function (e) {
            $('#name_ar').val('');
            $('#status').val('');
            $('#date_from').val('');
            $('#date_to').val('');
            $('#my_stories_data_table').DataTable().ajax.reload();
        });


        ///////////////////////////////////////////////////
        ///  Story Delete
        $(document).on('click', '.delete_story_btn', function (e) {
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
                        url: '{!! route('admin.destroy.story') !!}',
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
                                    customClass: {confirmButton: 'delete_story_button'}
                                });
                                $('.delete_story_button').click(function () {
                                    $('#my_stories_data_table').DataTable().ajax.reload();
                                });
                            }else if (data.status == false) {
                                Swal.fire({
                                    title: "{!! trans('general.deleted') !!}",
                                    text: data.msg,
                                    icon: "warning",
                                    allowOutsideClick: false,
                                    customClass: {confirmButton: 'error_delete_story_button'}
                                });
                                $('.error_delete_story_button').click(function () {
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
                        customClass: {confirmButton: 'cancel_delete_story_button'}
                    })
                }
            });

        })

        //////////////////////////////////////////////////////////////
        // switch  story status
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
                url: "{{route('story.change.status')}}",
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

    </script>
@endpush

@push('css')

@endpush
