<!--begin::Advance Table: Widget 7-->
<div class="card card-custom gutter-b">
    <!--begin::Header-->
    <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-dark">{!! trans('mowhob.enrolled_courses') !!}</span>
        </h3>
    </div>
    <!--end::Header-->

    <!--begin::Body-->
    <div class="card-body py-2" style="overflow:auto; height: 300px">
        <div class="container-fluid">
            <div class="row">
                <div class="table-responsive">
                    @if($mawhobEnrollCourses->isEmpty())
                        <img src="{!! asset('site/images/noRecordFound.svg') !!}"
                             class="img-fluid" id="no_data_img" title="{!! trans('site.no_date') !!}">
                    @else

                        <table class="table" style="text-align: center;vertical-align: middle;">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{!! trans('courses.title_ar') !!}</th>
                                <th scope="col">{!! trans('courses.title_en') !!}</th>
                                <th scope="col">{!! trans('courses.hours') !!}</th>
                                <th scope="col">{!! trans('courses.cost') !!}</th>
                                <th scope="col">{!! trans('courses.discount') !!}</th>
                                <th scope="col">{!! trans('courses.total_of_course_lectures') !!}</th>
                                <th scope="col">{!! trans('courses.mawhob_lectures_number') !!}</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($mawhobEnrollCourses as $key=>$mawhobEnrollCourse)
                                <tr>
                                    <td>{!! $key+1 !!}</td>
                                    <td>{!! $mawhobEnrollCourse->course->title_ar !!}</td>
                                    <td>{!! $mawhobEnrollCourse->course->title_en !!}</td>
                                    <td>{!! $mawhobEnrollCourse->course->hours !!}</td>
                                    <td>{!! $mawhobEnrollCourse->course->cost !!}</td>
                                    <td>
                                        @if($mawhobEnrollCourse->course->discount== null ||$mawhobEnrollCourse->course->discount== 0 )
                                            {!! $mawhobEnrollCourse->course->cost !!}
                                        @else
                                            {!! $mawhobEnrollCourse->course->discount !!}
                                        @endif
                                    </td>
                                    <td>
                                        {!!  App\Models\Lecture::where('course_id',$mawhobEnrollCourse->course_id)
                                               ->where('lecture_cancel',null)->count()!!}
                                    </td>
                                    <td>
                                        {!!App\Models\lecture_mawhob::where('course_id',$mawhobEnrollCourse->course_id)
                                                  ->where('mawhob_id',$mawhobEnrollCourse->mawhob_id)
                                                  ->count()!!}
                                    </td>


                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    @endif
                </div>

            </div>
        </div>
    </div>
    <!--end::Body-->
</div>
<!--end::Advance Table Widget 7-->
