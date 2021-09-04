<!--begin::Advance Table: Widget 7-->
<div class="card card-custom gutter-b">
    <!--begin::Header-->
    <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-dark">{!! trans('teachers.courses') !!}</span>
        </h3>
    </div>
    <!--end::Header-->

    <!--begin::Body-->
    <div class="card-body py-2" style="overflow:auto; height: 300px">
        <div class="container-fluid">
            <div class="row">
                <div class="table-responsive">
                    @if($courses->isEmpty())
                        <h4 class="text-warning font-weight-bold">
                            <img src="{!! asset('site/images/noRecordFound.svg') !!}"
                                 class="img-fluid" id="no_data_img"
                                 title="{!! trans('site.no_date') !!}">
                        </h4>
                    @else
                        <table class="table" style="text-align: center;vertical-align: middle;">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{!! trans('courses.title_ar') !!}</th>
                                <th scope="col">{!! trans('courses.title_en') !!}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($courses as $key=>$course)
                                <tr>
                                    <td>{!! $key+1 !!}</td>
                                    <td>{!! $course->title_ar !!}</td>
                                    <td>{!! $course->title_en !!}</td>
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
