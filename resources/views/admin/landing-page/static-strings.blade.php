@extends('layouts.admin')
@section('title') @endsection
@section('content')

    <form class="form" action="{!! route('admin.static.strings') !!}" method="POST"
          id="form_static_string_store"
          enctype="multipart/form-data">
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
                            <a href="javascript:void(0);" class="text-muted">
                                {{trans('menu.landing_page')}}
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="" class="text-muted">
                                {{trans('menu.static_strings')}}
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
                        <div class="card card-custom card-shadowless rounded-top-0" id="card_settings_store">
                            <!--begin::Body-->
                            <div class="card-body p-0">
                                <div class="row justify-content-center py-8 px-8 py-lg-15 px-lg-10">
                                    <div class="col-xl-12 col-xxl-10">

                                        <div class="row justify-content-center">
                                            <div class="col-xl-9">

                                                <!--begin::body-->
                                                <div class="my-5">

                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label>
                                                            {{trans('landing.talents_description_ar')}}
                                                        </label>
                                                        <textarea rows="4" dir="rtl"
                                                                  class="form-control  form-control-lg"
                                                                  name="talents_description_ar"
                                                                  id="talents_description_ar"
                                                                  placeholder=" {{trans('landing.enter_talents_description_ar')}}"
                                                                  autocomplete="off">{!!  staticStrings()->talents_description_ar !!}</textarea>
                                                        <span class="form-text text-danger"
                                                              id="talents_description_ar_error"></span>
                                                    </div>
                                                    <!--end::Group-->

                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label>
                                                            {{trans('landing.talents_description_en')}}
                                                        </label>
                                                        <textarea rows="4" dir="ltr"
                                                                  class="form-control  form-control-lg"
                                                                  name="talents_description_en"
                                                                  id="talents_description_en"
                                                                  placeholder=" {{trans('landing.enter_talents_description_en')}}"
                                                                  autocomplete="off">{!!  staticStrings()->talents_description_en !!}</textarea>
                                                        <span class="form-text text-danger"
                                                              id="talents_description_en_error"></span>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.soundtrack_description_ar')}}</label>
                                                        <textarea class="form-control" rows="4"
                                                                  placeholder="{{trans('landing.enter_soundtrack_description_ar')}}"
                                                                  name="soundtrack_description_ar" dir="rtl"
                                                                  id="soundtrack_description_ar">{!!  staticStrings()->soundtrack_description_ar !!}</textarea>
                                                        <span class="form-text text-danger"
                                                              id="soundtrack_description_ar_error"></span>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.soundtrack_description_en')}}</label>
                                                        <textarea class="form-control" rows="4"
                                                                  placeholder="{{trans('landing.enter_soundtrack_description_en')}}"
                                                                  name="soundtrack_description_en" dir="ltr"
                                                                  id="soundtrack_description_en">{!!  staticStrings()->soundtrack_description_en !!}</textarea>
                                                        <span class="form-text text-danger"
                                                              id="soundtrack_description_en_error"></span>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.videos_description_ar')}}</label>
                                                        <textarea class="form-control" rows="4"
                                                                  placeholder="{{trans('landing.enter_videos_description_ar')}}"
                                                                  name="videos_description_ar" dir="rtl"
                                                                  id="videos_description_ar">{!!  staticStrings()->videos_description_ar !!}</textarea>
                                                        <span class="form-text text-danger"
                                                              id="videos_description_ar_error"></span>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.videos_description_en')}}</label>
                                                        <textarea class="form-control" rows="4"
                                                                  placeholder="{{trans('landing.enter_videos_description_en')}}"
                                                                  name="videos_description_en" dir="ltr"
                                                                  id="videos_description_en">{!!  staticStrings()->videos_description_en !!}</textarea>
                                                        <span class="form-text text-danger"
                                                              id="videos_description_en_error"></span>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.success_stories_description_ar')}}</label>
                                                        <textarea class="form-control" rows="4"
                                                                  placeholder="{{trans('landing.enter_success_stories_description_ar')}}"
                                                                  name="success_stories_description_ar" dir="rtl"
                                                                  id="success_stories_description_ar">{!!  staticStrings()->success_stories_description_ar !!}</textarea>
                                                        <span class="form-text text-danger"
                                                              id="success_stories_description_ar_error"></span>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.success_stories_description_en')}}</label>
                                                        <textarea class="form-control" rows="4"
                                                                  placeholder="{{trans('landing.enter_success_stories_description_en')}}"
                                                                  name="success_stories_description_en" dir="ltr"
                                                                  id="success_stories_description_en">{!!  staticStrings()->success_stories_description_en !!}</textarea>
                                                        <span class="form-text text-danger"
                                                              id="success_stories_description_en_error"></span>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.success_story_categories_description_ar')}}</label>
                                                        <textarea class="form-control" rows="4"
                                                                  placeholder="{{trans('landing.enter_success_story_categories_description_ar')}}"
                                                                  name="success_story_categories_description_ar"
                                                                  dir="rtl"
                                                                  id="success_story_categories_description_ar">{!!  staticStrings()->success_story_categories_description_ar !!}</textarea>
                                                        <span class="form-text text-danger"
                                                              id="success_story_categories_description_ar_error"></span>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.success_story_categories_description_en')}}</label>
                                                        <textarea class="form-control" rows="4"
                                                                  placeholder="{{trans('landing.enter_success_story_categories_description_en')}}"
                                                                  name="success_story_categories_description_en"
                                                                  dir="ltr"
                                                                  id="success_story_categories_description_en">{!!  staticStrings()->success_story_categories_description_en !!}</textarea>
                                                        <span class="form-text text-danger"
                                                              id="success_story_categories_description_en_error"></span>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.success_story_description_ar')}}</label>
                                                        <textarea class="form-control" rows="4"
                                                                  placeholder="{{trans('landing.enter_success_story_description_ar')}}"
                                                                  name="success_story_description_ar" dir="rtl"
                                                                  id="success_story_description_ar">{!!  staticStrings()->success_story_description_ar !!}</textarea>
                                                        <span class="form-text text-danger"
                                                              id="success_story_description_ar_error"></span>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.success_story_description_en')}}</label>
                                                        <textarea class="form-control" rows="4"
                                                                  placeholder="{{trans('landing.enter_success_story_description_en')}}"
                                                                  name="success_story_description_en" dir="ltr"
                                                                  id="success_story_description_en">{!!  staticStrings()->success_story_description_en !!}</textarea>
                                                        <span class="form-text text-danger"
                                                              id="success_story_description_en_error"></span>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.success_story_person_description_ar')}}</label>
                                                        <textarea class="form-control" rows="4"
                                                                  placeholder="{{trans('landing.enter_success_story_person_description_ar')}}"
                                                                  name="success_story_person_description_ar" dir="rtl"
                                                                  id="success_story_person_description_ar">{!!  staticStrings()->success_story_person_description_ar !!}</textarea>
                                                        <span class="form-text text-danger"
                                                              id="success_story_person_description_ar_error"></span>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.success_story_person_description_en')}}</label>
                                                        <textarea class="form-control" rows="4"
                                                                  placeholder="{{trans('landing.enter_success_story_person_description_en')}}"
                                                                  name="success_story_person_description_en" dir="ltr"
                                                                  id="success_story_person_description_en">{!!  staticStrings()->success_story_person_description_en !!}</textarea>
                                                        <span class="form-text text-danger"
                                                              id="success_story_person_description_en_error"></span>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.programs_description_ar')}}</label>
                                                        <textarea class="form-control" rows="4"
                                                                  placeholder="{{trans('landing.enter_programs_description_ar')}}"
                                                                  name="programs_description_ar" dir="rtl"
                                                                  id="programs_description_ar">{!!  staticStrings()->programs_description_ar !!}</textarea>
                                                        <span class="form-text text-danger"
                                                              id="programs_description_ar_error"></span>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.programs_description_en')}}</label>
                                                        <textarea class="form-control" rows="4"
                                                                  placeholder="{{trans('landing.enter_programs_description_en')}}"
                                                                  name="programs_description_en" dir="ltr"
                                                                  id="programs_description_en">{!!  staticStrings()->programs_description_en !!}</textarea>
                                                        <span class="form-text text-danger"
                                                              id="programs_description_en_error"></span>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.courses_description_ar')}}</label>
                                                        <textarea class="form-control" rows="4"
                                                                  placeholder="{{trans('landing.enter_courses_description_ar')}}"
                                                                  name="courses_description_ar" dir="rtl"
                                                                  id="courses_description_ar">{!!  staticStrings()->courses_description_ar !!}</textarea>
                                                        <span class="form-text text-danger"
                                                              id="courses_description_ar_error"></span>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.courses_description_en')}}</label>
                                                        <textarea class="form-control" rows="4"
                                                                  placeholder="{{trans('landing.enter_courses_description_en')}}"
                                                                  name="courses_description_en" dir="ltr"
                                                                  id="courses_description_en">{!!  staticStrings()->courses_description_en !!}</textarea>
                                                        <span class="form-text text-danger"
                                                              id="courses_description_en_error"></span>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.contests_description_ar')}}</label>
                                                        <textarea class="form-control" rows="4"
                                                                  placeholder="{{trans('landing.enter_contests_description_ar')}}"
                                                                  name="contests_description_ar" dir="rtl"
                                                                  id="contests_description_ar">{!!  staticStrings()->contests_description_ar !!}</textarea>
                                                        <span class="form-text text-danger"
                                                              id="contests_description_ar_error"></span>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.contests_description_en')}}</label>
                                                        <textarea class="form-control" rows="4"
                                                                  placeholder="{{trans('landing.enter_contests_description_en')}}"
                                                                  name="contests_description_en" dir="ltr"
                                                                  id="contests_description_en">{!!  staticStrings()->contests_description_en !!}</textarea>
                                                        <span class="form-text text-danger"
                                                              id="contests_description_en_error"></span>
                                                    </div>
                                                    <!--end::Group-->

                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.terms_of_registration_for_the_contest_ar')}}</label>
                                                        <textarea rows="10" dir="rtl"
                                                                  class="form-control summernote"
                                                                  placeholder="{{trans('landing.enter_terms_of_registration_for_the_contest_ar')}}"
                                                                  name="terms_of_registration_for_the_contest_ar"
                                                                  id="terms_of_registration_for_the_contest_ar">{!!  staticStrings()->terms_of_registration_for_the_contest_ar !!}</textarea>
                                                        <span class="form-text text-danger"
                                                              id="terms_of_registration_for_the_contest_ar_error"></span>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.terms_of_registration_for_the_contest_en')}}</label>
                                                        <textarea  rows="10" dir="ltr"
                                                                  class="form-control summernote "
                                                                  placeholder="{{trans('landing.enter_terms_of_registration_for_the_contest_en')}}"
                                                                  name="terms_of_registration_for_the_contest_en"
                                                                  id="terms_of_registration_for_the_contest_en">{!!  staticStrings()->terms_of_registration_for_the_contest_en !!}</textarea>
                                                        <span class="form-text text-danger"
                                                              id="terms_of_registration_for_the_contest_en_error"></span>
                                                    </div>
                                                    <!--end::Group-->

                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.latest_winners_description_ar')}}</label>
                                                        <textarea class="form-control" rows="4"
                                                                  placeholder="{{trans('landing.enter_latest_winners_description_ar')}}"
                                                                  name="latest_winners_description_ar" dir="rtl"
                                                                  id="latest_winners_description_ar">{!!  staticStrings()->latest_winners_description_ar !!}</textarea>
                                                        <span class="form-text text-danger"
                                                              id="latest_winners_description_ar_error"></span>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.latest_winners_description_en')}}</label>
                                                        <textarea class="form-control" rows="4"
                                                                  placeholder="{{trans('landing.enter_latest_winners_description_en')}}"
                                                                  name="latest_winners_description_en" dir="ltr"
                                                                  id="latest_winners_description_en">{!!  staticStrings()->latest_winners_description_en !!}</textarea>
                                                        <span class="form-text text-danger"
                                                              id="latest_winners_description_en_error"></span>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.summer_camps_description_ar')}}</label>
                                                        <textarea class="form-control" rows="4"
                                                                  placeholder="{{trans('landing.enter_summer_camps_description_ar')}}"
                                                                  name="summer_camps_description_ar" dir="rtl"
                                                                  id="summer_camps_description_ar">{!!  staticStrings()->summer_camps_description_ar !!}</textarea>
                                                        <span class="form-text text-danger"
                                                              id="summer_camps_description_ar_error"></span>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.summer_camps_description_en')}}</label>
                                                        <textarea class="form-control" rows="4"
                                                                  placeholder="{{trans('landing.enter_summer_camps_description_en')}}"
                                                                  name="summer_camps_description_en" dir="ltr"
                                                                  id="summer_camps_description_en">{!!  staticStrings()->summer_camps_description_en !!}</textarea>
                                                        <span class="form-text text-danger"
                                                              id="summer_camps_description_en_error"></span>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.magazine_description_ar')}}</label>
                                                        <textarea class="form-control" rows="4"
                                                                  placeholder="{{trans('landing.enter_magazine_description_ar')}}"
                                                                  name="magazine_description_ar" dir="rtl"
                                                                  id="magazine_description_ar">{!!  staticStrings()->magazine_description_ar !!}</textarea>
                                                        <span class="form-text text-danger"
                                                              id="magazine_description_ar_error"></span>
                                                    </div>
                                                    <!--end::Group-->


                                                    <!--begin::Group-->
                                                    <div class="form-group">
                                                        <label> {{trans('landing.magazine_description_en')}}</label>
                                                        <textarea class="form-control" rows="4"
                                                                  placeholder="{{trans('landing.enter_magazine_description_en')}}"
                                                                  name="magazine_description_en" dir="ltr"
                                                                  id="magazine_description_en">{!!  staticStrings()->magazine_description_en !!}</textarea>
                                                        <span class="form-text text-danger"
                                                              id="magazine_description_en_error"></span>
                                                    </div>
                                                    <!--end::Group-->


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
        //////////////////////////////////////////////////////
        $('#form_static_string_store').on('submit', function (e) {
            e.preventDefault();
            //////////////////////////////////////////////////////////////
            $('#talents_description_ar').css('border-color', '');
            $('#talents_description_en').css('border-color', '');
            $('#soundtrack_description_ar').css('border-color', '');
            $('#soundtrack_description_en').css('border-color', '');
            $('#videos_description_ar').css('border-color', '');
            $('#videos_description_en').css('border-color', '');
            $('#success_stories_description_ar').css('border-color', '');
            $('#success_stories_description_en').css('border-color', '');
            $('#success_story_categories_description_ar').css('border-color', '');
            $('#success_story_categories_description_en').css('border-color', '');
            $('#success_story_description_ar').css('border-color', '');
            $('#success_story_description_en').css('border-color', '');
            $('#success_story_person_description_ar').css('border-color', '');
            $('#success_story_person_description_en').css('border-color', '');
            $('#programs_description_ar').css('border-color', '');
            $('#programs_description_en').css('border-color', '');
            $('#courses_description_ar').css('border-color', '');
            $('#courses_description_en').css('border-color', '');
            $('#contests_description_ar').css('border-color', '');
            $('#contests_description_en').css('border-color', '');
            $('#summer_camps_description_ar').css('border-color', '');
            $('#summer_camps_description_en').css('border-color', '');
            $('#magazine_description_ar').css('border-color', '');
            $('#magazine_description_en').css('border-color', '');
            $('#latest_winners_description_ar').css('border-color', '');
            $('#latest_winners_description_en').css('border-color', '');
            $('#terms_of_registration_for_the_contest_ar').css('border-color', '');
            $('#terms_of_registration_for_the_contest_en').css('border-color', '');


            $('#talents_description_ar_error').text('');
            $('#talents_description_en_error').text('');
            $('#soundtrack_description_ar_error').text('');
            $('#soundtrack_description_en_error').text('');
            $('#videos_description_ar_error').text('');
            $('#videos_description_en_error').text('');
            $('#success_stories_description_ar_error').text('');
            $('#success_stories_description_en_error').text('');
            $('#success_story_categories_description_ar_error').text('');
            $('#success_story_categories_description_en_error').text('');
            $('#success_story_description_ar_error').text('');
            $('#success_story_description_en_error').text('');
            $('#success_story_person_description_ar_error').text('');
            $('#success_story_person_description_en_error').text('');
            $('#programs_description_ar_error').text('');
            $('#programs_description_en_error').text('');
            $('#courses_description_ar_error').text('');
            $('#courses_description_en_error').text('');
            $('#contests_description_ar_error').text('');
            $('#contests_description_en_error').text('');
            $('#summer_camps_description_ar_error').text('');
            $('#summer_camps_description_en_error').text('');
            $('#magazine_description_ar_error').text('');
            $('#magazine_description_en_error').text('');
            $('#latest_winners_description_ar_error').text('');
            $('#latest_winners_description_en_error').text('');
            $('#terms_of_registration_for_the_contest_ar_error').text('');
            $('#terms_of_registration_for_the_contest_en_error').text('');

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
                            customClass: {confirmButton: 'update_static_strings_button'}
                        });
                        $('.update_static_strings_button').click(function () {
                            $('html, body').animate({scrollTop: 5}, 300);
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

