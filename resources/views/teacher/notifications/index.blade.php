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


                            <div class="portlet-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="dtable scroll">
                                            <!--begin: Datatable -->
                                            <table class="table d-table" id="m_table_1">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>@lang('notifications.title_ar')</th>
                                                    <th>@lang('notifications.title_en')</th>
                                                    <th>@lang('notifications.details_ar')</th>
                                                    <th>@lang('notifications.details_en')</th>
                                                    <th>@lang('notifications.date')</th>
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
        window.data_url = "{!! route('get.teacher.notifications.resource') !!}";
        window.columns = [
            {data: "id"},
            {data: "title_ar"},
            {data: "title_en"},
            {data: "details_ar"},
            {data: "details_en"},
            {data: "date"},
            {data: "actions"},
        ];
    </script>

    <script type="text/javascript">
        /////////////////////////////////////////////////////////////
        // read Notification
        $('body').on('click', '.read_teacher_notification_btn', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                url: "{!! route('teacher.notification.make.read') !!}",
                type: "post",
                data: {id, id},
                dataType: "JSON",
                success: function (data) {
                    console.log(data);
                    $('#m_table_1').DataTable().ajax.reload();
                    $('#notify_section').load("{!! route('teacher.get.notifications') !!}");
                    $(".notifications_count").load(location.href + " .notifications_count");
                }
            })
        });
    </script>
@endpush
