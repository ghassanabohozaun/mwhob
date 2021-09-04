<!-- begin Renew Contest Modal -->
<div class="modal fade" id="modal_add_new_team" data-backdrop="static" tabindex="-1" role="dialog"
     aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"
                    id="exampleModalLabel">{{trans('landing.add_new_team')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form action="{!! route('admin.store.team') !!}"
                  method="POST" enctype="multipart/form-data"
                  id="form_add_new_team">
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
                                            <label class="col-xl-3 col-lg-3 col-form-label">
                                                {{trans('courses.course_image')}}
                                            </label>
                                            <div class="col-lg-9 col-xl-9">
                                                <div
                                                    class="image-input image-input-outline"
                                                    id="kt_team_image">
                                                    <div class="image-input-wrapper" id="kt_team_image_wrapper"></div>
                                                    <label
                                                        class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                        data-action="change" data-toggle="tooltip" title=""
                                                        data-original-title="{{trans('general.change_image')}}">
                                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                                        <input type="file" name="team_image"
                                                               id="team_image"
                                                               class="table-responsive-sm">
                                                        <input type="hidden" name="photo_remove"/>
                                                    </label>
                                                    <span data-action="cancel" data-toggle="tooltip"
                                                          class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                          title="Cancel avatar">
                                                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                                 </span>
                                                </div>
                                                <span class="form-text text-muted">
                                                                {{trans('general.image_format_allow')}}
                                                            </span>
                                                <span class="form-text text-danger"
                                                      id="team_image_error"></span>
                                            </div>
                                        </div>
                                        <!--end::Group-->


                                        <!--begin::Group-->
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">
                                                {{trans('landing.name_ar')}}
                                            </label>
                                            <div class="col-lg-9 col-xl-9">
                                                <input
                                                    class="form-control  form-control-lg"
                                                    name="name_ar" id="name_ar" type="text"
                                                    placeholder=" {{trans('landing.enter_name_ar')}}"
                                                    autocomplete="off"/>
                                                <span class="form-text text-danger"
                                                      id="name_ar_error"></span>
                                            </div>
                                        </div>
                                        <!--end::Group-->

                                        <!--begin::Group-->
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">
                                                {{trans('landing.name_en')}}
                                            </label>
                                            <div class="col-lg-9 col-xl-9">
                                                <input
                                                    class="form-control  form-control-lg"
                                                    name="name_en" id="name_en" type="text"
                                                    placeholder=" {{trans('landing.enter_name_en')}}"
                                                    autocomplete="off"/>
                                                <span class="form-text text-danger"
                                                      id="name_en_error"></span>
                                            </div>
                                        </div>
                                        <!--end::Group-->


                                        <!--begin::Group-->
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">
                                                {{trans('landing.position_ar')}}
                                            </label>
                                            <div class="col-lg-9 col-xl-9">
                                                <input
                                                    class="form-control  form-control-lg"
                                                    name="position_ar" id="position_ar" type="text"
                                                    placeholder=" {{trans('landing.enter_position_ar')}}"
                                                    autocomplete="off"/>
                                                <span class="form-text text-danger"
                                                      id="position_ar_error"></span>
                                            </div>
                                        </div>
                                        <!--end::Group-->


                                        <!--begin::Group-->
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">
                                                {{trans('landing.position_en')}}
                                            </label>
                                            <div class="col-lg-9 col-xl-9">
                                                <input
                                                    class="form-control  form-control-lg"
                                                    name="position_en" id="position_en" type="text"
                                                    placeholder=" {{trans('landing.enter_position_en')}}"
                                                    autocomplete="off"/>
                                                <span class="form-text text-danger"
                                                      id="position_en_error"></span>
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
                    <button type="" id="cancel_add_new_team_btn"
                            class="btn btn-light-primary font-weight-bold">
                        {{trans('general.cancel')}}
                    </button>

                    <button type="submit" id="save_add_new_team_btn" class="btn btn-primary font-weight-bold">
                        {{trans('general.save')}}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end Renew Contest  Modal-->

@push('js')

    <script type="text/javascript">


        var team_image = new KTImageInput('kt_team_image');


        ////////////////////////////////////////////////////
        // add new team btn
        $('body').on('click', '#add_new_team_btn', function (e) {
            e.preventDefault();
            $('#modal_add_new_team').modal('show');
        });

        ///////////////////////////////////////////////////////////////////////////////////////////
        // close add new team modal by cancel
        $('body').on('click', '#cancel_add_new_team_btn', function (e) {
            e.preventDefault();
            $('#modal_add_new_team').modal('hide');
            $('#form_add_new_team')[0].reset();
            $('#team_image').css('border-color', '');
            $('#name_ar').css('border-color', '');
            $('#name_en').css('border-color', '');
            $('#position_ar').css('border-color', '');
            $('#position_en').css('border-color', '');
            $('#team_image_error').text('');
            $('#name_ar_error').text('');
            $('#name_en_error').text('');
            $('#position_ar_error').text('');
            $('#position_en_error').text('');
            $('#kt_team_image').find('#kt_team_image_wrapper').css('background-image', 'none')

        });
        ///////////////////////////////////////////////////////////////////////////////////////////
        // Close add new team modal By event
        $('#modal_add_new_team').on('hidden.bs.modal', function (e) {
            e.preventDefault();
            $('#modal_add_new_team').modal('hide');
            $('#form_add_new_team')[0].reset();
            $('#team_image').css('border-color', '');
            $('#name_ar').css('border-color', '');
            $('#name_en').css('border-color', '');
            $('#position_ar').css('border-color', '');
            $('#position_en').css('border-color', '');
            $('#team_image_error').text('');
            $('#name_ar_error').text('');
            $('#name_en_error').text('');
            $('#position_ar_error').text('');
            $('#position_en_error').text('');
            $('#kt_team_image').find('#kt_team_image_wrapper').css('background-image', 'none')


        });

        ///////////////////////////////////////////////////////////////////////////////////////////
        /// add new team
        $('#form_add_new_team').on('submit', function (e) {
            e.preventDefault();
            //////////////////////////////////////////////////////////////
            $('#team_image').css('border-color', '');
            $('#name_ar').css('border-color', '');
            $('#name_en').css('border-color', '');
            $('#position_ar').css('border-color', '');
            $('#position_en').css('border-color', '');

            $('#team_image_error').text('');
            $('#name_ar_error').text('');
            $('#name_en_error').text('');
            $('#position_ar_error').text('');
            $('#position_en_error').text('');
            $('#kt_team_image').find('#kt_team_image_wrapper').css('background-image', 'none')

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
                            customClass: {confirmButton: 'add_new_team_button'}
                        });
                        $('.add_new_team_button').click(function () {
                            $('#modal_add_new_team').modal('hide');
                            updateDataTable();
                            $('#form_add_new_team')[0].reset();
                            $('#kt_team_image').find('#kt_team_image_wrapper').css('background-image', 'none')

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
                }
                ,
                complete: function () {
                    KTApp.unblockPage();
                }
                ,
            })

        })
        ;//end submit


        /////////////////////////////////////////////////////////////////
        ///  team Delete
        $(document).on('click', '.delete_team_btn', function (e) {
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
                        url: '{!! route('admin.destroy.team') !!}',
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
                                    customClass: {confirmButton: 'delete_team_button'}
                                });
                                $('.delete_team_button').click(function () {
                                    updateDataTable();

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
                        customClass: {confirmButton: 'cancel_delete_team_button'}
                    })
                }
            });

        })
    </script>
@endpush
