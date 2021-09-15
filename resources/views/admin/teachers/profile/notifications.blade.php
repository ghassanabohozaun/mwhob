<!--Start:: Notifications-->
<div class="col-lg-6">
    <!--begin::List Widget 10-->
    <div class="card card-custom  card-stretch gutter-b">
        <!--begin::Header-->
        <div class="card-header border-0">
            <h3 class="card-title font-weight-bolder text-dark">{!! trans('teachers.notifications') !!}</h3>
        </div>
        <!--end::Header-->

        <!--begin::Body-->
        <div class="card-body pt-0" style="overflow:auto; height: 370px">

            @if($notifications->isEmpty())
                <h4 class="text-warning font-weight-bold">
                    <img src="{!! asset('site/images/noRecordFound.svg') !!}"
                         class="img-fluid" id="no_data_img"
                         title="{!! trans('site.no_date') !!}">
                </h4>
            @else

                @foreach($notifications as $notification)
                <!--begin: Item-->
                    <div class="d-flex align-items-center  rounded p-5 mb-5 bg-light-info">
                        <div class="d-flex align-items-center flex-grow-1">
                            <label class=" flex-shrink-0 mr-4">
                                <span>
                                      <i class="flaticon-bell text-danger icon-lg"></i>
                                </span>
                            </label>
                            <div
                                class="d-flex flex-wrap align-items-center justify-content-between w-100">
                                <div class="d-flex flex-column align-items-cente py-2 w-75">
                                    <a href="#" data-id="{!! $notification->id !!}"
                                       class="text-dark-75 font-weight-bold text-hover-primary font-size-lg mb-1
                                           show_teacher_notification_btn">
                                        @if(Lang()=='ar')
                                            {!! $notification->title_ar !!}
                                        @else
                                            {!! $notification->title_en !!}
                                        @endif
                                    </a>
                                    <p>
                                        @if(Lang()=='ar')
                                            {!! $notification->details_ar !!}
                                        @else
                                            {!! $notification->details_en !!}
                                        @endif
                                    </p>
                                    <span class="text-warning font-size-sm font-weight-bold">
                                    {!! $notification->created_at !!}
                            </span>
                                </div>

                            </div>

                        </div>

                    </div>
                    <!--end: Item-->
                @endforeach

            @endif

        </div>
        <!--end: Card Body-->
    </div>
    <!--end: Card-->
    <!--end: List Widget 10-->
</div>
<!--end::Notifications-->

