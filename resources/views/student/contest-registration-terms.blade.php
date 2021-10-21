@extends('layouts.site')
@section('title') {!! trans('site.mawhob') !!} @endsection
@section('metaTags')
    <meta name="description"
          content="{!! Lang()=='ar' ? setting()->site_description_ar : setting()->site_description_en !!}">
    <meta name="keywords"
          content="{!! Lang()=='ar' ? setting()->site_keywords_ar : setting()->site_keywords_en !!}">
    <meta name="application-name" content="{!! Lang()=='ar' ? setting()->site_name_ar : setting()->site_name_en !!}"/>
    <meta name="author" content="{!! Lang()=='ar' ? setting()->site_name_ar : setting()->site_name_en !!}"/>
@endsection

@push('css')
@endpush
@section('content')

    @include('site.includes.orange-header')

    <section class=" content-section py-5 px-4 px-md-0">
        <div class=" container" data-aos="fade-down" data-aos-duration="1500">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-12 ">
                    <div>
                        <h2>
                            {!! trans('site.terms_of_registration_for_the_contest') !!}
                        </h2>
                        <br/>
                        <p>
                            {!! Lang()=='ar'?staticStrings()->terms_of_registration_for_the_contest_ar:staticStrings()->terms_of_registration_for_the_contest_en !!}
                            </h2>
                        </p>
                    </div>
                </div>
            </div>


            <div class="row justify-content-between align-items-center mt-5">

                @if( App\Models\MawhobEnrolledContest::where('contest_id', $id)
                ->where('mawhob_id', student()->id())->get()->count() >0)
                    <div class="col-lg-12">
                        <h2 class="text-danger text-center">
                            {!! trans('site.already_enrolled_in_this_contest') !!}
                        </h2>
                    </div>
                @else
                    <div class="col-lg-6 ">

                        <form action="{!! route('student.enroll.contest') !!}"
                              method="POST" enctype="multipart/form-data"
                              id="contest_enroll_form">
                            @csrf

                            <div class="form-group text-left d-none">
                                <input type="hidden" class="form-control"
                                       id="contest_id" name="contest_id" value="{!! $id !!}">
                            </div>

                            <div class="form-group text-left d-none">
                                <input type="hidden" class="form-control"
                                       id="mawhob_id" name="mawhob_id" value="{!! student()->id() !!}">
                            </div>

                            <div class="form-group text-left">
                                <label for="PortfolioInput">{!! trans('site.link') !!}.</label>
                                <input type="text" class="form-control"
                                       id="link" name="link" autocomplete="off"
                                       placeholder="https:\\www.example.com\...">
                            </div>


                            <div class="form-group text-left">
                                <label for="PortfolioInput">{!! trans('site.file') !!}.</label>
                                <input type="file" class="form-control"
                                       id="file" name="file" autocomplete="off">
                            </div>

                            <button type="submit" class="btn btn-primary px-5 br-20">
                                {!! trans('site.enroll_now') !!}
                            </button>

                        </form>

                    </div>
                @endif


            </div>
        </div>
    </section>

@endsection
@push('js')
    <script src="{{asset('adminBoard/assets/js/jquery.validate.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        $('#contest_enroll_form').validate({
            rules: {

                link: {
                    required: '#file:blank',
                    url: true,
                },
                file: {
                    required: '#link:blank',
                },
            },
            messages: {
                link: {
                    required: '{{trans('site.it_is_required')}}',
                    url: '{{trans('site.url')}}',
                },
                file: {
                    required: '{{trans('site.it_is_required')}}',
                },

            },
        });

        ////////////////////////////////////////////////////
        $(document).on('submit', 'form', function (e) {
            e.preventDefault();
            //////////////////////////////////////////////////////////////
            $('#link').css('border-color', '');
            $('#file').css('border-color', '');

            $('#link_error').text('');
            $('#file_error').text('');
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
                            window.location.href = "{!! route('contests') !!}";
                        }, 2500)
                    } else {
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
                            window.location.href = "{!! route('contests') !!}";
                        }, 2500)
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
