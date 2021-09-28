<!-- begin show course details show Modal -->
<div class="modal fade" id="modal_show_course_details"
     data-backdrop="static" tabindex="-1" role="dialog"
     aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('courses.show_course_details')}}</h5>
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
                                            <img src="" id="course_image" width="100%"/>
                                        </div>
                                    </div>
                                    <!--end::Group-->

                                    <!--begin::Group-->
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                            {{trans('courses.title_ar')}}
                                        </label>
                                        <div class="col-lg-12 col-xl-12">
                                                <span class="form-control  form-control-lg"
                                                      id="title_ar" type="text"></span>
                                        </div>
                                    </div>
                                    <!--end::Group-->


                                    <!--begin::Group-->
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                            {{trans('courses.title_en')}}
                                        </label>
                                        <div class="col-lg-12 col-xl-12">
                                                <span class="form-control  form-control-lg"
                                                      id="title_en" type="text"></span>
                                        </div>
                                    </div>
                                    <!--end::Group-->

                                    <!--begin::Group-->
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                            {{trans('courses.description_ar')}}
                                        </label>
                                        <div class="col-lg-12 col-xl-12">
                                                <span class="form-control  form-control-lg"
                                                      style=" display:inline-block;height: 120px;"
                                                      id="description_ar" type="text"></span>
                                        </div>
                                    </div>
                                    <!--end::Group-->

                                    <!--begin::Group-->
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                            {{trans('courses.description_en')}}
                                        </label>
                                        <div class="col-lg-12 col-xl-12">
                                                <span class="form-control  form-control-lg"
                                                      style=" display:inline-block;height: 120px;"
                                                      id="description_en" type="text"></span>
                                        </div>
                                    </div>
                                    <!--end::Group-->


                                    <!--begin::Group-->
                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label class="col-xl-12 col-lg-12 col-form-label">
                                                {{trans('courses.hours')}}
                                            </label>
                                            <div class="col-lg-12 col-xl-12">
                                                <span class="form-control  form-control-lg"
                                                      id="hours" type="text"></span>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <label class="col-xl-12 col-lg-12 col-form-label">
                                                {{trans('courses.cost')}}
                                            </label>
                                            <div class="col-lg-12 col-xl-12">
                                                <span class="form-control  form-control-lg"
                                                      id="cost" type="text"></span>
                                            </div>
                                        </div>

                                    </div>
                                    <!--end::Group-->


                                    <div class="form-group row">

                                        <div class="col-lg-6">
                                            <label class="col-xl-12 col-lg-12 col-form-label">
                                                {{trans('courses.category_id')}}
                                            </label>
                                            <div class="col-lg-12 col-xl-12">
                                                <span class="form-control  form-control-lg"
                                                      id="category_id" type="text"></span>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <label class="col-xl-12 col-lg-12 col-form-label">
                                                {{trans('courses.teacher_id')}}
                                            </label>
                                            <div class="col-lg-12 col-xl-12">
                                                <span class="form-control  form-control-lg"
                                                      id="teacher_id" type="text"></span>
                                            </div>
                                        </div>
                                    </div>


                                    <!--begin::Group-->
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                            {{trans('courses.zoom_link')}}
                                        </label>
                                        <div class="col-lg-12 col-xl-12">
                                                <span class="form-control  form-control-lg"
                                                      style=" display:inline-block;height: 120px;"
                                                      id="zoom_link" type="text"></span>
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
                <button type="#" id="cancel_show_course_details"
                        class="btn btn-light-primary font-weight-bold">
                    {{trans('general.cancel')}}
                </button>
            </div>

        </div>
    </div>
</div>
<!-- end show course details show Modal -->

@push('js')

    <script type="text/javascript">

        //  close show course details modal By cancel
        $('body').on('click', '#cancel_show_course_details', function (e) {
            e.preventDefault();
            $('#modal_show_course_details').modal('hide');
        });
        ////////////////////////////////////////////////////////////////////////////////////
        //   close show course details modal By event
        $('#modal_change_teacher_of_course').on('hidden.bs.modal', function (e) {
            e.preventDefault();
            $('#modal_show_course_details').modal('hide');
        });

        ////////////////////////////////////////////////////////////////////////////////////
        //  show course details modal
        $('body').on('click', '.show_course_details_btn', function (e) {
            e.preventDefault();
            $.notifyClose();
            var id = $(this).data('id');

            $.ajax({
                url: "{{route('admin.show.course.details')}}",
                data: {id, id},
                dataType: 'json',
                type: 'GET',
                success: function (data) {
                    $('#title_ar').text(data.data.title_ar);
                    $('#title_en').text(data.data.title_en);
                    $('#description_ar').text(data.data.description_ar);
                    $('#description_en').text(data.data.description_en);
                    $('#hours').text(data.data.hours);
                    $('#cost').text(data.data.cost);
                    $('#discount').text(data.data.discount);
                    $('#category_id').text(data.data.category.name_{!! Lang() !!});

                    if("{!! Lang()=='ar' !!}"){
                        $('#teacher_id').text(data.data.teacher.teacher_full_name);
                    }else{
                        $('#teacher_id').text(data.data.teacher.teacher_full_name_en);
                    }

                    $('#zoom_link').text(data.data.zoom_link);

                    var image = data.data.course_image;
                    var url = '{{asset(Storage::url(''))}}' + image;
                    $('#course_image').attr("src", url);

                    $('#modal_show_course_details').modal('show');
                },

            })
        })

    </script>
@endpush
