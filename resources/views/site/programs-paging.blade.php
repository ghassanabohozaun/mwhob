<div class="row justify-content-center">
    @foreach($programs as $program)
        <div class="col-lg-6 col-md-6 mb-6">
            <div class="box-program p-4 br-5">
                <div class="row align-items-center justify-content-between mb-3">
                    <div class="col-auto">
                        <img src="{!! asset(Storage::url($program->icon)) !!}"
                             width="60" alt="">
                    </div>
                    <div class="col-auto text-center">
                        <h2 class=" text-bold">{!! $program->hours !!}</h2>
                        <div class=" fs-14">{!! trans('site.hours') !!}</div>
                    </div>
                </div>
                <div class="title-pr fs-18 text-bold mt-4">
                    {!! Lang()=='ar'?$program->name_ar:$program->name_en !!}
                </div>
                <p class="mt-3">
                    {!! Lang()=='ar'?$program->short_description_ar:$program->short_description_en !!}
                </p>

                <div class="row mt-3 mx-0 bg-light p-2 br-5">
                    <div class="col-lg-6 px-1">
                        <div class="fs-12">
                            <span>{!! trans('site.start_at') !!}</span>
                            <span dir="{!! Lang()=='ar'?'rtl':'ltr' !!}"> {!! $program->start_at !!} </span>
                        </div>
                    </div>
                    <div class="col-lg-6 px-1">
                        <div class="fs-12">
                            <span>{!! trans('site.end_at') !!}</span>
                            <span dir="{!! Lang()=='ar'?'rtl':'ltr' !!}"> {!! $program->end_at !!} </span>
                        </div>
                    </div>
                </div>

                <div class="work-plan text-bold fs-16 mt-4 mb-2">{!! trans('site.work_plane') !!}</div>
                <div
                    class="file-link d-flex justify-content-between align-items-center   px-2 py-2 br-5">
                    <div class="fs-14">
                        <img src="{!! asset('site/img/pdf-file.svg') !!}" width="16" alt="">
                        <span class=" d-inline-block ">
                            {!! trans('site.download_work_plane') !!}
                        </span>
                    </div>
                    <div class="download">
                        <a href="{!! asset(Storage::url($program->work_plan)) !!}"
                           target="_blank">
                            <i class="far fa-arrow-alt-circle-down text-dark">
                            </i>
                        </a>
                    </div>
                </div>
                <div class="mt-4 text-center">


                    @if(student()->check())
                        <a href="#" class=" btn btn-primary br-30  w-75 auth_student_program_enroll_button"
                           data-id="{!! $program->id !!}">
                            <div class=" d-flex align-items-center justify-content-between">
                                <div>{!! trans('site.enroll_now') !!}</div>
                                <div>{!! $program->price !!}$</div>
                            </div>
                        </a>
                    @else
                        <a href="#" class=" btn btn-primary br-30  w-75 not_auth_student_program_enroll_button">
                            <div class=" d-flex align-items-center justify-content-between">
                                <div>{!! trans('site.enroll_now') !!}</div>
                                <div>{!! $program->price !!}$</div>
                            </div>
                        </a>
                    @endif


                </div>
            </div>
        </div>
    @endforeach

    <div class="d-none">
        @if(student()->check())
            <input type="hidden" id="mawhob_id" value="{!! student()->user()->id !!}"/>
        @endif
    </div>
</div>


<section class="content-section">
    <div class="container">
        <div class="row">
            <div class="pagination_section">
                {{$programs->links('vendor.pagination.bootstrap-4')}}
            </div>
        </div>
    </div>
</section>



@push('js')

    <script type="text/javascript">

        //////////////////////////////////////////////////////////////////////////////////////
        //  Auth Student alert and enroll
        $('body').on('click', '.auth_student_program_enroll_button', function (e) {

            var program_id = $(this).data('id');
            var mawhob_id = $('#mawhob_id').val();
            e.preventDefault();
            Swal.fire({
                title: '{!! trans('site.do_you_want_to_enroll_in_program') !!}',
                allowOutsideClick: false,
                showDenyButton: false,
                showCancelButton: true,
                cancelButtonText: `{!! trans('site.cancel') !!}`,
                confirmButtonText: `{!! trans('site.ok') !!}`,
                customClass: {confirmButton: 'ok_enroll_in_program_button'}

            });
            $('.ok_enroll_in_program_button').click(function () {

                /////////////////////////////////////////////////////////////
                // enroll Student
                $.ajax({
                    url: '{!! route('student.enroll.program') !!}',
                    data: {program_id: program_id, mawhob_id: mawhob_id},
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        console.log();
                        if (data.status == true) {
                            Swal.fire({
                                title: data.msg,
                                allowOutsideClick: false,
                                showDenyButton: false,
                                showCancelButton: false,
                                showConfirmButton: true,
                                confirmButtonText: `{!! trans('site.ok') !!}`,
                            });

                            /////////////////////////////////////////////////////////////
                            // reload student notifications
                            $('#student_notify_section').load("{!! route('student.get.notifications') !!}");
                            $(".student_notifications_count").load(location.href + " .student_notifications_count");



                        } else {
                            Swal.fire({
                                title: data.msg,
                                allowOutsideClick: false,
                                showDenyButton: false,
                                showCancelButton: false,
                                showConfirmButton: true,
                                confirmButtonText: `{!! trans('site.ok') !!}`,
                            });
                        }
                    }
                }); // end ajax

            });

        });


        //////////////////////////////////////////////////////////////////////////////////////
        // Not Auth Student alert
        $('body').on('click', '.not_auth_student_program_enroll_button', function (e) {
            e.preventDefault();
            Swal.fire({
                title: '{!! trans('site.sign_in_firstly') !!}',
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
        });


    </script>

@endpush

