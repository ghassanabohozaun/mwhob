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
                            {{trans('menu.support_center')}}
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

        <!--begin::Toolbar--
            <div class="d-flex align-items-center">
                <a href="{!! route('admin.support.center.create') !!}"
                   class="btn btn-primary btn-sm font-weight-bold font-size-base  mr-1">
                    @if(Lang()=='ar')
            <i class="fa fa-angle-double-left"></i>
@else
            <i class="fa fa-angle-double-right"></i>
@endif
        {{trans('supportCenter.send_message')}}
            </a>
&nbsp;
            </div>
            --end::Toolbar-->
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

                            <!--begin: Datatable-->
                            <div class="portlet-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="dtable scroll">
                                            <!--begin: Datatable -->
                                            <table class="table d-table" id="m_table_1">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>@lang('supportCenter.customer_name')</th>
                                                    <th>@lang('supportCenter.customer_email')</th>
                                                    <th>@lang('supportCenter.title')</th>
                                                    <th>@lang('supportCenter.status')</th>
                                                    <th>@lang('supportCenter.show_message')</th>
                                                    <th>@lang('general.actions')</th>
                                                    <th>@lang('general.delete')</th>
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
                        <form class="d-none" id="form_category_delete">
                            <input type="hidden" id="offer_category_id">
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



    <!-- begin support center message show modal -->
    <div class="modal fade" id="modal_support_center_message_show"
         data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{trans('supportCenter.show_message')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <!--begin::Card-->
                    <div class="card card-custom card-shadowless rounded-top-0">
                        <!--begin::Body-->
                        <div class="card-body p-0">

                            <div class="col-xl-12 col-xxl-10">

                                <div class="row justify-content-center">
                                    <div class="col-xl-12">


                                        <!--begin::Group-->
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">
                                                {{trans('supportCenter.title')}}
                                            </label>
                                            <div class="col-lg-9 col-xl-9">
                                                <textarea rows="2" disabled="disabled"
                                                          class="form-control form-control-lg"
                                                          name="title" id="title" type="text"
                                                          autocomplete="off"></textarea>
                                            </div>

                                        </div>
                                        <!--end::Group-->

                                        <!--begin::Group-->
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">
                                                {{trans('supportCenter.message')}}
                                            </label>
                                            <div class="col-lg-9 col-xl-9">
                                                    <textarea rows="8" disabled="disabled"
                                                              class="form-control  form-control-lg"
                                                              name="message" id="message" type="text"
                                                              autocomplete="off"></textarea>
                                            </div>

                                        </div>
                                        <!--end::Group-->

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="#" id="cancel_support_center_message_btn"
                            class="btn btn-light-primary font-weight-bold">
                        {{trans('general.cancel')}}
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- end support center message show modal -->


@endsection
@push('js')

    <script
        src="{{asset('adminBoard/assets/plugins/custom/datatables/datatables.bundle.js')}}"
        type="text/javascript"></script>
    <script src="{{asset('adminBoard/assets/js/data_table.js')}}" type="text/javascript"></script>

    <script>
        window.data_url = "{!! route('get.admin.support.center') !!}";
        window.columns = [
            {data: "id"},
            {data: "customer_name"},
            {data: "customer_email"},
            {data: "title"},
            {data: "status"},
            {data: "show_message"},
            {data: "actions"},
            {data: "delete"},
        ];

    </script>

    <script type="text/javascript">


        ////////////////////////////////////////////////////////////////////////////////
        // change message status to contacted
        $('body').on('click', '.support_center_message_status_contacted_btn', function (e) {
            e.preventDefault();
            var id = $(this).data('id');

            $.ajax({
                url: "{!! route('admin.support.center.change.status') !!}",
                type: 'post',
                data: {id: id, status: 'contacted'},
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
                            customClass: {confirmButton: 'change_message_status_button'}
                        });
                        $('.change_message_status_button').click(function () {
                            updateDataTable();
                        });
                    }
                },

            })

        });

        ////////////////////////////////////////////////////////////////////////////////
        // change message status to solved
        $('body').on('click', '.support_center_message_status_solved_btn', function (e) {
            e.preventDefault();
            var id = $(this).data('id');

            $.ajax({
                url: "{!! route('admin.support.center.change.status') !!}",
                type: 'post',
                data: {id: id, status: 'solved'},
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
                            customClass: {confirmButton: 'change_message_status_button'}
                        });
                        $('.change_message_status_button').click(function () {
                            updateDataTable();
                        });
                    }
                },

            })

        });


        ////////////////////////////////////////////////////////////////////////////////////
        //  show support center message show modal
        $(document).on('click', '.support_center_message_show_btn', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                url: "{!! route('admin.support.center.get.one.message') !!}",
                data: {id: id},
                type: 'get',
                dateType: 'json',
                success: function (data) {
                    console.log(data);
                    if (data.status == true) {
                        $('#title').val(data.data.title);
                        $('#message').val(data.data.message);
                    }
                }
            })
            $('#modal_support_center_message_show').modal('show');

        });
        ////////////////////////////////////////////////////////////////////////////////////
        //  close support center message show modal By cancel
        $('body').on('click', '#cancel_support_center_message_btn', function (e) {
            e.preventDefault();
            $('#modal_support_center_message_show').modal('hide');
        });
        ////////////////////////////////////////////////////////////////////////////////////
        //  close support center message show modal By event
        $('#modal_support_center_message_show').on('hidden.bs.modal', function (e) {
            e.preventDefault();
            $('#modal_support_center_message_show').modal('hide');
        });

        /////////////////////////////////////////////////////////////////
        ///  delete support Center Message
        $(document).on('click', '.delete_support_center_message_btn', function (e) {
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
                        url: '{!! route('admin.support.center.message.destroy') !!}',
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
                                    customClass: {confirmButton: 'delete_support_center_message_button'}
                                });
                                $('.delete_support_center_message_button').click(function () {
                                    updateDataTable();
                                });
                            } else if (data.status == false) {
                                Swal.fire({
                                    title: "{!! trans('general.deleted') !!}",
                                    text: data.msg,
                                    icon: "warning",
                                    allowOutsideClick: false,
                                    customClass: {confirmButton: 'delete_support_center_message_button'}
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
                        customClass: {confirmButton: 'cancel_delete_support_center_message_button'}
                    })
                }
            });

        })


    </script>
@endpush

@push('css')

@endpush
