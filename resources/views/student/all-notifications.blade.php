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

    <section class="py-3 min_height_480">
        <div class=" container">
            <div class="row">


                @include('student.includes.sidebar')

                <div class=" col-lg-9">
                    <div
                        class=" with-screen-titel row justify-content-between align-items-center p-2 br-10 bg-light mx-0 mb-3 mt-3 mt-md-0">
                        <div class="col-auto title-with-icon d-flex align-items-center px-1">
                            <span class="mr-2">
                                   <img src="{!! asset('site/img/bell-48.png') !!}" width="25">
                            </span>
                            <span
                                class="fs-14 text-bold">{!!  trans('site.notifications') !!}</span>
                        </div>
                    </div>


                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12" id="notifications_section">

                                @if($notifications->isEmpty())

                                    <img src="{!! asset('site/images/noRecordFound.svg') !!}"
                                         class="img-fluid" id="no_data_img"
                                         title="{!! trans('site.no_date') !!}">
                                @else



                                    <div class="student_notifications_table">
                                        @include('student.notifications-paging')
                                    </div>

                                @endif

                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>

@endsection

@push('js')
    <script type="text/javascript">

        ///////////////////////////////////////////////////////////////////////////////////
        // read student notification
        $('body').on('click', '.read_student_notification', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                url: "{!! route('student.notification.make.read') !!}",
                type: "post",
                data: {id, id},
                dataType: "JSON",
                success: function (data) {
                    console.log(data);
                    $(".student_notifications_table").load(location.href + " .student_notifications_table");
                    $('#orange_student_notify_section').load("{!! route('student.get.notifications') !!}");
                    $(".orange_student_notifications_count").load(location.href + " .orange_student_notifications_count");
                }
            })
        });


        ///////////////////////////////////////////////////////////////////////////////////
        // pagination

        /*$(document).on('click', '.pagination a', function (event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetch_data(page);
        });*/

        function fetch_data(page) {
            $.ajax({
                url: "/{!! Lang() !!}/student/show/all/notifications/paging?page=" + page,
                success: function (data) {
                    console.log(data);
                    //$('#programs_data').html(data);
                    /*$('html, body').animate({
                        scrollTop: $("#programs_section").offset().top
                    }, 1000);*/
                }
            });
        }

    </script>
@endpush
