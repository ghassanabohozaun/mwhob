<!-- begin Renew Contest Modal -->
<div class="modal fade" id="modal_renew_contest" data-backdrop="static" tabindex="-1" role="dialog"
     aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"
                    id="exampleModalLabel">{{trans('contests.renew_contest')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form action="{!! route('admin.renew.contest') !!}"
                  method="POST" enctype="multipart/form-data"
                  id="form_renew_contest">
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
                                                {{trans('contests.end_date')}}
                                            </label>
                                            <div class="col-lg-9 col-xl-9">
                                                <div class="input-group date">
                                                    <input type="text" class="form-control"
                                                           id="end_date" name="end_date"
                                                           readonly
                                                           placeholder="{{trans('contests.enter_end_date')}}"/>
                                                    <div class="input-group-append">
                                                             <span class="input-group-text">
                                                                <i class="la la-calendar-check-o"></i>
                                                             </span>
                                                    </div>
                                                </div>
                                                <span class="form-text text-danger"
                                                      id="end_date_error"></span>
                                            </div>
                                            <!--end::Group-->
                                        </div>
                                        <!--end::Group-->

                                        <!--begin::Group-->
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">
                                                {{trans('contests.prize')}}
                                            </label>
                                            <div class="col-lg-9 col-xl-9">
                                                <input
                                                    class="form-control  form-control-lg"
                                                    name="prize" id="prize" type="text"
                                                    placeholder=" {{trans('contests.enter_prize')}}"
                                                    autocomplete="off"/>
                                                <span class="form-text text-danger"
                                                      id="prize_error"></span>
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
                    <button type="" id="cancel_renew_contest_btn"
                            class="btn btn-light-primary font-weight-bold">
                        {{trans('general.cancel')}}
                    </button>

                    <button type="submit" id="save_renew_contest_btn" class="btn btn-primary font-weight-bold">
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
        ////////////////////////////////////////////////
        ///////// Datepicker
        $('#end_date').datepicker({
            format: "yyyy-mm-dd",
            todayBtn: true,
            clearBtn: false,
            orientation: "bottom auto",
            language: "{{LaravelLocalization::getCurrentLocale()}}",
            autoclose: true,
            todayHighlight: true,
        });


        ////////////////////////////////////////////////////
        // renew Contest
        $('body').on('click', '.renew_contest_btn', function (e) {
            e.preventDefault();
            $('#modal_renew_contest').modal('show');
            var id = $(this).data('id');
            $('#form_renew_contest').find('#id').val(id);
        });

        ///////////////////////////////////////////////////////////////////////////////////////////
        // close renew contest  modal by cancel
        $('body').on('click', '#cancel_renew_contest_btn', function (e) {
            e.preventDefault();
            $.notifyClose();
            $('#modal_renew_contest').modal('hide');
            $('#form_renew_contest')[0].reset();
            $('#end_date').css('border-color', '');
            $('#prize').css('border-color', '');
            $('#end_date_error').text('');
            $('#prize_error').text('');
        });
        ///////////////////////////////////////////////////////////////////////////////////////////
        // Close renew contest  modal By event
        $('#modal_renew_contest').on('hidden.bs.modal', function (e) {
            e.preventDefault();
            $.notifyClose();
            $('#modal_renew_contest').modal('hide');
            $('#form_renew_contest')[0].reset();
            $('#end_date').css('border-color', '');
            $('#prize').css('border-color', '');
            $('#end_date_error').text('');
            $('#prize_error').text('');
        });

        ///////////////////////////////////////////////////////////////////////////////////////////
        /// renew contest
        $('#form_renew_contest').on('submit', function (e) {
            e.preventDefault();
            $.notifyClose();
            //////////////////////////////////////////////////////////////
            $('#end_date').css('border-color', '');
            $('#prize').css('border-color', '');

            $('#end_date_error').text('');
            $('#prize_error').text('');
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
                            customClass: {confirmButton: 'renew_contest_button'}
                        });
                        $('.renew_contest_button').click(function () {
                            $('#modal_renew_contest').modal('hide');
                            $('#my_contests_data_table').DataTable().ajax.reload();
                            $('#form_renew_contest')[0].reset();
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
