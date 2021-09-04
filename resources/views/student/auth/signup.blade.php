@extends('layouts.student')
@section('title') {!! trans('site.mawhob') !!} @endsection
@section('metaTags')
    <meta name="description"
          content="{!! Lang()=='ar' ? setting()->site_description_ar : setting()->site_description_en !!}">
    <meta name="keywords"
          content="{!! Lang()=='ar' ? setting()->site_keywords_ar : setting()->site_keywords_en !!}">
    <meta name="application-name" content="{!! Lang()=='ar' ? setting()->site_name_ar : setting()->site_name_en !!}"/>
    <meta name="author" content="{!! Lang()=='ar' ? setting()->site_name_ar : setting()->site_name_en !!}"/>
@endsection

@section('content')

    <section class="c-panel">
        <div class="  ">

            <div class="row mx-0 ">

                <!-- begin:left ------------------------------------------------------------->
                <div class="col-lg-6 px-0 left-background-login d-none d-lg-block ">
                    <div class="img-left-login ">
                        <img src="{!! asset('site/img/img-login.jpg') !!}" class=" uk-background-fixed" width="100%"
                             alt="">
                    </div>
                </div>
                <!-- end:left ------------------------------------------------------------->


                <!-- begin:right ------------------------------------------------------------->
                <div class="col-lg-6 d-flex align-items-center block-login">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="  p-5 text-center">
                                <div class="title-block-login text-bold text-warning fs-24">
                                    {!! trans('site.signup_as_mawhoob') !!}
                                </div>

                                <form action="{!! route('student.signup.store') !!}"
                                      style="width: 420px"
                                      method="POST" enctype="multipart/form-data"
                                      id="student_signup_form">
                                    @csrf

                                    <div class="form-group text-left mt-4 ">
                                        <label for="Name" class=" ">{!! trans('site.full_name') !!}.</label>
                                        <input type="text" class="form-control" id="mawhob_full_name"
                                               name="mawhob_full_name" autocomplete="off"
                                               placeholder="{!! trans('site.full_name') !!}">
                                    </div>


                                    <div class="form-group text-left">
                                        <label for="Mobile" class=" ">{!! trans('site.mobile_no') !!}.</label>
                                        <input type="text" class="form-control" autocomplete="off"
                                               id="mawhob_mobile_no" name="mawhob_mobile_no"
                                               placeholder="{!! trans('site.mobile_no') !!}">
                                    </div>


                                    <div class="form-group text-left ">
                                        <label for="WhatsApp" class="">
                                            {!! trans('site.whatsapp_no') !!}.
                                        </label>
                                        <input type="text" class="form-control" autocomplete="off"
                                               id="mawhob_whatsapp_no" name="mawhob_whatsapp_no"
                                               placeholder="{!! trans('site.whatsapp_no') !!}">
                                    </div>


                                    <div class="form-group text-left">
                                        <label for="Birth">{!! trans('site.birthday') !!}</label>
                                        <input type="date" class="form-control" placeholder="dd/mm/yyyy"
                                               name="mawhob_birthday" id="mawhob_birthday">
                                    </div>

                                    <div class="form-group text-left">
                                        <label for="Talent">{!! trans('site.gender') !!}</label>
                                        <select class="form-control" id="mowhob_gender" name="mowhob_gender">
                                            <option value="">
                                                {{trans('general.select_from_list')}}
                                            </option>
                                            <option value="male">
                                                {{trans('general.male')}}
                                            </option>
                                            <option value="female">
                                                {{trans('general.female')}}
                                            </option>
                                        </select>
                                    </div>


                                    <div class="form-group text-left">
                                        <label for="Talent">{!! trans('site.talent') !!}</label>
                                        <select class="form-control" id="category_id" name="category_id">
                                            <option value="">--{!! trans('site.select_your_talent') !!}--</option>
                                            @foreach($categories as $category)
                                                <option value="{!! $category->id !!}">
                                                    {!! Lang()=='ar'?$category->name_ar:$category->name_en !!}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="form-group text-left">
                                        <label for="PortfolioInput">{!! trans('site.portfolio_link') !!}</label>
                                        <input type="text" class="form-control"
                                               id="portfolio" name="portfolio" autocomplete="off"
                                               placeholder="https:\\www.example.com\...">
                                    </div>


                                <!--
                                    <div class="form-group text-left">
                                        <div class="js-upload uk-placeholder d-flex p-3 align-items-center bg-light">
                                            <div class="mr-2">
                                                <img width="60" src="{!! asset('site/img/uplod-icon.png') !!}"
                                                     alt="">
                                            </div>
                                            <div>
                                                <div
                                                    class="fs-18-i">{!! trans('site.drag_and_drop_files_here') !!}</div>
                                                <div
                                                    class="fs-12-i">{!! trans('site._upload_files_manual_max_5_files') !!}</div>
                                                <div uk-form-custom>
                                                    <input type="file" multiple>
                                                    <span class="uk-link">{!! trans('site.selecting_one') !!}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <progress id="js-progressbar" class="uk-progress" value="0" max="100"
                                                  hidden>
                                        </progress>

                                    </div>
                                    -->


                                    <div class="form-group text-left">
                                        <label for="nPassword">{!! trans('site.new_password') !!}</label>
                                        <input type="password" class="form-control"
                                               id="password" name="password" autocomplete="off"
                                               placeholder="{!! trans('site.new_password') !!}">
                                    </div>

                                    <div class="form-group text-left">
                                        <label for="cnPassword">{!! trans('site.confirm_new_password') !!}</label>
                                        <input type="password" class="form-control"
                                               id="confirm_password" name="confirm_password" autocomplete="off"
                                               placeholder="{!! trans('site.confirm_new_password') !!}">
                                    </div>


                                    <div class="form-group  text-left">
                                        {!! trans('site.already_has_an_account') !!} ?
                                        <a href="{!! route('get.student.login') !!}"
                                           class=" text-dark text-bold">
                                            {!! trans('site.login') !!}
                                        </a>
                                    </div>

                                    <button type="submit" class="btn btn-primary px-5 br-20">
                                        {!! trans('site.signup') !!}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end:right ------------------------------------------------------------->
            </div>
        </div>
    </section>


@endsection
@push('js')
    <script src="{{asset('adminBoard/assets/js/jquery.validate.min.js')}}" type="text/javascript"></script>

    <script type="text/javascript">


        $('#student_signup_form').validate({
            rules: {
                mawhob_full_name: {
                    required: true,
                },
                mawhob_mobile_no: {
                    required: true,
                    digits: true,
                    minlength: 10,
                    maxlength: 10

                },
                mawhob_whatsapp_no: {
                    required: true,
                },
                mawhob_birthday: {
                    required: true,
                },
                mowhob_gender: {
                    required: true,
                },
                category_id: {
                    required: true,
                },
                portfolio: {
                    required: true,
                },
                password: {
                    required: true,
                    minlength: 6,
                },
                confirm_password: {
                    required: true,
                    minlength: 6,
                    equalTo: "#password"
                }


            },
            messages: {
                mawhob_full_name: {
                    required: '{{trans('site.it_is_required')}}',
                },
                mawhob_mobile_no: {
                    required: '{{trans('site.it_is_required')}}',
                    digits: '{{trans('site.digits')}}',
                    minlength: '{{trans('site.mobile_number_validation')}}',
                    maxlength: '{{trans('site.mobile_number_validation')}}',

                },
                mawhob_whatsapp_no: {
                    required: '{{trans('site.it_is_required')}}',
                },
                mawhob_birthday: {
                    required: '{{trans('site.it_is_required')}}',
                },
                mowhob_gender: {
                    required: '{{trans('site.it_is_required')}}',
                },
                category_id: {
                    required: '{{trans('site.it_is_required')}}',
                },
                portfolio: {
                    required: '{{trans('site.it_is_required')}}',
                },
                password: {
                    required: '{{trans('site.it_is_required')}}',
                    minlength: '{{trans('site.min_length')}}',

                },
                confirm_password: {
                    required: '{{trans('site.it_is_required')}}',
                    minlength: '{{trans('site.min_length')}}',
                    equalTo: '{{trans('site.equalTo')}}',

                },
            },
        });

        ////////////////////////////////////////////////////
        $(document).on('submit', 'form', function (e) {
            e.preventDefault();

            //////////////////////////////////////////////////////////////
            $('#mawhob_full_name').css('border-color', '');
            $('#mawhob_mobile_no').css('border-color', '');
            $('#mawhob_whatsapp_no').css('border-color', '');
            $('#mawhob_birthday').css('border-color', '');
            $('#mowhob_gender').css('border-color', '');
            $('#category_id').css('border-color', '');
            $('#portfolio').css('border-color', '');
            $('#password').css('border-color', '');
            $('#confirm_password').css('border-color', '');


            $('#mawhob_full_name_error').text('');
            $('#mawhob_mobile_no_error').text('');
            $('#mawhob_whatsapp_no_error').text('');
            $('#mawhob_birthday_error').text('');
            $('#mowhob_gender_error').text('');
            $('#category_id_error').text('');
            $('#portfolio_error').text('');
            $('#password_error').text('');
            $('#confirm_password_error').text('');


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

                },
                success: function (data) {
                    console.log(data);
                    if (data.status == true) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top',
                            showConfirmButton: false,
                            timer: 2500,
                            timerProgressBar: false,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })
                        Toast.fire({
                            icon: 'success',
                            title: data.msg
                        })
                        setTimeout(function (){
                            window.location.href = "{!! route('get.student.login') !!}";
                        },2505)
                    } else {

                        Swal.fire({
                            title: data.msg,
                            icon: "warning",
                            allowOutsideClick: false,
                            showDenyButton: false,
                            showCancelButton: true,
                            cancelButtonText: `{!! trans('site.cancel') !!}`,
                            confirmButtonText: `{!! trans('site.login') !!}`,
                            customClass: {confirmButton: 'login_button'}

                        });
                        $('.login_button').click(function () {
                            window.location.href = "{!! route('get.student.login') !!}";
                        });

                    }//end else
                    // $('#student_signup_form')[0].reset();
                },

                error: function (reject) {
                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function (key, value) {
                        $('#' + key + '_error').text(value[0]);
                        $('#' + key).css('border-color', 'red');
                    });
                },
                complete: function () {
                },
            })

        });//end submit
    </script>
@endpush
