<section class="best-courses py-5 mb-5">
    <div class="container">
        <div class=" text-center">
            <h2 class=" text-bold mb-3" data-aos="fade-down" data-aos-duration="1800">
                {!! trans('site.best_courses') !!}
            </h2>
            <p data-aos="fade-up" data-aos-duration="1500">
                {!! Lang()=='ar'?indexPage()->best_courses_description_ar:indexPage()->best_courses_description_en !!}
            </p>
        </div>
        @if($courses->isEmpty())
            <img src="{!! asset('site/images/noRecordFound.svg') !!}"
                 class="img-fluid" id="no_data_img" title="{!! trans('site.no_date') !!}">

        @else
            <div class="row mt-5 justify-content-center">
                @foreach($courses as $course)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="item-course " data-aos="fade-in" data-aos-duration="1200">
                            <div class="img-course">
                                <img src="{!! asset(Storage::url($course->course_image)) !!}"
                                    alt="">
                            </div>
                            <div class="content-item">
                                <h4 class="title-course my-2">{!! Lang()=='ar'?$course->title_ar:$course->title_en !!}</h4>
                                <p class="mb-4">
                                    {!! Lang()=='ar'?$course->description_ar:$course->description_en !!}
                                </p>
                                <div class="row justify-content-between align-items-center">


                                    <div class="col-auto d-flex align-items-center">
                                        @if($course->discount!=null || $course->discount!=0)
                                            <span class="net-price mr-2">{!! $course->discount !!}$</span>
                                            <span class="old-price">{!! $course->cost !!}$</span>
                                        @else
                                            <span class="my_price">{!! $course->cost !!}$</span>
                                        @endif
                                    </div>

                                    <div class="col-auto">

                                        @if(student()->check())
                                            @if( App\Models\MawhobEnrollCourse::where('course_id', $course->id)
                                                 ->where('mawhob_id', student()->id())->get()->count() >0)
                                                <a  href="javascript:void(0)"  class="btn btn-primary br-30 text-bold">
                                                    {!! trans('site.previously_registered') !!}
                                                </a>
                                            @else
                                                <a href="#" class="btn btn-primary br-30 text-bold
                                                             auth_student_best_course_enroll_button"
                                                   data-id="{!! $course->id !!}">
                                                    {!! trans('site.enroll_now') !!}
                                                </a>
                                            @endif
                                        @else
                                            <a href="#" class="btn btn-primary br-30 text-bold
                                            not_auth_student_best_course_enroll_button">
                                                {!! trans('site.enroll_now') !!}
                                            </a>
                                        @endif


                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>


    <div class="d-none">
        @if(student()->check())
            <input type="hidden" id="mawhob_id" value="{!! student()->user()->id !!}"/>
        @endif
    </div>

</section>


@push('js')

    <script type="text/javascript">

        //////////////////////////////////////////////////////////////////////////////////////
        //  Auth Student alert and enroll
        $('body').on('click', '.auth_student_best_course_enroll_button', function (e) {

            var course_id = $(this).data('id');
            var mawhob_id = $('#mawhob_id').val();
            e.preventDefault();
            Swal.fire({
                icon: 'question',
                title: '{!! trans('site.do_you_want_to_enroll_in_course') !!}',
                allowOutsideClick: false,
                showDenyButton: false,
                showCancelButton: true,
                cancelButtonText: `{!! trans('site.cancel') !!}`,
                confirmButtonText: `{!! trans('site.ok') !!}`,
                customClass: {confirmButton: 'ok_enroll_in_course_button'}

            });
            $('.ok_enroll_in_course_button').click(function () {
                window.location.href = "{!! route('student.course.checkout') !!}" + '/' + course_id;
            });

        });


        //////////////////////////////////////////////////////////////////////////////////////
        // Not Auth Student alert
        $('body').on('click', '.not_auth_student_best_course_enroll_button', function (e) {
            e.preventDefault();
            Swal.fire({
                icon:'info',
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
