<div class="row justify-content-center">
    @foreach($contests as $contest)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="item-course">
                <div class="img-course">
                    <img src="{!! asset(Storage::url($contest->contest_image)) !!}"
                         alt="{!! Lang()=='ar'?$contest->name_ar:$contest->name_en !!}">
                </div>
                <div class="content-item">
                    <div class="date-item">{!! trans('site.ends_in') !!}
                        : {!!$contest->end_date  !!}
                    </div>
                    <div class="fs-18 text-bold my-2">
                        {!! Lang()=='ar'?$contest->name_ar:$contest->name_en !!}
                    </div>
                    <p class="mb-3">
                        {!! Lang()=='ar'?$contest->short_description_ar:$contest->short_description_en !!}
                    </p>
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">

                            @if(student()->check())
                                @if( App\Models\MawhobEnrolledContest::where('contest_id', $contest->id)
                                ->where('mawhob_id', student()->id())->get()->count() >0)
                                    <a href="javascript:void(0)" class="btn btn-primary br-30 text-bold">
                                        {!! trans('site.previously_registered') !!}
                                    </a>
                                @else
                                    <a href="#" class="btn btn-primary br-30 text-bold
                                             auth_student_contest_enroll_button"
                                       data-id="{!! $contest->id !!}">
                                        {!! trans('site.enroll_now') !!}
                                    </a>
                                @endif
                            @else
                                <a href="#" class="btn btn-primary br-30 text-bold
                                            not_auth_student_contest_enroll_button">
                                    {!! trans('site.enroll_now') !!}
                                </a>
                            @endif

                        </div>
                        <div class="col-auto d-flex align-items-center">
                            <span class="net-price mr-2 d-flex">
                                <span>{!! trans('site.prize') !!} :  {!! $contest->prize !!}$</span>

                               </span>
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
                {{$contests->links('vendor.pagination.bootstrap-4')}}
            </div>
        </div>
    </div>
</section>


@push('js')

    <script type="text/javascript">

        //////////////////////////////////////////////////////////////////////////////////////
        //  Auth Student alert and enroll
        $('body').on('click', '.auth_student_contest_enroll_button', function (e) {

            var contest_id = $(this).data('id');

            e.preventDefault();
            Swal.fire({
                title: '{!! trans('site.do_you_want_to_enroll_in_contest') !!}',
                allowOutsideClick: false,
                showDenyButton: false,
                showCancelButton: true,
                cancelButtonText: `{!! trans('site.cancel') !!}`,
                confirmButtonText: `{!! trans('site.ok') !!}`,
                customClass: {confirmButton: 'ok_enroll_in_contest_button'}

            });
            $('.ok_enroll_in_contest_button').click(function () {
                window.location.href = "{!! route('student.contest.registration.terms') !!}" + '/' + contest_id;
            });

        });


        //////////////////////////////////////////////////////////////////////////////////////
        // Not Auth Student alert
        $('body').on('click', '.not_auth_student_contest_enroll_button', function (e) {
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
