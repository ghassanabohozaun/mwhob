<div class="row justify-content-center">
    @foreach($courses as $course)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="item-course">
                <div class="img-course">
                    <img
                        src="{!! asset(\Illuminate\Support\Facades\Storage::url($course->course_image)) !!}"
                        alt="{!! Lang()=='ar'?$course->title_ar:$course->title_en !!}">
                </div>
                <div class="content-item">
                    <div class="row justify-content-between align-items-center">
                        <div class=" col-auto date-item fs-12">
                            {!! Lang()=='ar'?$course->category->name_ar:$course->category->name_en !!}
                        </div>
                        <div class="col-auto">
                                <span class=" btn bg-warning-light py-1 br-20 text-warning">
                                   {!! $course->hours !!}  {!! trans('site.hours') !!}
                                </span>
                        </div>
                    </div>
                    <div class="fs-16 text-bold my-2 text-dark">
                        {!! Lang()=='ar'?$course->title_ar:$course->title_en !!}
                    </div>
                    <p class="mb-3 fs-12">
                        {!! Lang()=='ar'?$course->description_ar:$course->description_en !!}
                    </p>


                    <div class="row mt-4 mb-4 mx-0 bg-light p-2 br-5">
                        <div class="col-lg-6 px-1">
                            <div class="fs-12">
                                <span>{!! trans('site.start_at') !!}</span>
                                <span dir="{!! Lang()=='ar'?'rtl':'ltr' !!}"> {!! $course->start_at !!} </span>
                            </div>
                        </div>
                        <div class="col-lg-6 px-1">
                            <div class="fs-12">
                                <span>{!! trans('site.end_at') !!}</span>
                                <span dir="{!! Lang()=='ar'?'rtl':'ltr' !!}"> {!! $course->end_at !!} </span>
                            </div>
                        </div>
                    </div>


                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">

                            @if(student()->check())
                                @if( App\Models\MawhobEnrollCourse::where('course_id', $course->id)
                                     ->where('mawhob_id', student()->id())->get()->count() >0)
                                    <a  href="javascript:void(0)"  class="btn btn-primary br-30 text-bold">
                                        {!! trans('site.previously_registered') !!}
                                    </a>
                                @else
                                    <a href="#" class="btn btn-primary br-30 text-bold
                                             auth_student_course_enroll_button"
                                       data-id="{!! $course->id !!}">
                                        {!! trans('site.enroll_now') !!}
                                    </a>
                                @endif
                            @else
                                <a href="#" class="btn btn-primary br-30 text-bold
                                            not_auth_student_course_enroll_button">
                                    {!! trans('site.enroll_now') !!}
                                </a>
                            @endif

                        </div>
                        <div class="col-auto d-flex align-items-center">
                            @if($course->discount!=null || $course->discount!=0)
                                <span class="net-price mr-2">{!! $course->discount !!}$</span>
                                <span class="old-price">{!! $course->cost !!}$</span>
                            @else
                                <span class="my_price">{!! $course->cost !!}$</span>
                            @endif
                        </div>

                    </div>
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
                {{$courses->links('vendor.pagination.bootstrap-4')}}
            </div>
        </div>
    </div>
</section>


@push('js')

    <script type="text/javascript">

        //////////////////////////////////////////////////////////////////////////////////////
        //  Auth Student alert and enroll
        $('body').on('click', '.auth_student_course_enroll_button', function (e) {

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
        $('body').on('click', '.not_auth_student_course_enroll_button', function (e) {
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

