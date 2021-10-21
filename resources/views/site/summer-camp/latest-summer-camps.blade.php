<section class=" content-section py-5 px-4 px-md-0">
    <div class=" container">
        <div class=" mt-4 mb-2  fs-24  ">{!! trans('site.latest') !!}
            <span class="text-bold text-warning">{!! trans('site.summer_camps') !!}</span></div>
        <p class="mb-5 ">
            {!! Lang()=='ar'?staticStrings()->summer_camps_description_ar:staticStrings()->summer_camps_description_en !!}
        </p>


        <div class="row justify-content-center">
            <div class="col-lg-10">
                @if($latestSummerCamps->isEmpty())
                    <img src="{!! asset('site/images/noRecordFound.svg') !!}"
                         class="img-fluid" id="no_data_img"
                         title="{!! trans('site.no_date') !!}">
                @else
                    <div class="row justify-content-center">
                        @foreach($latestSummerCamps as $latestSummerCamp)
                            <div class="col-lg-6 col-md-6 mb-6 mt-5">
                                <div
                                    class="uk-background-cover bg-dark-opcity uk-height-medium uk-panel uk-flex uk-flex-bottom uk-flex-middle br-10"
                                    style="background-image: url({!! asset(Storage::url($latestSummerCamp->summer_camp_image)) !!});
                                        height: 400px;">
                                    <div class=" p-3 text-white">
                                        <div class="uk-h4 text-white mb-1  text-bold">
                                            {!! Lang()=='ar'?$latestSummerCamp->name_ar:$latestSummerCamp->name_en !!}
                                            - {!! $latestSummerCamp->year !!}
                                        </div>
                                        <p class=" text-white">
                                            {!! Lang()=='ar'?$latestSummerCamp->short_description_ar:$latestSummerCamp->short_description_en !!}
                                        </p>


                                        <div class="row mt-4 mb-4 mx-0 bg-dark p-2 br-5">
                                            <div class="col-lg-6 px-1">
                                                <div class="fs-12">
                                                    <span>{!! trans('site.start_at') !!}</span>
                                                    <span
                                                        dir="{!! Lang()=='ar'?'rtl':'ltr' !!}"> {!! $latestSummerCamp->start_at !!} </span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 px-1">
                                                <div class="fs-12 text-right">
                                                    <span>{!! trans('site.end_at') !!}</span>
                                                    <span
                                                        dir="{!! Lang()=='ar'?'rtl':'ltr' !!}"> {!! $latestSummerCamp->end_at !!} </span>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-auto">

                                                @if($latestSummerCamp->enable_enrolling == 'on')
                                                    @if(student()->check())
                                                        @if( App\Models\MawhobEnrollSummerCamp::where('summer_camp_id', $latestSummerCamp->id)
                                                               ->where('mawhob_id', student()->id())->get()->count() >0)
                                                            <a href="javascript:void(0)"
                                                               class="btn btn-primary br-30 text-bold">
                                                                {!! trans('site.previously_registered') !!}
                                                            </a>
                                                        @else
                                                            <a href="#" class="btn btn-primary br-30 text-bold
                                                                    auth_student_summer_camp_enroll_button"
                                                               data-id="{!! $latestSummerCamp->id !!}">
                                                                {!! trans('site.enroll_now') !!}
                                                            </a>
                                                        @endif
                                                    @else
                                                        <a href="#"
                                                           class="btn btn-primary br-30 text-bold not_auth_student_summer_camp_enroll_button">
                                                            {!! trans('site.enroll_now') !!}
                                                        </a>
                                                    @endif
                                                @endif

                                            </div>

                                            <div class="col-auto d-flex align-items-center">
                                                @if($latestSummerCamp->discount!=null || $latestSummerCamp->discount!=0)
                                                    <span class="net-price mr-2 text-warning">{!! $latestSummerCamp->discount !!}$</span>
                                                    <span
                                                        class="old-price text-white">{!! $latestSummerCamp->cost !!}$</span>
                                                @else
                                                    <span
                                                        class="my_price text-white">{!! $latestSummerCamp->cost !!}$</span>
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
        </div>
    </div>


</section>

@push('js')

    <script type="text/javascript">

        //////////////////////////////////////////////////////////////////////////////////////
        //  Auth Student alert and enroll
        $('body').on('click', '.auth_student_summer_camp_enroll_button', function (e) {

            var summer_camp_id = $(this).data('id');
            var mawhob_id = $('#mawhob_id').val();
            e.preventDefault();
            Swal.fire({
                icon: 'question',
                title: '{!! trans('site.do_you_want_to_enroll_in_summer_camp') !!}',
                allowOutsideClick: false,
                showDenyButton: false,
                showCancelButton: true,
                cancelButtonText: `{!! trans('site.cancel') !!}`,
                confirmButtonText: `{!! trans('site.ok') !!}`,
                customClass: {confirmButton: 'ok_enroll_in_summer_camp_button'}

            });
            $('.ok_enroll_in_summer_camp_button').click(function () {
                window.location.href = "{!! route('student.summer.camp.checkout') !!}" + '/' + summer_camp_id;
            });

        });


        //////////////////////////////////////////////////////////////////////////////////////
        // Not Auth Student alert
        $('body').on('click', '.not_auth_student_summer_camp_enroll_button', function (e) {
            e.preventDefault();
            Swal.fire({
                icon: 'info',
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

