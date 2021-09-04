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

    <section class="py-3 min_height_480">
        <div class=" container">
            <div class="row">


                @include('student.includes.sidebar')

                <div class=" col-lg-9">
                    <div
                        class=" with-screen-titel row justify-content-between align-items-center p-2 br-10 bg-light mx-0 mb-3 mt-3 mt-md-0">
                        <div class="col-auto title-with-icon d-flex align-items-center px-1">
                            <span class="mr-2">
                                   <img src="{!! asset('site/img/profile.png') !!}" width="25">
                            </span>
                            <span
                                class="fs-14 text-bold">{!!  trans('site.update_account') !!}</span>
                        </div>
                    </div>


                    <div class="container">
                        <div class="row">

                            <div class="col-lg-12">
                                <form action="{!! route('student.update.account') !!}" method="POST" enctype="multipart/form-data"
                                      id="student_update_account_form">
                                    @csrf


                                    <div class="row d-none">
                                        <div class="col-lg-6">
                                            <div class="form-group text-left">
                                                <label for="Name" class=" ">ID</label>
                                                <input type="hidden" class="form-control" id="id"
                                                       name="id"
                                                       value="{!! $student->id !!}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group text-left">
                                                <label for="Name" class=" ">{!! trans('site.photo') !!}.</label>
                                                <input type="file" class="form-control" id="photo"
                                                       name="photo">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group text-left">
                                                <label for="Name" class=" ">{!! trans('site.full_name') !!}.</label>
                                                <input type="text" class="form-control" id="mawhob_full_name"
                                                       name="mawhob_full_name" autocomplete="off"
                                                       value="{!! $student->mawhob_full_name !!}"
                                                       placeholder="{!! trans('site.full_name') !!}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group text-left ">
                                                <label for="WhatsApp" class="">
                                                    {!! trans('site.whatsapp_no') !!}.
                                                </label>
                                                <input type="text" class="form-control" autocomplete="off"
                                                       id="mawhob_whatsapp_no" name="mawhob_whatsapp_no"
                                                       value="{!! $student->mawhob_whatsapp_no !!}"
                                                       placeholder="{!! trans('site.whatsapp_no') !!}">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group text-left">
                                                <label for="Birth">{!! trans('site.birthday') !!}</label>
                                                <input type="date" class="form-control" placeholder="dd/mm/yyyy"
                                                       name="mawhob_birthday" id="mawhob_birthday"
                                                       value="{!! $student->mawhob_birthday !!}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group text-left">
                                                <label for="Talent">{!! trans('site.gender') !!}</label>
                                                <select class="form-control" id="mowhob_gender" name="mowhob_gender">
                                                    <option value="">
                                                        {{trans('general.select_from_list')}}
                                                    </option>
                                                    <option value="male"
                                                        {!! $student->mowhob_gender == trans('general.male')?'selected':'' !!}>
                                                        {{trans('general.male')}}
                                                    </option>
                                                    <option value="female"
                                                        {!! $student->mowhob_gender == trans('general.female')?'selected':'' !!}>
                                                        {{trans('general.female')}}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group text-left">
                                                <label for="Talent">{!! trans('site.talent') !!}</label>
                                                <select class="form-control" id="category_id" name="category_id">
                                                    <option value="">--{!! trans('site.select_your_talent') !!}--
                                                    </option>
                                                    @if($categories && $categories->count()>0)
                                                        @foreach($categories as $category)
                                                            <option value="{!! $category->id !!}"
                                                                {{$student->category_id ==old('category_id',  $category->id) ?'selected':''}}>
                                                                @if(Lang()=='ar')
                                                                    {!! $category->name_ar !!}
                                                                @else
                                                                    {!! $category->name_en !!}
                                                                @endif
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group text-left">
                                                <label for="PortfolioInput">{!! trans('site.portfolio_link') !!}</label>
                                                <input type="text" class="form-control"
                                                       id="portfolio" name="portfolio" autocomplete="off"
                                                       placeholder="https:\\www.example.com\..."
                                                       value="{!! $student->portfolio !!}">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group text-left">
                                                <label for="nPassword">{!! trans('site.new_password') !!}</label>
                                                <input type="password" class="form-control"
                                                       id="password" name="password" autocomplete="off"
                                                       placeholder="{!! trans('site.new_password') !!}">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group text-left">
                                                <label
                                                    for="cnPassword">{!! trans('site.confirm_new_password') !!}</label>
                                                <input type="password" class="form-control"
                                                       id="confirm_password" name="confirm_password" autocomplete="off"
                                                       placeholder="{!! trans('site.confirm_new_password') !!}">
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary px-5 br-20">
                                        {!! trans('site.update') !!}
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
    <script src="{{asset('adminBoard/assets/js/jquery.validate.min.js')}}" type="text/javascript"></script>

    <script type="text/javascript">


        $('#student_update_account_form').validate({
            rules: {
                mawhob_full_name: {
                    required: true,
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
                    minlength: 6,
                },
                confirm_password: {
                    minlength: 6,
                    equalTo: "#password"
                }


            },
            messages: {
                mawhob_full_name: {
                    required: '{{trans('site.it_is_required')}}',
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
                    minlength: '{{trans('site.min_length')}}',

                },
                confirm_password: {
                    minlength: '{{trans('site.min_length')}}',
                    equalTo: '{{trans('site.equalTo')}}',
                },
            },
        });

        ////////////////////////////////////////////////////
        $(document).on('submit', 'form', function (e) {
            e.preventDefault();

            //////////////////////////////////////////////////////////////
            $('#photo').css('border-color', '');
            $('#mawhob_full_name').css('border-color', '');
            $('#mawhob_whatsapp_no').css('border-color', '');
            $('#mawhob_birthday').css('border-color', '');
            $('#mowhob_gender').css('border-color', '');
            $('#category_id').css('border-color', '');
            $('#portfolio').css('border-color', '');
            $('#password').css('border-color', '');
            $('#confirm_password').css('border-color', '');

            $('#photo_error').text('');
            $('#mawhob_full_name_error').text('');
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
                            title: data.msg,
                        });
                        setTimeout(function (){
                           window.location.href="{!! route('student.update.account') !!}"
                        },2500);
                    }

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
