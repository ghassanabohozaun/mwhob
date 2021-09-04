<div class="row">
    @foreach($studentCourses as $studentCourse)
        <div class="col-lg-6 col-md-6 mb-6">
            <div class="item-course small-h-img">
                <div class="img-course">
                    <img src="{!! asset(Storage::url($studentCourse->course->course_image)) !!}" alt="">
                </div>
                <div class="content-item">
                    <div class="row justify-content-between align-items-center">
                        <div class=" col-auto date-item fs-12">
                            {!! Lang()=='ar'?$studentCourse->course->category->name_ar:$studentCourse->course->category->name_en !!}
                        </div>
                        <div class="col-auto"><span
                                class=" btn bg-warning-light py-1 br-20 text-warning">
                                {!! $studentCourse->course->hours !!}
                                {!! trans('site.hours') !!}
                            </span>
                        </div>
                    </div>
                    <div class="fs-16 text-bold my-2 text-dark">
                        <a href="{!! route('get.student.course',$studentCourse->course->id) !!}">
                            {!! Lang()=='ar'?$studentCourse->course->title_ar:$studentCourse->course->title_en !!}

                        </a>
                    </div>
                    <p class="mb-3 fs-12">
                        {!! Lang()=='ar'?$studentCourse->course->description_ar:$studentCourse->course->description_en !!}
                    </p>

                </div>
            </div>
        </div>
    @endforeach

</div>


<section class="content-section">
    <div class="container">
        <div class="row">
            <div class="pagination_section">
                {{$studentCourses->links('vendor.pagination.bootstrap-4')}}
            </div>
        </div>
    </div>
</section>
