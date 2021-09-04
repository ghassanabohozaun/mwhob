<!-- begin change teacher of course Modal -->
<div class="modal fade" id="modal_change_teacher_of_course"
     data-backdrop="static" tabindex="-1" role="dialog"
     aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('courses.change_teacher')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form method="POST" action="{!! route('admin.change.teacher.of.course') !!}"
                  id="form_change_teacher_of_course"
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
                                            <label class=" col-xl-3 col-lg-3 col-form-label">
                                                ID
                                            </label>
                                            <div class="col-lg-9 col-xl-9">
                                                <input class="form-control form-control-solid form-control-lg"
                                                       name="id" id="id" type="hidden"
                                                       autocomplete="off"/>
                                            </div>

                                        </div>
                                        <!--end::Group-->

                                        <!--begin::Group-->
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">
                                                {{trans('courses.teacher_id')}}
                                            </label>
                                            <div class="col-lg-12 col-xl-12">
                                                <select class="form-control kt-select2" style="width: 100%"
                                                        id="teacher_id_select2"
                                                        name="teacher_id">
                                                    <option></option>
                                                </select>
                                                <span class="form-text text-danger"
                                                      id="teacher_id_error"></span>
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
                    <button type="#" id="cancel_change_teacher_of_course_btn"
                            class="btn btn-light-primary font-weight-bold">
                        {{trans('general.cancel')}}
                    </button>

                    <button type="submit" id="save_change_teacher_of_course_btn"
                            class="btn btn-primary font-weight-bold">
                        {{trans('general.save')}}
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
<!-- end change teacher of course Modal -->
@push('js')

    <script type="text/javascript">

        //////////////////////////////////////////////////////
        //////////////////////////////////////////////////////
        /// Teacher select2
        $('#teacher_id_select2').select2({
            minimumInputLength: 1,
            maximumInputLength: 20,
            placeholder: '{!! trans('general.select_from_list') !!}',
            allowClear: true,
            escapeMarkup: function (markup) {
                return markup;
            },
            language: {
                inputTooShort: function () {
                    return "{!! trans('general.inputTooShort') !!}";
                },
                inputTooLong: function () {
                    return "{!! trans('general.inputTooLong') !!}";
                },
                errorLoading: function () {
                    return "{!! trans('general.errorLoading') !!}";
                },
                noResults: function () {
                    return "<span>{!! trans('general.noResults2') !!}";
                },
                searching: function () {
                    return " {!! trans('general.searching') !!}";
                }
            },
            ajax: {
                url: "{!! route('admin.get.all.teacher.name') !!}",
                dataType: 'json',
                delay: 10,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.teacher_full_name,
                                id: item.id,
                            }
                        })
                    };
                },
                cache: true
            }
        });


        ////////////////////////////////////////////////////////////////////////////////////
        //  show change teacher of Course  modal
        $(document).on('click', '.change_teacher_of_course_btn', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            $('#id').val(id);
            $('#modal_change_teacher_of_course').modal('show');
            $("#teacher_id_select2").val('').trigger('change')


        });
        ////////////////////////////////////////////////////////////////////////////////////
        //  close change teacher of Course modal By cancel
        $('body').on('click', '#cancel_change_teacher_of_course_btn', function (e) {
            e.preventDefault();
            $('#modal_change_teacher_of_course').modal('hide');
            $('#form_change_teacher_of_course')[0].reset();
            $('#teacher_id_error').text('');
            $('#teacher_id').css('border-color', '');
            $("#teacher_id_select2").val('').trigger('change')
        });
        ////////////////////////////////////////////////////////////////////////////////////
        //  close change teacher of Course modal By event
        $('#modal_change_teacher_of_course').on('hidden.bs.modal', function (e) {
            e.preventDefault();
            $('#modal_change_teacher_of_course').modal('hide');
            $('#form_change_teacher_of_course')[0].reset();
            $('#teacher_id_error').text('');
            $('#teacher_id').css('border-color', '');
            $("#teacher_id_select2").val('').trigger('change')
        });
        /////////////////////////////////////////////////////////
        // change teacher of Course
        $('#form_change_teacher_of_course').on('submit', function (e) {
            e.preventDefault();

            ////////////////////////////////////////////////////
            $('#teacher_id_error').text('');
            $('#teacher_id').css('border-color', '');
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
                            customClass: {confirmButton: 'change_teacher_of_course_button'}
                        });
                        $('.change_teacher_of_course_button').click(function () {
                            $('#modal_change_teacher_of_course').modal('hide');
                            $('#my_courses_data_table').DataTable().ajax.reload();
                            $('#form_change_teacher_of_course')[0].reset();
                            $("#teacher_id_select2").val('').trigger('change')
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

    </script>
@endpush
