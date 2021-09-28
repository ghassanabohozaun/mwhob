<!-- begin show story details show Modal -->
<div class="modal fade" id="modal_show_story_details"
     data-backdrop="static" tabindex="-1" role="dialog"
     aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('stories.show_story_details')}}</h5>
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
                                            <img src="" id="story_image" width="20%" height="200"
                                                 style=" display:block; margin:auto;"/>
                                        </div>
                                    </div>
                                    <!--end::Group-->


                                    <!--begin::Group-->
                                    <div class="form-group row">

                                        <label class="col-xl-12 col-lg-12 col-form-label">
                                            {{trans('stories.mawhob_id')}}
                                        </label>
                                        <div class="col-lg-12 col-xl-12">
                                                <span class="form-control  form-control-lg"
                                                      id="mawhob_id" type="text"></span>
                                        </div>

                                    </div>
                                    <!--end::Group-->


                                    <div class="form-group row">
                                        <label class="col-xl-12 col-lg-12 col-form-label">
                                            {{trans('stories.story_category_id')}}
                                        </label>
                                        <div class="col-lg-12 col-xl-12">
                                                <span class="form-control  form-control-lg"
                                                      id="story_category_id" type="text"></span>
                                        </div>
                                    </div>


                                    <!--begin::Group-->
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                            {{trans('stories.about_mawhob_ar')}}
                                        </label>
                                        <div class="col-lg-12 col-xl-12">
                                                <span class="form-control  form-control-lg"
                                                      style=" display:inline-block;height: 180px;"
                                                      id="about_mawhob_ar" type="text"></span>
                                        </div>
                                    </div>
                                    <!--end::Group-->

                                    <!--begin::Group-->
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                            {{trans('stories.about_mawhob_en')}}
                                        </label>
                                        <div class="col-lg-12 col-xl-12">
                                                <span class="form-control  form-control-lg"
                                                      style=" display:inline-block;height: 180px;"
                                                      id="about_mawhob_en" type="text"></span>
                                        </div>
                                    </div>
                                    <!--end::Group-->

                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">{!! trans('stories.experience_name_ar') !!}</th>
                                            <th scope="col">{!! trans('stories.experience_name_en') !!}</th>
                                            <th scope="col">{!! trans('stories.experience_percentage') !!}</th>
                                        </tr>
                                        </thead>
                                        <tbody id="mawhob_experience_section">

                                        </tbody>
                                    </table>


                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="#" id="cancel_show_story_details"
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

        //  close show story details modal By cancel
        $('body').on('click', '#cancel_show_story_details', function (e) {
            e.preventDefault();
            $('#modal_show_story_details').modal('hide');
        });
        ////////////////////////////////////////////////////////////////////////////////////
        //   close show course details modal By event
        $('#modal_show_story_details').on('hidden.bs.modal', function (e) {
            e.preventDefault();
            $('#modal_show_story_details').modal('hide');
        });

        ////////////////////////////////////////////////////////////////////////////////////
        //  show story details modal
        $('body').on('click', '.show_story_details_btn', function (e) {
            e.preventDefault();
            $.notifyClose();
            var id = $(this).data('id');

            $.ajax({
                url: "{{route('admin.show.story.details')}}",
                data: {id, id},
                dataType: 'json',
                type: 'GET',
                success: function (data) {
                    $('#about_mawhob_ar').text(data.data.about_mawhob_ar);
                    $('#about_mawhob_en').text(data.data.about_mawhob_en);
                    if ("{!! Lang()=='ar' !!}") {
                        $('#mawhob_id').text(data.data.mawhob.mawhob_full_name);
                    } else {
                        $('#mawhob_id').text(data.data.mawhob.mawhob_full_name_en);
                    }

                    $('#story_category_id').text(data.data.story_category.name_{!! Lang() !!});


                    var image = data.data.story_image;
                    var url = '{{asset(Storage::url(''))}}' + image;
                    $('#story_image').attr("src", url);


                    var icon = data.data.story_icon;
                    var url = '{{asset(Storage::url(''))}}' + icon;
                    $('#story_icon').attr("src", url);


                    FillExperienceTable(id);

                    $('#modal_show_story_details').modal('show');
                },

            })
        })


        /////////////////////////////////////////////////////////
        //  Fill experience Table
        function FillExperienceTable(story_id = null) {
            $.ajax({
                url: "{!! route('admin.get.all.mawhob.experiences') !!}",
                data: {story_id: story_id},
                type: 'GET',
                dataType: 'json', // added data type
                success: function (data) {
                    console.log(data);
                    $('#mawhob_experience_section').empty();
                    var trHTML = '';
                    $.each(data, function (i, item) {
                        trHTML += '<tr>' + '<td>' + i + '</td><td>' + item.experience_name_ar + '</td>' +
                            +'<td>' + i + '</td><td>' + item.experience_name_en + '</td>' +
                            +'<td>' + i + '</td><td>' + item.experience_percentage + ' % </td>' +
                            '</tr>';
                    });
                    $('#mawhob_experience_section').append(trHTML);
                }

            });
        }
    </script>
@endpush
