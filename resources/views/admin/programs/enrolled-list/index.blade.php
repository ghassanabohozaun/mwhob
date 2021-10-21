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
                        <a href="{!! route('admin.programs') !!}" class="text-muted">
                            {{trans('menu.programs')}}
                        </a>
                    </li>

                    <li class="breadcrumb-item">
                        <a href="javascript:void(0);" class="text-muted">
                            {{trans('programs.enrolled_list')}}
                        </a>
                    </li>

                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">
                            @if(Lang()=='ar')
                                {!! $program->name_ar !!}
                            @else
                                {!! $program->name_en !!}
                            @endif
                        </a>
                    </li>
                </ul>

                <!--end::Actions-->
            </div>
            <!--end::Info-->

            <!--begin::Toolbar-->
            <div class="d-flex align-items-center">
                <a href="#" data-id="{!! $id !!}"
                   class="btn btn-primary btn-sm font-weight-bold font-size-base  mr-1 add_new_program_mawhob">
                    <i class="fa fa-plus-square"></i>
                    {{trans('programs.add_new_mawhob')}}
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
                                        <label>{!! trans('programs.search_name') !!}:</label>
                                        <input type="text" class="form-control datatable-input"
                                               name="search_name" id="search_name" autocomplete="off"
                                               placeholder="{!! trans('programs.enter_search_name') !!}">
                                    </div>
                                </div>

                                <div class="row mt-8">
                                    <div class="col-lg-12">
                                        <button type="button" class="btn btn-primary btn-primary--icon"
                                                id="enrolled_mawhob_search_btn">
                                            <span>
                                                <i class="la la-search"></i>
                                                <span>{!! trans('general.search') !!}</span>
                                            </span>
                                        </button>
                                        &nbsp;&nbsp;
                                        <button type="button" class="btn btn-secondary btn-secondary--icon"
                                                id="enrolled_mawhob_reset_btn">
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
                                            <table class="table d-table" id="my_programs_enrolled_mawhob_data_table">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>@lang('programs.mawhob_id')</th>
                                                    <th>@lang('courses.mawhob_mobile_no')</th>
                                                    <th>@lang('programs.enrolled_date')</th>
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


    <input type="hidden" value="{!! $id !!}" name="my_program_id" id="my_program_id">
    @include('admin.programs.enrolled-list.modals.add_new_mawhob')


@endsection
@push('js')

    <script
        src="{{asset('adminBoard/assets/plugins/custom/datatables/datatables.bundle.js')}}"
        type="text/javascript"></script>
    <script type="text/javascript">
        ///////////////////////////////////////////////////////////////////////////////////////
        /// load data
        loadData();


        function loadData(search_name = '') {
            var my_program_id = $('#my_program_id').val();

            $("#my_programs_enrolled_mawhob_data_table").DataTable({
                dom: "B<'row'<'col-sm-12'tr>>\n\t\t\t<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>",
                buttons: [
                    {
                        extend: 'pdfHtml5',
                        text: 'PDF',
                        footer: true,
                        title: "{!! trans('general.program_enrolled_list') !!}",
                        exportOptions: {
                            columns: ':not(:last-child)',
                        },
                    },
                    {
                        extend: 'print',
                        text: 'print',
                        footer: true,
                        title: "{!! trans('general.program_enrolled_list') !!}",
                        exportOptions: {
                            columns: ':not(:last-child)',
                        },
                    },
                    {
                        extend: 'excel',
                        text: 'excel',
                        footer: true,
                        title: "{!! trans('general.program_enrolled_list') !!}",
                        exportOptions: {
                            columns: ':not(:last-child)',
                        },
                    },
                ],

                responsive: !0,
                lengthMenu: [5, 10, 25, 50],
                pageLength: 10,
                searchDelay: 500,
                language:{
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
                    url: '{!! route('admin.get.programs.enrolled.list') !!}',
                    data: {search_name: search_name, my_program_id: my_program_id},
                },
                columns: [
                    {data: "id"},
                    {data: "mawhob_id"},
                    {data: "mawhob_mobile_no"},
                    {data: "enrolled_date"},
                    {data: "actions"},
                ],
                "bDestroy": true
            });
        }

        //////////////////////////////////////////////////////////////////////////////////////
        // enrolled mawhob search btn
        $('body').on('click', '#enrolled_mawhob_search_btn', function (e) {
            e.preventDefault();
            var search_name = $('#search_name').val();
            loadData(search_name);
            $('#search_name').val('');
        });


        //////////////////////////////////////////////////////////////////////////////////////
        // enrolled mawhob reset btn
        $('body').on('click', '#enrolled_mawhob_reset_btn', function (e) {
            $('#search_name').val('');
            loadData();
        });


        ///////////////////////////////////////////////////
        /// Delete enrolled mawhob from programs
        $(document).on('click', '.delete_mawhob_enrolled_program_btn', function (e) {
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
                    $.ajax({
                        url: '{!! route('admin.destroy.mawhob.from.program') !!}',
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
                                    customClass: {confirmButton: 'delete_enrolled_mawhob_from_program_button'}
                                });
                                $('.delete_enrolled_mawhob_from_program_button').click(function () {
                                    $('#my_programs_enrolled_mawhob_data_table').DataTable().ajax.reload();
                                });
                            }else {
                                Swal.fire({
                                    title: data.msg,
                                    text: "",
                                    icon: "warning",
                                    allowOutsideClick: false,
                                    customClass: {confirmButton: 'cannot_delete_winner_button'}
                                });
                                $('.cannot_delete_winner_button').click(function () {
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
                        customClass: {confirmButton: 'cancel_delete_enrolled_mawhob_fron_program_button'}
                    })
                }
            });

        })


    </script>
@endpush

@push('css')

@endpush
