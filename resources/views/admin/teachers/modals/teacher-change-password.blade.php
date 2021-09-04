<!-- begin communication request message show Modal -->
<div class="modal fade" id="modal_teacher_change_password"
     data-backdrop="static" tabindex="-1" role="dialog"
     aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('teachers.change_password')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form method="POST" action="{!! route('admin.teacher.change.password') !!}"
                  id="form_teacher_change_password"
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
                                        <div class="form-group row">
                                            <label class="d-none col-xl-3 col-lg-3 col-form-label">
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
                                                {{trans('teachers.password')}}
                                            </label>
                                            <div class="col-lg-9 col-xl-9">
                                                <input
                                                    class="form-control form-control-lg"
                                                    name="password" id="password" type="password"
                                                    placeholder="*********"
                                                    autocomplete="off"/>
                                                <span class="form-text text-danger"
                                                      id="password_error"></span>
                                            </div>

                                        </div>
                                        <!--end::Group-->

                                        <!--begin::Group-->
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">
                                                {{trans('teachers.confirm_password')}}
                                            </label>
                                            <div class="col-lg-9 col-xl-9">
                                                <input
                                                    class="form-control form-control-lg"
                                                    name="confirm_password" id="confirm_password"
                                                    type="password" placeholder="*********"
                                                    autocomplete="off"/>
                                                <span class="form-text text-danger"
                                                      id="confirm_password_error"></span>

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
                    <button type="#" id="cancel_teacher_change_password_btn"
                            class="btn btn-light-primary font-weight-bold">
                        {{trans('general.cancel')}}
                    </button>

                    <button type="submit" id="save_teacher_change_password_btn"
                            class="btn btn-primary font-weight-bold">
                        {{trans('general.save')}}
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
<!-- end communication request message show Modal-->

@push('js')

    <script type="text/javascript">
        ////////////////////////////////////////////////////////////////////////////////////
        //  show change teacher password  modal
        $(document).on('click', '.teacher_change_password_btn', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            $('#id').val(id);
            $('#modal_teacher_change_password').modal('show');

        });
        ////////////////////////////////////////////////////////////////////////////////////
        //  close change teacher password modal By cancel
        $('body').on('click', '#cancel_teacher_change_password_btn', function (e) {
            e.preventDefault();
            $('#modal_teacher_change_password').modal('hide');
            $('#form_teacher_change_password')[0].reset();
            $('#password_error').text('');
            $('#confirm_password_error').text('');
            $('#password').css('border-color', '');
            $('#confirm_password').css('border-color', '');
        });
        ////////////////////////////////////////////////////////////////////////////////////
        //  close change teacher password modal By event
        $('#modal_teacher_change_password').on('hidden.bs.modal', function (e) {
            e.preventDefault();
            $('#modal_teacher_change_password').modal('hide');
            $('#form_teacher_change_password')[0].reset();
            $('#password_error').text('');
            $('#confirm_password_error').text('');
            $('#password').css('border-color', '');
            $('#confirm_password').css('border-color', '');
        });

        /////////////////////////////////////////////////////////
        // change teacher password Teacher
        $('#form_teacher_change_password').on('submit', function (e) {
            e.preventDefault();

            ////////////////////////////////////////////////////
            $('#password_error').text('');
            $('#confirm_password_error').text('');

            $('#password').css('border-color', '');
            $('#confirm_password').css('border-color', '');
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
                            customClass: {confirmButton: 'change_password_button'}
                        });
                        $('.change_password_button').click(function () {
                            $('#modal_teacher_change_password').modal('hide');
                            $('#form_teacher_change_password')[0].reset();
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
