@extends('layouts.student')
@section('title') {!! trans('site.registration_confirmation') !!} @endsection
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
        <div class="">


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

                <div class="col-lg-6">
                    <div class="row justify-content-center">
                        <div class="col-lg-10 opt_send_section">
                            <div class="p-5 text-center ">
                                <div class="title-block-login text-bold text-warning fs-24 ">
                                    {!! trans('site.registration_confirmation') !!}
                                </div>
                                <div class="fs-12 my-3">
                                    {!! trans('site.registration_confirmation_message') !!}
                                </div>
                                <form>


                                    <!-------------------------------------------------------------------->
                                    <input value="{!! $mobileNo !!}" name="mobile_no_parameter" id="mobile_no_parameter"
                                           type='hidden' class="d-none">
                                    <br/>
                                    <input value="{!! $whatsappNo !!}" name="whatsapp_no_parameter"
                                           id="whatsapp_no_parameter"
                                           type='hidden' class="d-none">
                                    <!-------------------------------------------------------------------->


                                    <div class="form-group text-left mt-4">
                                        <label for="phone_number" class=" ">{!! trans('site.mobile_no') !!}</label>
                                        <input type="text" class="form-control" name="phone_number" id="phone_number"
                                               placeholder="+972599000000" value="{!! $whatsappNo !!}">
                                    </div>

                                    <div id="recaptcha-container" style="margin-top: 10px"></div>

                                    <button type="button" class="btn btn-primary px-5 br-20" id="sendOTPBtn">
                                        {!! trans('site.send') !!}
                                    </button>

                                </form>
                            </div>
                        </div>


                        <div class="col-lg-10 opt_verify_section">
                            <div class="p-5 text-center ">
                                <div class="title-block-login text-bold text-warning fs-24 ">
                                    {!! trans('site.validation_code') !!}
                                </div>
                                <div class="fs-12 my-3">
                                    {!! trans('site.validation_code_message') !!}
                                </div>
                                <form>
                                    <div class="form-group text-left mt-4">
                                        <label for="verify_code" class=" ">{!! trans('site.validation_code') !!}</label>
                                        <input type="number" class="form-control" name="verify_code" id="verify_code"
                                               placeholder="{!! trans('site.enter_validation_code') !!}">
                                    </div>

                                    <button type="button" class="btn btn-primary px-5 br-20" id="verifyOTPBtn">
                                        {!! trans('site.validation') !!}
                                    </button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>





@endsection
@push('js')

    <script type="text/javascript">


        $('.opt_verify_section').addClass('d-none');

        //////////////////////////////////////////////////////////////////////////////////////////////////////
        //recaptcha
        window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
            'size': 'normal',
            'callback': (response) => {
                // reCAPTCHA solved, allow signInWithPhoneNumber.
                // ...
            },
            'expired-callback': () => {
                // Response expired. Ask user to solve reCAPTCHA again.
                // ...
            }
        });

        //////////////////////////////////////////////////////////////////////////////////////////////////////
        //send OTP Btn
        $("#sendOTPBtn").click(function () {

            const phoneNumber = $("[name=phone_number]").val();

            if (phoneNumber == '') {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top',
                    showConfirmButton: false,
                    timer: 5000,
                    timerProgressBar: false,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })
                Toast.fire({
                    icon: 'warning',
                    title: "{!! trans('site.please_enter_valid_mobile_number') !!}"
                })
                return
            }


            const appVerifier = window.recaptchaVerifier;
            firebase.auth().signInWithPhoneNumber(phoneNumber, appVerifier)
                .then((confirmationResult) => {
                    // SMS sent. Prompt user to type the code from the message, then sign the
                    // user in with confirmationResult.confirm(code).
                    window.confirmationResult = confirmationResult;
                    $('.opt_send_section').addClass('d-none');
                    $("#recaptcha-container").addClass('d-none');
                    // now show otp field
                    $(".opt_verify_section").removeClass('d-none');
                }).catch((error) => {
                // Error; SMS not sent

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top',
                    showConfirmButton: false,
                    timer: 5000,
                    timerProgressBar: false,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })
                Toast.fire({
                    icon: 'warning',
                    title: "{!! trans('site.please_verify_the_mobile_number') !!}"
                })
                // ...
            });


        })


        //////////////////////////////////////////////////////////////////////////////////////////////////////
        // now verify otp
        $("#verifyOTPBtn").click(function () {

                //////////////////////////////////////////////////////////////////////////////
                // check enter verify code
                const verifyCode = $("[name=verify_code]").val();

                if (verifyCode == '') {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top',
                        showConfirmButton: false,
                        timer: 5000,
                        timerProgressBar: false,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })
                    Toast.fire({
                        icon: 'warning',
                        title: "{!! trans('site.please_enter_validation_code') !!}"
                    })
                    return
                }


                // verify
                const code = $("[name=verify_code]").val();
                confirmationResult.confirm(code).then((result) => {
                    // User signed in successfully.
                    const user = result.user;

                    ////////////////////////////////////////////////////////////////////////////////
                    ////////// make student active
                    var mobile_no = $("[name=mobile_no_parameter]").val();
                    $.ajax({
                        url: "{{route('student.active.student')}}",
                        data: {mobile_no: mobile_no},
                        type: 'post',
                        dataType: 'JSON',
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
                                setTimeout(function () {
                                    window.location.href = "{!! route('get.student.login') !!}";
                                }, 2505)
                            }
                        },//end success
                    });//end ajax
                    ////////////////////////////////////////////////////////////////////////////////

                }).catch((error) => {
                    // User couldn't sign in (bad verification code?)
                    // ...
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
                        title: "{!! trans('site.bad_verification_code') !!}"
                    })
                });


            }
        )


    </script>
@endpush
