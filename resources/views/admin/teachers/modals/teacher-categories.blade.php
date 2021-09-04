<!-- begin teacher Categories Show Modal -->
<div class="modal fade" id="modal_teacher_categories"
     data-backdrop="static" tabindex="-1" role="dialog"
     aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('teachers.teacher_categories')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form method="POST" action="{!! route('admin.teacher.add.category') !!}"
                  id="form_teacher_categories"
                  enctype="multipart/form-data">
                @csrf

                <div class="modal-body">

                    <!--begin::Card-->
                    <div class="card card-custom card-shadowless rounded-top-0">
                        <!--begin::Body-->
                        <div class="card-body p-0">

                            <div class="col-xl-12 col-xxl-10">

                                <div class="row justify-content-center">
                                    <div class="col-xl-12">

                                        <!--begin::Group-->
                                        <div class="d-none form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">
                                                ID
                                            </label>
                                            <div class="col-lg-9 col-xl-9">
                                                <input class="form-control form-control-solid form-control-lg"
                                                       name="teacher_category_id" id="teacher_category_id" type="hidden"
                                                       autocomplete="off"/>
                                            </div>
                                        </div>
                                        <!--end::Group-->

                                        <!--begin::Group-->
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">
                                                {{trans('teachers.categories')}}
                                            </label>
                                            <div class="col-lg-9 col-xl-9">

                                                <select
                                                    class="form-control  form-control-lg category_id"
                                                    name="category_id" id="category_id" type="text">
                                                    <option value="">
                                                        {{trans('general.select_from_list')}}
                                                    </option>
                                                </select>
                                                <span class="form-text text-danger"
                                                      id="category_id_error"></span>
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
                    <button type="#" id="cancel_teacher_categories_btn"
                            class="btn btn-light-primary font-weight-bold">
                        {{trans('general.cancel')}}
                    </button>

                    <button type="submit" id="save_teacher_categories_btn"
                            class="btn btn-primary font-weight-bold">
                        {{trans('general.save')}}
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
<!-- end teacher Categories  show Modal-->

@push('js')

    <script type="text/javascript">
        ////////////////////////////////////////////////////////////////////////////////////
        //  show  teacher Categories  modal
        $(document).on('click', '.teacher_categories_btn', function (e) {
            e.preventDefault();
            var teacher_id = $(this).data('id');
            $('#teacher_category_id').val(teacher_id);

            $.ajax({
                url: "{!! route('admin.get.all.categories') !!}",
                type: 'GET',
                dataType: 'json', // added data type
                success: function (data) {
                    console.log(data);
                    $('#category_id').empty();

                    $('#category_id').append($('<option>', {
                        value: '',
                        text: "{!! trans('general.select_from_list') !!}",
                    }));
                    $.each(data.data, function (i, level) {
                        $('#category_id').append($('<option>', {
                            value: level.id,
                            text: level.name_ar,
                        }));
                    });
                }
            });

            $('#modal_teacher_categories').modal('show');
        });


        ////////////////////////////////////////////////////////////////////////////////////
        //  close teacher Categories modal By cancel
        $('body').on('click', '#cancel_teacher_categories_btn', function (e) {
            e.preventDefault();
            $('#modal_teacher_categories').modal('hide');
            $('#form_teacher_categories')[0].reset();
            $('#category_id_error').text('');
            $('#category_id').css('border-color', '');
        });
        ////////////////////////////////////////////////////////////////////////////////////
        //  close teacher Categories modal By event
        $('#modal_teacher_categories').on('hidden.bs.modal', function (e) {
            e.preventDefault();
            $('#modal_teacher_categories').modal('hide');
            $('#form_teacher_categories')[0].reset();
            $('#category_id_error').text('');
            $('#category_id').css('border-color', '');
        });

        /////////////////////////////////////////////////////////
        //  Teacher Categories
        $('#form_teacher_categories').on('submit', function (e) {
            e.preventDefault();
            var teacher_id = $('#teacher_category_id').val();
            ////////////////////////////////////////////////////
            $('#category_id_error').text('');
            $('#category_id').css('border-color', '');
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
                            customClass: {confirmButton: 'teacher_categories_button'}
                        });
                        $('.teacher_categories_button').click(function () {
                            $('#modal_teacher_categories').modal('hide');
                            $('#form_teacher_categories')[0].reset();
                        });
                    }

                    if (data.status == false) {
                        Swal.fire({
                            title: data.msg,
                            text: "",
                            icon: "error",
                            allowOutsideClick: false,
                            customClass: {confirmButton: 'error_teacher_categories_button'}
                        });
                        $('.error_teacher_categories_button').click(function () {
                            FillCategoriesTable(teacher_id);
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

        /////////////////////////////////////////////////////////
        //  Fill Categories Table
        function FillCategoriesTable(teacher_id=null){
            $.ajax({
                url: "{!! route('admin.teacher.get.all.teacher.categories') !!}",
                data: {teacher_id: teacher_id},
                type: 'GET',
                dataType: 'json', // added data type
                success: function (data) {
                    console.log(data);
                    $('#teacher_categories_section').empty();
                    var trHTML = '';
                    if({!! Lang()=='ar' !!}){
                        $.each(data, function (i, item) {
                            trHTML += '<tr><td>' + i + '</td><td>' + item.category.name_ar + '</td></tr>';
                        });
                    }else{
                        $.each(data, function (i, item) {
                            trHTML += '<tr><td>' + i + '</td><td>' + item.category.name_en + '</td></tr>';
                        });
                    }



                    $('#teacher_categories_section').append(trHTML);
                }

            });
        }
    </script>
@endpush
