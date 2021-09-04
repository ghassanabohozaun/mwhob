<!--Start:: Categories-->
<div class="col-lg-6">


    <!--begin::List Widget 14-->
    <div class="card card-custom card-stretch gutter-b">
        <!--begin::Header-->
        <div class="card-header border-0">
            <h3 class="card-title font-weight-bolder text-dark">{!! trans('teachers.categories') !!}</h3>
        </div>
        <!--end::Header-->

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <span id="teacher_categories_section">
                     <div class="table-responsive" style="overflow:auto; height: 370px">
                        @if($teacherCategories->isEmpty())
                            <img src="{!! asset('site/images/noRecordFound.svg') !!}"
                                 class="img-fluid" id="no_data_img"
                                 title="{!! trans('site.no_date') !!}">
                        @else
                            <table class="table" style="text-align: center;vertical-align: middle;">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{!! trans('teachers.category_name') !!}</th>
                                    <th>{!! trans('general.actions') !!}</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($teacherCategories as $key=>$teacherCategory)
                                    <tr>
                                        <td>
                                            {!! $key+1 !!}
                                        </td>
                                        <td>
                                            {!! $teacherCategory->category->name_ar !!}
                                        </td>
                                        <td>
                                            <a href="#"
                                               class="btn btn-sm btn-hover-danger btn-icon btn-pill
                                                delete_teacher_category_btn"
                                               data-id="{{$teacherCategory->id}}"
                                               title="{{trans('general.delete')}}">
                                                <i class="fa fa-trash fa-1x"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif

                    </div>
                   </span>
                </div>
            </div>
        </div>
    </div>
    <!--end::List Widget 14-->
</div>
<!--end::Categories-->

@push('js')



    <script type="text/javascript">
        $('body').on('click', '.delete_teacher_category_btn', function (e) {
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
                    // Delete Teacher
                    $.ajax({
                        url: '{!! route('teacher.delete.teacher.category') !!}',
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
                                    customClass: {confirmButton: 'delete_teacher_category_button'}
                                });
                                $('.delete_teacher_category_button').click(function () {
                                    $('#teacher_categories_section').load(location.href + " #teacher_categories_section");

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
                        customClass: {confirmButton: 'cancel_delete_teacher_category_button'}
                    })
                }
            });
        })
    </script>
@endpush
