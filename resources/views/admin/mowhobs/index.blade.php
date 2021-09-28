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
                            {{trans('menu.mowhobs')}}
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
                <a href="{!! route('mowhobs.trashed') !!}"
                   class="btn btn-light-danger trash_btn" title="{{trans('general.trash')}}">
                    <i class="fa fa-trash"></i>
                </a>
                &nbsp;
                <a href="{!! route('mowhob.create') !!}"
                   class="btn btn-primary btn-sm font-weight-bold font-size-base  mr-1">
                    <i class="fa fa-plus-square"></i>
                    {{trans('menu.add_new_mowhob')}}
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

                            <!--begin: search-->
                            <form class="kt-form kt-form--fit mb-15">
                                <div class="row mb-6">

                                    <div class="col-lg-3 mb-lg-0 mb-6">
                                        <label>{!! trans('mowhob.search_name') !!}:</label>
                                        <input type="text" class="form-control datatable-input"
                                               name="search_name" id="search_name" autocomplete="off"
                                               placeholder="{!! trans('mowhob.enter_search_name') !!}">
                                    </div>

                                    <div class="col-lg-3  mb-lg-0 mb-6">
                                        <label>{!! trans('mowhob.category_id') !!}:</label>
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
                                    </div>

                                    <div class="col-lg-3  mb-lg-0 mb-6">
                                        <label>{!! trans('mowhob.status') !!}:</label>
                                        <select class="form-control datatable-input" data-col-index="6"
                                                id="status" name="status">
                                            <option value="">{!! trans('general.select_from_list') !!}</option>
                                            <option value="active">{!! trans('mowhob.active') !!}</option>
                                            <option value="frozen">{!! trans('mowhob.frozen') !!}</option>

                                        </select>
                                    </div>


                                </div>


                                <div class="row mt-8">
                                    <div class="col-lg-12">
                                        <button type="button" class="btn btn-primary btn-primary--icon"
                                                id="mawhob_search_btn">
                                            <span>
                                                <i class="la la-search"></i>
                                                <span>{!! trans('general.search') !!}</span>
                                            </span>
                                        </button>
                                        &nbsp;&nbsp;
                                        <button type="button" class="btn btn-secondary btn-secondary--icon"
                                                id="mawhob_reset_btn">
                                            <span><i class="la la-close"></i>
                                                <span>{!! trans('general.reset') !!}
                                                </span>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <!--begin: search-->


                            <!--begin: Datatable-->
                            <div class="portlet-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="dtable scroll">
                                            <!--begin: Datatable -->
                                            <table class="table d-table" id="my_mawhobs_data_table">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>@lang('mowhob.photo')</th>
                                                    <th>@lang('mowhob.mawhob_full_name')</th>
                                                    <th>@lang('mowhob.mawhob_full_name_en')</th>
                                                    <th>@lang('mowhob.mawhob_mobile_no')</th>
                                                    <th>@lang('mowhob.mawhob_whatsapp_no')</th>
                                                    <th>@lang('mowhob.mawhob_birthday')</th>
                                                    <th>@lang('mowhob.category_id')</th>
                                                    <th>@lang('mowhob.portfolio')</th>
                                                    <th>@lang('mowhob.freeze')</th>
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

                        <form class="d-none" id="form_user_delete">
                            <input type="text" id="user_delete_id">
                        </form>
                        <!--end::Form-->

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

    <script type="text/javascript">


        loadData();

        function loadData(search_name = '', category_id = '', status = '') {
            $("#my_mawhobs_data_table").DataTable({
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
                    url: '{!! route('get.mowhobs') !!}',
                    data: {search_name: search_name, category_id: category_id, status: status},
                },
                columns: [
                    {data: "id"},
                    {data: "photo"},
                    {data: "mawhob_full_name"},
                    {data: "mawhob_full_name_en"},
                    {data: "mawhob_mobile_no"},
                    {data: "mawhob_whatsapp_no"},
                    {data: "mawhob_birthday"},
                    {data: "category_id"},
                    {data: "portfolio"},
                    {data: "freeze"},
                    {data: "actions"}
                ],
            });
        }

        /////////////////////////////////////////////////////////////
        // courses search btn
        $('body').on('click', '#mawhob_search_btn', function (e) {
            e.preventDefault();
            var search_name = $('#search_name').val();
            var status = $('#status').val();
            var category_id = $('#category_id').val();

            loadData(search_name, category_id,status);
            /////////////////////////////////////////// reset
            $('#search_name').val('');
            $('#status').val('');
            $('#category_id').val('');
        })
        ////////////////////////////////////////////// ///////////////
        // mawhob reset btn
        $('body').on('click', '#mawhob_reset_btn', function (e) {

            $('#search_name').val('');
            $('#status').val('')
            $('#category_id').val('');
            loadData();
        });

        ///////////////////////////////////////////////////
        /// delete mowhob
        $(document).on('click', '.delete_mowhob_btn', function (e) {
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
                    // Delete Mowhob
                    $.ajax({
                        url: '{!! route('mowhob.destroy') !!}',
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
                                    customClass: {confirmButton: 'delete_mowhob_button'}
                                });
                                $('.delete_mowhob_button').click(function () {
                                    $('#my_mawhobs_data_table').DataTable().ajax.reload();
                                });
                            } else if (data.status == false) {
                                Swal.fire({
                                    title: "{!! trans('general.deleted') !!}",
                                    text: data.msg,
                                    icon: "warning",
                                    allowOutsideClick: false,
                                    customClass: {confirmButton: 'delete_mowhob_button'}
                                });
                                $('.delete_mowhob_button').click(function () {
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
                        customClass: {confirmButton: 'cancel_delete_mowhob_button'}
                    })
                }
            });

        })


        // switch english language
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
                url: "{{route('mowhob.change.status')}}",
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
                            $('#my_mawhobs_data_table').DataTable().ajax.reload();
                        });
                    }
                },//end success
            })
        });


    </script>
@endpush

