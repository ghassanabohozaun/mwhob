<section class="contact-us mb-5" id="contactUs">
    <div class=" container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-5">
                <h2 class=" text-bold text-center mb-3">{!! trans('site.be_in_touch') !!}</h2>
                <form method="POST" enctype="multipart/form-data" action="{!! route('send.contact.message') !!}"
                      id="form_contact_message_send">
                    @csrf

                    <div class="form-group">
                        <input type="text" class="form-control"
                               id="customer_name" name="customer_name" autocomplete="off"
                               placeholder="{!! trans('site.full_name') !!}">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control"
                               id="customer_email" name="customer_email" autocomplete="off"
                               placeholder="{!! trans('site.email') !!}">
                    </div>


                    <div class="form-group">
                        <input type="text" class="form-control"
                               id="title" name="title" autocomplete="off"
                               placeholder="{!! trans('site.title') !!}">
                    </div>


                    <div class="form-group">
                        <textarea class="form-control" rows="3"
                                  id="message" name="message" autocomplete="off"
                                  placeholder="{!! trans('site.message') !!}"></textarea>
                    </div>


                    <div class="form-group">
                        <div class="captcha">
                            <span>{!! captcha_img() !!}</span>
                            <button type="button" class="btn btn-primary" class="reload" id="reload">
                                &#x21bb;
                            </button>
                        </div>

                        <div class="form-group mb-4">
                            <input id="captcha" type="text" class="form-control"
                                   placeholder="{!! trans('site.enter_captcha') !!}"
                                   name="captcha"  autocomplete="off">
                            <span class="form-text text-danger"
                                  id="captcha_error"></span>
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary w-50 br-10">
                            {!! trans('site.send') !!}
                        </button>
                    </div>
                </form>


            </div>
        </div>
    </div>
</section>
@push('js')

    <script src="{{asset('adminBoard/assets/js/jquery.validate.min.js')}}" type="text/javascript"></script>

    <script type="text/javascript">

        $('#reload').click(function () {
            $.ajax({
                type: 'GET',
                url: 'reload-captcha',
                success: function (data) {
                    $(".captcha span").html(data.captcha);
                }
            });
        });

        function reloadCaptcha() {
            $.ajax({
                type: 'GET',
                url: 'reload-captcha',
                success: function (data) {
                    $(".captcha span").html(data.captcha);
                }
            });
        }

        /////////////////////////////////////////////////////////////////////
        // Validation
        $('#form_contact_message_send').validate({
            rules: {
                customer_name: {
                    required: true,
                },
                customer_email: {
                    required: true,
                    email: true
                },
                title: {
                    required: true,
                },
                message: {
                    required: true,
                },
                captcha: {
                    required: true,
                },
            },
            messages: {
                customer_name: {
                    required: '{{trans('site.it_is_required')}}',
                },
                customer_email: {
                    required: '{{trans('site.it_is_required')}}',
                    email: '{{trans('site.email_email')}}',
                },
                title: {
                    required: '{{trans('site.it_is_required')}}',
                },
                message: {
                    required: '{{trans('site.it_is_required')}}',
                },
                captcha: {
                    required: '{{trans('site.it_is_required')}}',
                },
            },
        });

        ////////////////////////////////////////////////////
        $(document).on('submit', 'form', function (e) {
            e.preventDefault();
            //////////////////////////////////////////////////////////////
            $('#customer_name').css('border-color', '');
            $('#customer_email').css('border-color', '');
            $('#title').css('border-color', '');
            $('#message').css('border-color', '');
            $('#captcha').css('border-color', '');
            $('#captcha').css('border-color', '');
            $('#captcha').css('border-color', '');


            $('#customer_name_error').text('');
            $('#customer_email_error').text('');
            $('#title_error').text('');
            $('#message_error').text('');
            $('#captcha_error').text('');
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
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })
                        Toast.fire({
                            icon: 'success',
                            title: data.msg
                        })
                    }
                    $('#form_contact_message_send')[0].reset();
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
