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
                                {!! $contest->prize !!}$
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     aria-hidden="true" focusable="false"
                                     data-prefix="fas" data-icon="award"
                                     class="svg-inline--fa fa-award fa-w-12"
                                     role="img" viewBox="0 0 384 512"
                                     style="width: 18px; margin: 5px;">
                                    <path fill="currentColor"
                                          d="M97.12 362.63c-8.69-8.69-4.16-6.24-25.12-11.85-9.51-2.55-17.87-7.45-25.43-13.32L1.2 448.7c-4.39 10.77 3.81 22.47 15.43 22.03l52.69-2.01L105.56 507c8 8.44 22.04 5.81 26.43-4.96l52.05-127.62c-10.84 6.04-22.87 9.58-35.31 9.58-19.5 0-37.82-7.59-51.61-21.37zM382.8 448.7l-45.37-111.24c-7.56 5.88-15.92 10.77-25.43 13.32-21.07 5.64-16.45 3.18-25.12 11.85-13.79 13.78-32.12 21.37-51.62 21.37-12.44 0-24.47-3.55-35.31-9.58L252 502.04c4.39 10.77 18.44 13.4 26.43 4.96l36.25-38.28 52.69 2.01c11.62.44 19.82-11.27 15.43-22.03zM263 340c15.28-15.55 17.03-14.21 38.79-20.14 13.89-3.79 24.75-14.84 28.47-28.98 7.48-28.4 5.54-24.97 25.95-45.75 10.17-10.35 14.14-25.44 10.42-39.58-7.47-28.38-7.48-24.42 0-52.83 3.72-14.14-.25-29.23-10.42-39.58-20.41-20.78-18.47-17.36-25.95-45.75-3.72-14.14-14.58-25.19-28.47-28.98-27.88-7.61-24.52-5.62-44.95-26.41-10.17-10.35-25-14.4-38.89-10.61-27.87 7.6-23.98 7.61-51.9 0-13.89-3.79-28.72.25-38.89 10.61-20.41 20.78-17.05 18.8-44.94 26.41-13.89 3.79-24.75 14.84-28.47 28.98-7.47 28.39-5.54 24.97-25.95 45.75-10.17 10.35-14.15 25.44-10.42 39.58 7.47 28.36 7.48 24.4 0 52.82-3.72 14.14.25 29.23 10.42 39.59 20.41 20.78 18.47 17.35 25.95 45.75 3.72 14.14 14.58 25.19 28.47 28.98C104.6 325.96 106.27 325 121 340c13.23 13.47 33.84 15.88 49.74 5.82a39.676 39.676 0 0 1 42.53 0c15.89 10.06 36.5 7.65 49.73-5.82zM97.66 175.96c0-53.03 42.24-96.02 94.34-96.02s94.34 42.99 94.34 96.02-42.24 96.02-94.34 96.02-94.34-42.99-94.34-96.02z"></path></svg>
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
