<!-- begin add new mawhob Modal -->
<div class="modal fade" id="modal_add_new_course_mawhob" data-backdrop="static" tabindex="-1" role="dialog"
     aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"
                    id="exampleModalLabel">{{trans('courses.add_new_mawhob')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form action="{!! route('admin.store.new.course.mawhob')!!}"
                  method="POST" enctype="multipart/form-data"
                  id="form_add_new_course_mawhob">
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
                                                <input type="hidden" class="form-control"
                                                       id="id" name="id">
                                            </div>
                                        </div>
                                        <!--end::Group-->

                                        <br/>
                                        <!--begin::Group-->
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">
                                                {{trans('courses.mawhob_id')}}
                                            </label>
                                            <div class="col-lg-9 col-xl-9">
                                                <select class="form-control"
                                                        id="mawhob_id_select2" style="width: 100%"
                                                        name="mawhob_id">
                                                    <option></option>
                                                </select>
                                                <span class="form-text text-danger"
                                                      id="mawhob_id_error"></span>
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
                    <button type="" id="cancel_add_new_course_mawhob_btn"
                            class="btn btn-light-primary font-weight-bold">
                        {{trans('general.cancel')}}
                    </button>

                    <button type="submit" id="save_add_new_course_mawhob_btn" class="btn btn-primary font-weight-bold">
                        {{trans('general.save')}}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end Renew course  Modal-->

@push('js')

    <script type="text/javascript">

        //////////////////////////////////////////////////////
        //////////////////////////////////////////////////////
        /// Teacher select2
        $('#mawhob_id_select2').select2({
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
                url: "{!! route('admin.get.all.mowhobs.name') !!}",
                dataType: 'json',
                delay: 10,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {

                            if ("{!! Lang()=='ar' !!}") {
                                return {
                                    text: item.mawhob_full_name,
                                    id: item.id,
                                }
                            } else {
                                return {
                                    text: item.mawhob_full_name_en,
                                    id: item.id,
                                }
                            }

                        })
                    };
                },
                cache: true
            }
        });


        ////////////////////////////////////////////////////
        // add new course mawhob
        $('body').on('click', '.add_new_course_mawhob', function (e) {
            e.preventDefault();
            $('#modal_add_new_course_mawhob').modal('show');
            var id = $(this).data('id');
            $('#form_add_new_course_mawhob').find('#id').val(id);
        });

        ///////////////////////////////////////////////////////////////////////////////////////////
        // close add new course mawhob  modal by cancel
        $('body').on('click', '#cancel_add_new_course_mawhob_btn', function (e) {
            e.preventDefault();
            $.notifyClose();
            $('#modal_add_new_course_mawhob').modal('hide');
            $('#form_add_new_course_mawhob')[0].reset();
            $("#mawhob_id_select2").val('').trigger('change');
            $('#mawhob_id').css('border-color', '');
            $('#mawhob_id_error').text('');
        });
        ///////////////////////////////////////////////////////////////////////////////////////////
        // Close add new course mawhob modal By event
        $('#modal_add_new_course_mawhob').on('hidden.bs.modal',
            function (e) {
                e.preventDefault();
                $.notifyClose();
                $('#modal_add_new_course_mawhob').modal('hide');
                $('#form_add_new_course_mawhob')[0].reset();
                $("#mawhob_id_select2").val('').trigger('change');
                $('#mawhob_id').css('border-color', '');
                $('#mawhob_id_error').text('');
            });

        ///////////////////////////////////////////////////////////////////////////////////////////
        /// add new course mawhob
        $('#form_add_new_course_mawhob').on('submit', function (e) {
            e.preventDefault();
            $.notifyClose();
            //////////////////////////////////////////////////////////////
            $('#mawhob_id').css('border-color', '');
            $('#mawhob_id_error').text('');
            /////////////////////////////////////////////////////////////
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
                            customClass: {confirmButton: 'add_new_course_mawhob_button'}
                        });
                        $('.add_new_course_mawhob_button').click(function () {
                            $('#modal_add_new_course_mawhob').modal('hide');
                            $('#my_courses_enrolled_mawhob_data_table').DataTable().ajax.reload();
                            $('#form_add_new_course_mawhob')[0].reset();
                            $("#mawhob_id_select2").val('').trigger('change');
                            $('#notify_section').load("{!! route('admin.get.notifications') !!}");
                            $(".notifications_count").load(location.href + " .notifications_count");
                        });
                    } else if (data.status == false) {
                        Swal.fire({
                            title: data.msg,
                            text: "",
                            icon: "warning",
                            allowOutsideClick: false,
                            customClass: {confirmButton: 'mawhob_exist_in_this_course_button'}
                        });
                        $('.mawhob_exist_in_this_course_button').click(function () {
                            $('#modal_add_new_course_mawhob').modal('hide');
                            $('#form_add_new_course_mawhob')[0].reset();
                            $("#mawhob_id_select2").val('').trigger('change');

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

        });//end submit


    </script>
@endpush
