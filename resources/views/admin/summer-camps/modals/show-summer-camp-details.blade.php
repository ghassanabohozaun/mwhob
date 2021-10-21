<!-- begin show summer camp details show Modal -->
<div class="modal fade" id="modal_show_summer_camp_details"
     data-backdrop="static" tabindex="-1" role="dialog"
     aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('summerCamps.show_summer_camp_details')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <div class="modal-body">

                <!--begin::Card-->
                <div class="card card-custom card-shadowless rounded-top-0">
                    <!--begin::Body-->
                    <div class="card-body p-0">

                        <div class="col-xl-12 col-xxl-12">

                            <div class="row justify-content-center">
                                <div class="col-xl-12">


                                    <!--begin::Group-->
                                    <div class="form-group row">
                                        <div class="col-lg-12 col-xl-12">
                                            <img src="" id="summer-camp_image" width="100%"/>
                                        </div>
                                    </div>
                                    <!--end::Group-->

                                    <!--begin::Group-->
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                            {{trans('summerCamps.name_ar')}}
                                        </label>
                                        <div class="col-lg-12 col-xl-12">
                                                <span class="form-control  form-control-lg"
                                                      id="name_ar" type="text"></span>
                                        </div>
                                    </div>
                                    <!--end::Group-->


                                    <!--begin::Group-->
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                            {{trans('summerCamps.name_en')}}
                                        </label>
                                        <div class="col-lg-12 col-xl-12">
                                                <span class="form-control  form-control-lg"
                                                      id="name_en" type="text"></span>
                                        </div>
                                    </div>
                                    <!--end::Group-->

                                    <!--begin::Group-->
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                            {{trans('summerCamps.short_description_ar')}}
                                        </label>
                                        <div class="col-lg-12 col-xl-12">
                                                <span class="form-control  form-control-lg"
                                                      style=" display:inline-block;height: 120px;"
                                                      id="short_description_ar" type="text"></span>
                                        </div>
                                    </div>
                                    <!--end::Group-->

                                    <!--begin::Group-->
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                            {{trans('summerCamps.short_description_en')}}
                                        </label>
                                        <div class="col-lg-12 col-xl-12">
                                                <span class="form-control  form-control-lg"
                                                      style=" display:inline-block;height: 120px;"
                                                      id="short_description_en" type="text"></span>
                                        </div>
                                    </div>
                                    <!--end::Group-->


                                    <!--begin::Group-->
                                    <div class="form-group row">
                                        <div class="col-lg-4">
                                            <label class="col-xl-12 col-lg-12 col-form-label">
                                                {{trans('summerCamps.year')}}
                                            </label>
                                            <div class="col-lg-12 col-xl-12">
                                                <span class="form-control  form-control-lg"
                                                      id="year" type="text"></span>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <label class="col-xl-12 col-lg-12 col-form-label">
                                                {{trans('summerCamps.cost')}}
                                            </label>
                                            <div class="col-lg-12 col-xl-12">
                                                <span class="form-control  form-control-lg"
                                                      id="cost" type="text"></span>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <label class="col-xl-12 col-lg-12 col-form-label">
                                                {{trans('summerCamps.discount')}}
                                            </label>
                                            <div class="col-lg-12 col-xl-12">
                                                <span class="form-control  form-control-lg"
                                                      id="discount" type="text"></span>
                                            </div>
                                        </div>

                                    </div>
                                    <!--end::Group-->


                                    <!--begin::Group-->
                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label class="col-xl-12 col-lg-12 col-form-label">
                                                {{trans('summerCamps.start_at')}}
                                            </label>
                                            <div class="col-lg-12 col-xl-12">
                                                <span class="form-control  form-control-lg"
                                                      id="start_at" type="text"></span>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <label class="col-xl-12 col-lg-12 col-form-label">
                                                {{trans('summerCamps.end_at')}}
                                            </label>
                                            <div class="col-lg-12 col-xl-12">
                                                <span class="form-control  form-control-lg"
                                                      id="end_at" type="text"></span>
                                            </div>
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
                <button type="#" id="cancel_show_summer_camp_details"
                        class="btn btn-light-primary font-weight-bold">
                    {{trans('general.cancel')}}
                </button>
            </div>

        </div>
    </div>
</div>
<!-- end show summer camp details show Modal -->

@push('js')

    <script type="text/javascript">

        //  close show summer camp details modal By cancel
        $('body').on('click', '#cancel_show_summer_camp_details', function (e) {
            e.preventDefault();
            $('#modal_show_summer_camp_details').modal('hide');
        });
        ////////////////////////////////////////////////////////////////////////////////////
        //   close show summer camp details modal By event
        $('#modal_show_summer_camp_details').on('hidden.bs.modal', function (e) {
            e.preventDefault();
            $('#modal_show_summer_camp_details').modal('hide');
        });

        ////////////////////////////////////////////////////////////////////////////////////
        //  show summer camp details modal
        $('body').on('click', '.show_summer_camp_details_btn', function (e) {
            e.preventDefault();
            $.notifyClose();
            var id = $(this).data('id');

            $.ajax({
                url: "{{route('admin.show.summer.camp.details')}}",
                data: {id, id},
                dataType: 'json',
                type: 'GET',
                success: function (data) {
                    $('#name_ar').text(data.data.name_ar);
                    $('#name_en').text(data.data.name_en);
                    $('#short_description_ar').text(data.data.short_description_ar);
                    $('#short_description_en').text(data.data.short_description_en);
                    $('#year').text(data.data.year);
                    $('#start_at').text(data.data.start_at);
                    $('#end_at').text(data.data.end_at);
                    $('#cost').text(data.data.cost);
                    $('#discount').text(data.data.discount);
                    var image = data.data.summer_camp_image;
                    var url = '{{asset(Storage::url(''))}}' + image;
                    $('#summer-camp_image').attr("src", url);
                    $('#modal_show_summer_camp_details').modal('show');
                },

            })
        })

    </script>
@endpush
