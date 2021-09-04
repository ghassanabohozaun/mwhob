@extends('layouts.admin')
@section('title') @endsection
@section('content')

    <form class="form" action="{{route('admin.store.story')}}" method="POST" id="form_story_add">
    @csrf
    <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div
                class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex align-items-center flex-wrap mr-2">


                    <!--begin::Actions-->
                    <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>

                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.stories')}}" class="text-muted">
                                {{trans('menu.success_stories')}}
                            </a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="" class="text-muted">
                                {{trans('menu.add_new_success_story')}}
                            </a>
                        </li>
                    </ul>

                    <!--end::Actions-->
                </div>
                <!--end::Info-->

                <!--begin::Toolbar-->
                <div class="d-flex align-items-center">
                    <button type="submit"
                            class="btn btn-primary btn-sm font-weight-bold font-size-base  mr-1">
                        <i class="fa fa-save"></i>
                        {{trans('general.save')}}
                    </button>

                </div>
                <!--end::Toolbar-->
            </div>
        </div>
        <!--end::Subheader-->


        <!--begin::content-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class=" container-fluid ">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-lg-12">
                        <!--begin::Card-->
                        <!--begin::Card-->
                        <div class="card card-custom card-shadowless rounded-top-0" id="card_languages_add">
                            <!--begin::Body-->
                            <div class="card-body p-0">
                                <div class="row justify-content-center py-8 px-8 py-lg-15 px-lg-10">
                                    <div class="col-xl-12 col-xxl-10">

                                        <div class="row justify-content-center">
                                            <div class="col-xl-9">

                                                <!--begin::body-->
                                                <div class="my-5">


                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                            {{trans('stories.story_icon')}}
                                                        </label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <div
                                                                class="image-input image-input-outline"
                                                                id="kt_story_icon">
                                                                <div class="image-input-wrapper"></div>
                                                                <label
                                                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                                    data-action="change" data-toggle="tooltip" title=""
                                                                    data-original-title="{{trans('general.change_image')}}">
                                                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                                                    <input type="file" name="story_icon"
                                                                           id="story_icon"
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
                                                                  id="story_icon_error"></span>
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                            {{trans('stories.story_image')}}
                                                        </label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <div
                                                                class="image-input image-input-outline"
                                                                id="kt_story_image">
                                                                <div class="image-input-wrapper"></div>
                                                                <label
                                                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                                    data-action="change" data-toggle="tooltip" title=""
                                                                    data-original-title="{{trans('general.change_image')}}">
                                                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                                                    <input type="file" name="story_image"
                                                                           id="story_image"
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
                                                                  id="story_image_error"></span>
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                            {{trans('stories.story_category_id')}}
                                                        </label>
                                                        <div class="col-lg-9 col-xl-9">

                                                            <select
                                                                class="form-control  form-control-lg"
                                                                name="" id="story_category_id"
                                                                type="text">
                                                                <option value="">
                                                                    {{trans('general.select_from_list')}}
                                                                </option>
                                                                @if($storyCategories && $storyCategories->count()>0)
                                                                    @foreach($storyCategories as $storyCategory)
                                                                        <option value="{!! $storyCategory->id !!}">
                                                                            @if(Lang()=='ar')
                                                                                {!! $storyCategory->name_ar !!}
                                                                            @else
                                                                                {!! $storyCategory->name_en !!}
                                                                            @endif
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                            <span class="form-text text-danger"
                                                                  id="story_category_id_error"></span>
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                            {{trans('stories.mawhob_id')}}
                                                        </label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <select class="form-control kt-select2"
                                                                    id="mawhob_id_select2"
                                                                    name="mawhob_id">
                                                                <option></option>
                                                            </select>
                                                            <span class="form-text text-danger"
                                                                  id="mawhob_id_error"></span>
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                            {{trans('stories.about_mawhob_ar')}}
                                                        </label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <textarea rows="10"
                                                                      maxlength="800"
                                                                      onkeyup="limitText('about_mawhob_ar' , 'ar_char_count')"
                                                                      class="form-control  form-control-lg"
                                                                      name="about_mawhob_ar"
                                                                      id="about_mawhob_ar" type="text"
                                                                      placeholder=" {{trans('stories.enter_about_mawhob_ar')}}"
                                                                      autocomplete="off"></textarea>
                                                            <div class="form-text text-warning"
                                                                 id="ar_char_count"></div>

                                                            <span class="form-text text-danger"
                                                                  id="about_mawhob_ar_error"></span>

                                                        </div>
                                                    </div>
                                                    <!--end::Group-->

                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                            {{trans('stories.about_mawhob_en')}}
                                                        </label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <textarea rows="10"
                                                                      maxlength="800"
                                                                      onkeyup="limitText('about_mawhob_en' , 'en_char_count')"
                                                                      class="form-control  form-control-lg"
                                                                      name="about_mawhob_en"
                                                                      id="about_mawhob_en" type="text"
                                                                      placeholder=" {{trans('stories.enter_about_mawhob_en')}}"
                                                                      autocomplete="off"></textarea>

                                                            <div class="form-text text-warning"
                                                                 id="en_char_count"></div>
                                                            <span class="form-text text-danger"
                                                                  id="about_mawhob_en_error"></span>

                                                        </div>
                                                    </div>
                                                    <!--end::Group-->


                                                    <div class="card card-custom card-shadowless rounded-top-0">
                                                        <!--begin::Body-->
                                                        <div class="card-body p-0">
                                                            <!--begin::Question-->
                                                            <div class="card ">
                                                                <div class="card-body">
                                                                    <div class="experiences_inputs_container">
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                    <div class="form-group m-form__group row"
                                                                         style="margin-right: 2px">
                                                                        <a href="#"
                                                                           class="add_input btn   btn-success btn-sm ">
                                                                            <i class="fa fa-plus"></i> {!! trans('stories.add_experiences') !!}
                                                                        </a>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <!--begin::body-->

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Card-->
                    </div>
                </div>

            </div>
        </div>
        <!--end::content-->

    </form>
@endsection

@push('js')
    <script type="text/javascript">


        ////////////////////////////////////////////////////////////////
        // Append Answer
        $('body').on('click', '.add_input', function (e) {

            e.preventDefault();

            $('.experiences_inputs_container').append(
                '<div class="form-group m-form__group row">' +
                '<div class="col-lg-4">' +
                '<label>{{trans('stories.experience_name_ar')}}' +
                ':</label>' +
                '<input type="text"  ' +
                'class="form-control m-input"' +
                ' id="experience_name_ar"' +
                'name="experience_name_ar[]"' +
                'value=""' +
                'autocomplete="off"' +
                'placeholder="{{trans('stories.enter_experience_name_ar')}}">' +
                '<span' +
                'class="m-form__help input_key-error text-danger"></span>' +
                '</div>' +
                '<div class="col-lg-4">' +
                '<label>{{trans('stories.experience_name_en')}}' +
                ':</label>' +
                '<input type="text"  ' +
                'class="form-control m-input" ' +
                'id="experience_name_en"' +
                'name="experience_name_en[]"' +
                'value=""' +
                'autocomplete="off"' +
                'placeholder="{{trans('stories.enter_experience_name_en')}}">' +
                '<span' +
                'class="m-form__help input_key-error text-danger"></span>' +
                '</div>' +
                '<div class="col-lg-3">' +
                '<label>{{trans('stories.experience_percentage')}}' +
                ':</label>' +
                '<input type="number"  oninput="this.value = Math.round(this.value);" ' +
                ' class="form-control m-input"' +
                'id="experience_percentage"' +
                'name="experience_percentage[]"' +
                ' value=""' +
                'autocomplete="off"' +
                'placeholder="{{trans('stories.enter_experience_percentage')}}">' +
                '<span' +
                'class="m-form__help input_value-error text-danger"></span>' +
                '</div>' +
                '<div class="col-lg-1" style="padding-top: 25px">' +
                '<a href="#"' +
                'class="remove_input btn btn-icon btn-light-danger btn-sm mr-2">' +
                '<i class="fa fa-trash"></i>' +
                '</a>' +
                '</div>' +
                '</div>');
        });


        //// remove
        $('body').on('click', '.remove_input', function (e) {
            e.preventDefault();
            $(this).parent('div').parent('div').remove();
        });



        //////////////////////////////////////////////////////
        //////////////////////////////////////////////////////
        /// Mawhob select2
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
                            return {
                                text: item.mawhob_full_name,
                                id: item.id,
                            }
                        })
                    };
                },
                cache: true
            }
        });


        //////////////////////////////////////////////////////

        var story_icon = new KTImageInput('kt_story_icon');
        var story_image = new KTImageInput('kt_story_image');

        //////////////////////////////////////////////////////
        $('#form_story_add').on('submit', function (e) {
            e.preventDefault();
            //////////////////////////////////////////////////////////////
            $('#story_icon').css('border-color', '');
            $('#story_image').css('border-color', '');
            $('#about_mawhob_ar').css('border-color', '');
            $('#about_mawhob_en').css('border-color', '');
            $('#mawhob_id').css('border-color', '');
            $('#story_category_id').css('border-color', '');


            $('#story_icon_error').text('');
            $('#story_image_error').text('');
            $('#about_mawhob_ar_error').text('');
            $('#about_mawhob_en_error').text('');
            $('#mawhob_id_error').text('');
            $('#story_category_id_error').text('');
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
                            customClass: {confirmButton: 'add_story_button'}
                        });
                        $('.add_story_button').click(function () {
                            window.location.href = "{{route('admin.stories')}}";
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
