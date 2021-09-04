<!-- begin choose Contest Winner Modal -->
<div class="modal fade" id="modal_choose_contest_winner" data-backdrop="static" tabindex="-1" role="dialog"
     aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"
                    id="exampleModalLabel">{{trans('contests.choose_contest_winner')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form action="{!! route('admin.choose.contest.winner')!!}"
                  method="POST" enctype="multipart/form-data"
                  id="form_choose_contest_winner">
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


                                        <!--begin::Group-->
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">
                                                {{trans('contests.mawhob_winner_description_ar')}}
                                            </label>
                                            <div class="col-lg-9 col-xl-9">
                                                            <textarea rows="5"
                                                                      maxlength="200"
                                                                      onkeyup="limitText('mawhob_winner_description_ar' , 'ar_char_count')"
                                                                      class="form-control  form-control-lg"
                                                                      name="mawhob_winner_description_ar"
                                                                      id="mawhob_winner_description_ar" type="text"
                                                                      placeholder=" {{trans('contests.enter_mawhob_winner_description_ar')}}"
                                                                      autocomplete="off"></textarea>
                                                <div class="form-text text-warning"
                                                     id="ar_char_count"></div>

                                                <span class="form-text text-danger"
                                                      id="mawhob_winner_description_ar_error"></span>

                                            </div>
                                        </div>
                                        <!--end::Group-->

                                        <!--begin::Group-->
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">
                                                {{trans('contests.mawhob_winner_description_en')}}
                                            </label>
                                            <div class="col-lg-9 col-xl-9">
                                                            <textarea rows="5"
                                                                      maxlength="200"
                                                                      onkeyup="limitText('mawhob_winner_description_en' , 'en_char_count')"
                                                                      class="form-control  form-control-lg"
                                                                      name="mawhob_winner_description_en"
                                                                      id="mawhob_winner_description_en" type="text"
                                                                      placeholder=" {{trans('contests.enter_mawhob_winner_description_en')}}"
                                                                      autocomplete="off"></textarea>
                                                <div class="form-text text-warning"
                                                     id="en_char_count"></div>

                                                <span class="form-text text-danger"
                                                      id="mawhob_winner_description_en_error"></span>

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
                    <button type="" id="cancel_choose_contest_winner_btn"
                            class="btn btn-light-primary font-weight-bold">
                        {{trans('general.cancel')}}
                    </button>

                    <button type="submit" id="save_choose_contest_winner_btn" class="btn btn-primary font-weight-bold">
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


        ////////////////////////////////////////////////////
        // choose contest winner
        $('body').on('click', '.choose_contest_winner_btn', function (e) {
            e.preventDefault();
            $('#modal_choose_contest_winner').modal('show');
            var id = $(this).data('id');
            $('#form_choose_contest_winner').find('#id').val(id);
        });

        ///////////////////////////////////////////////////////////////////////////////////////////
        // close choose contest winner  modal by cancel
        $('body').on('click', '#cancel_add_new_contest_mawhob_btn', function (e) {
            e.preventDefault();
            $.notifyClose();
            $('#modal_choose_contest_winner').modal('hide');
            $('#form_choose_contest_winner')[0].reset();
            $('#mawhob_winner_description_ar').css('border-color', '');
            $('#mawhob_winner_description_en').css('border-color', '');
            $('#mawhob_winner_description_ar_error').text('');
            $('#mawhob_winner_description_en_error').text('');
            $('#ar_char_count').text('');
            $('#en_char_count').text('');

        });
        ///////////////////////////////////////////////////////////////////////////////////////////
        // Close choose contest winner modal By event
        $('#modal_choose_contest_winner').on('hidden.bs.modal',
            function (e) {
                e.preventDefault();
                $.notifyClose();
                $('#modal_choose_contest_winner').modal('hide');
                $('#form_choose_contest_winner')[0].reset();
                $('#mawhob_winner_description_ar').css('border-color', '');
                $('#mawhob_winner_description_en').css('border-color', '');
                $('#mawhob_winner_description_ar_error').text('');
                $('#mawhob_winner_description_en_error').text('');
                $('#ar_char_count').text('');
                $('#en_char_count').text('');
            });

        ///////////////////////////////////////////////////////////////////////////////////////////
        /// choose contest winner
        $('#form_choose_contest_winner').on('submit', function (e) {
            e.preventDefault();
            $.notifyClose();
            //////////////////////////////////////////////////////////////
            $('#mawhob_winner_description_ar').css('border-color', '');
            $('#mawhob_winner_description_en').css('border-color', '');
            $('#mawhob_winner_description_ar_error').text('');
            $('#mawhob_winner_description_en_error').text('');
            $('#ar_char_count').text('');
            $('#en_char_count').text('');
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
                            customClass: {confirmButton: 'add_new_contest_mawhob_button'}
                        });
                        $('.add_new_contest_mawhob_button').click(function () {
                            $('#modal_choose_contest_winner').modal('hide');
                            $('#my_enrolled_mawhob_data_table').DataTable().ajax.reload();
                            $('#form_choose_contest_winner')[0].reset();
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
