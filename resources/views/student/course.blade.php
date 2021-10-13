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

    <section class="py-3">
        <div class=" container">
            <div class="row">
                <div class="col-lg-12">
                    <section>
                        <div class=" container py-4">
                            <div class="course-dt">
                                <div class="cor-img">
                                    <img src="{!! asset(Storage::url($course->course_image)) !!}"
                                         alt="">
                                </div>
                                <div class="row  py-3 mt-4">
                                    <div class="col-md-10">
                                        <div class="text-bold">
                                            {!! Lang()=='ar'?$course->title_ar:$course->title_en !!}
                                        </div>
                                    </div>

                                    <div class="col-auto d-flex align-items-center">
                                        @if($course->discount!=null)
                                            <span class="net-price mr-2">{!! $course->discount !!}$</span>
                                            <span class="old-price">{!! $course->cost !!}$</span>
                                        @else
                                            <span class="my_price">{!! $course->cost !!}$</span>
                                        @endif
                                    </div>

                                </div>
                                <span id="refresh_lecture_date">

                                       <div class="row align-items-center my-4 mx-0 bg-light br-5 p-2">
                                    <div class="col-lg-3 border-right">
                                        <div class="img-text d-flex align-items-center">
                                            <div class="img mr-2">

                                                @if($course->teacher->teacher_photo == null)
                                                    @if($course->teacher->teacher_gender == trans('general.male'))
                                                        <img src="{{asset('adminBoard/images/male.jpeg')}}" alt="">
                                                    @else
                                                        <img src="{{asset('adminBoard/images/female.jpeg')}}" alt="">
                                                    @endif
                                                @else
                                                    <img src="{{asset(Storage::url($course->teacher->teacher_photo))}}"
                                                         alt="">
                                                @endif
                                            </div>
                                            <div class="title">
                                                @if(Lang()=='ar')
                                                    {!! $course->teacher->teacher_full_name !!}
                                                @else
                                                    {!! $course->teacher->teacher_full_name_en !!}
                                                @endif
                                            </div>
                                        </div>

                                    </div>

                                           @if($lecture)


                                               <div class="col-lg-6 my-2 my-md-0">
                                        <span>
                                            <img src="{!! asset('site/img/calendar.svg') !!}" width="30"
                                                 alt=""></span>
                                            <span>
                                            {!! trans('site.next_lecture') !!} :
                                            {!! $lecture->lecture_date !!}
                                            -
                                            {!! trans('general.from') !!}
                                            ({!! $lecture->lecture_from !!})
                                            {!! trans('general.to') !!}
                                            ({!! $lecture->lecture_to !!})
                                        </span>

                                        </div>
                                               <!----------------------- dates ---------------------->
                                               <div class="col-lg-3">
                                            <span>
                                                  @if($lecture->lecture_cancel == 'on')
                                                    <a href="javascript:void(0)"
                                                       class="btn btn-danger w-100 py-2 br-5">
                                                            {!! trans('site.lecture_cancel') !!}
                                                    </a>
                                                @else
                                                    @if($lecture->status == 'on')
                                                        <a href="javascript:void(0)"
                                                           class="btn btn-success w-100 py-2 br-5"
                                                           data-id="{!! $lecture->id !!}"
                                                           id="lecture_attendance_link_btn">
                                                            {!! trans('site.go_to_lecture') !!}
                                                        </a>
                                                    @else
                                                        <a href="javascript:void(0)"
                                                           class="btn btn-warning w-100 py-2 br-5">
                                                            {!! trans('site.lecture_link_no_active') !!}
                                                        </a>
                                                    @endif
                                                @endif
                                            </span>
                                        </div>
                                               <!----------------------- dates ---------------------->
                                           @else
                                               <div class="offset-5 col-lg-4"
                                                    style="color: #a71d2a;font-weight: bolder">
                                                    {!! trans('site.no_lecture_dates_available') !!}
                                               </div>
                                           @endif
                                </div>
                                </span>


                                <!-- begin : Course Details  ----------------------------->

                                <div>
                                    <div class="fs-18 mt-3 text-bold mb-2">{!! trans('site.course_details') !!}</div>
                                    <div class="fs-14 mb-4">
                                        {!! Lang()=='ar'?$course->description_ar:$course->description_en !!}
                                    </div>
                                </div>
                                <!-- end : Course Details  ----------------------------->

                                <!-- begin : Course Lectures Table ----------------------------->
                                <div class="fs-18 mt-5 text-bold mb-3">
                                    {!! trans('site.attendance_and_absence_record') !!}
                                </div>
                                <span id="course_lectures_table">
                                    <div class="table-responsive">
                                        <table class="table"
                                               style="text-align: center;vertical-align: middle; font-size: 14px">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">{!! trans('site.lecture_date') !!}</th>
                                                <th scope="col">{!! trans('site.lecture_from') !!}</th>
                                                <th scope="col">{!! trans('site.lecture_to') !!}</th>
                                                <th scope="col">{!! trans('site.status') !!}</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach(App\Models\Lecture::orderByDesc('created_at')
                                                     ->where('course_id',$course->id)->get()
                                                     as $key=>$lecture)
                                                <tr>
                                                    <td>{!! $key+1 !!}</td>
                                                    <td>
                                                        {!! $lecture->lecture_date !!}
                                                    </td>
                                                    <td>
                                                        {!! $lecture->lecture_from !!}
                                                    </td>
                                                    <td>
                                                        {!! $lecture->lecture_to !!}
                                                    </td>
                                                    <td>
                                                        @if($lecture->lecture_cancel == null)
                                                            @if( App\Models\lecture_mawhob::where('lecture_id',$lecture->id)
                                                               ->where('mawhob_id',student()->id())->value('status') =='on')
                                                                <i class="fa fa-check text-success"></i>
                                                            @else
                                                                <i class="fa fa-times text-danger"></i>
                                                            @endif
                                                        @else
                                                            <span
                                                                class="text-danger text-bold">{!! trans('site.lecture_cancel') !!}</span>
                                                        @endif

                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </span>
                                <!-- end : Course Lectures Table ----------------------------->


                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>

        <input type="hidden" id="course_id" class="d-none" value="{!! $course->id !!}">
        <input type="hidden" id="student_id" class="d-none" value="{!! student()->id() !!}">
        <input type="hidden" id="course_link" class="d-none" value="{!! $course->zoom_link !!}">

    </section>


@endsection

@push('js')
    <script type="text/javascript">
        //////////////////////////////////////////////////////////////
        ///Attendance Enroll In Lecture
        $('body').on('click', '#lecture_attendance_link_btn', function (e) {
            e.preventDefault();
            var course_id = $('#course_id').val();
            var lecture_id = $(this).data('id');
            var student_id = $('#student_id').val();
            var course_link = $('#course_link').val();

            $.ajax({
                url: "{{route('student.attendance.enroll.in.lecture')}}",
                data: {course_id: course_id, lecture_id: lecture_id, student_id: student_id},
                type: 'post',
                dataType: 'JSON',
                success: function (data) {
                    console.log(data);
                    $("#course_lectures_table").load(window.location + " #course_lectures_table");
                    window.open(course_link, '_blank');
                },//end success
            })
        });
    </script>
@endpush
