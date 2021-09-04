<!--begin::Advance Table: Widget 7-->
<div class="card card-custom gutter-b">
    <!--begin::Header-->
    <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-dark">{!! trans('mowhob.contests') !!}</span>
        </h3>
    </div>
    <!--end::Header-->

    <!--begin::Body-->
    <div class="card-body py-2" style="overflow:auto; height: 300px">
        <div class="container-fluid">
            <div class="row">
                <div class="table-responsive">

                    @if($mawhobEnrolledContests->isEmpty())

                        <img src="{!! asset('site/images/noRecordFound.svg') !!}"
                             class="img-fluid" id="no_data_img"
                             title="{!! trans('site.no_date') !!}">
                    @else
                        <table class="table" style="text-align: center;vertical-align: middle;">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{!! trans('contests.name_ar') !!}</th>
                                <th scope="col">{!! trans('contests.name_en') !!}</th>
                                <th scope="col">{!! trans('contests.enrolled_date') !!}</th>
                                <th scope="col">{!! trans('contests.mawhob_winner') !!}</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($mawhobEnrolledContests as $key=>$mawhobEnrolledContest)
                                <tr>
                                    <td>{!! $key+1 !!}</td>
                                    <td>{!! $mawhobEnrolledContest->contest->name_ar !!}</td>
                                    <td>{!! $mawhobEnrolledContest->contest->name_en !!}</td>
                                    <td>{!! $mawhobEnrolledContest->enrolled_date !!}</td>
                                    <td>
                                    @if($mawhobEnrolledContest->mawhob_winner == 'false')
                                           <span class="text-danger">
                                               {!! trans('contests.not_winner') !!}
                                           </span>
                                        @else
                                            <span class="text-success">
                                            {!! trans('contests.winner') !!}
                                         </span>
                                        @endif
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
