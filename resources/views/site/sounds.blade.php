@extends('layouts.site')
@section('title') {!! trans('site.mawhob') !!} @endsection
@section('metaTags')
    <meta name="description"
          content="{!! Lang()=='ar' ? setting()->site_description_ar : setting()->site_description_en !!}">
    <meta name="keywords"
          content="{!! Lang()=='ar' ? setting()->site_keywords_ar : setting()->site_keywords_en !!}">
    <meta name="application-name" content="{!! Lang()=='ar' ? setting()->site_name_ar : setting()->site_name_en !!}"/>
    <meta name="author" content="{!! Lang()=='ar' ? setting()->site_name_ar : setting()->site_name_en !!}"/>
@endsection

@push('css')
@endpush
@section('content')

    @include('site.includes.header')

    <section class="sub-header">
        <div class=" container text-center content-header">
            <h2>
                {!! trans('site.talents') !!}
                @if(Lang()=='ar') / @else \ @endif
                {!! trans('site.sound_tracks') !!}</h2>
            <p>
                {!! Lang()=='ar'?staticStrings()->soundtrack_description_ar:staticStrings()->soundtrack_description_en  !!}
            </p>
        </div>
        <div class="back-sub-header"><img src="{!! asset('site/img/sound-tracks.jpg') !!}" alt="">
        </div>
    </section>



    <section id="sounds_section">
        <div class=" container my-5">
            <div class="row">

                <!-- begin : Filter ------------------------------------------>
                <div class="col-lg-3">
                    <div class=" bg-warning p-2 text-white text-bold br-10 ">{!! trans('site.filters') !!}</div>
                    <div class=" py-3 px-2">


                        <div class="form-group">
                            <label for="search_name" class=" fs-14">{!! trans('site.sound_name') !!}</label>
                            <input class="form-control form-control-sm fs-14 py-1 px-1"
                                   name="search_name" id="search_name"
                                   autocomplete="off"
                                   placeholder="{!! trans('site.enter_sound_name') !!}">
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="fs-14 mb-1">{!! trans('site.sound_length') !!}</div>
                            </div>
                            <div class="col-6 pr-1">
                                <input class="form-control form-control-sm" type="number"
                                       placeholder="{!! trans('site.from') !!}"
                                       name="length_from" id="length_from">
                            </div>
                            <div class="col-6 pl-1">
                                <input class="form-control form-control-sm" type="number"
                                       placeholder="{!! trans('site.to') !!}"
                                       name="length_to" id="length_to">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="fs-14 mb-1">{!! trans('site.publish_date') !!}</div>
                            </div>
                            <div class="col-12">
                                <input class="form-control form-control-sm datepicker" type="text"
                                       placeholder="{!! trans('site.from') !!}"
                                       name="date_from" id="date_from">
                            </div>
                            <div class="col-12 mt-1">
                                <input class="form-control form-control-sm datepicker" type="text"
                                       placeholder="{!! trans('site.to') !!}"
                                       name="date_to" id="date_to">
                            </div>
                        </div>


                    </div>
                </div>
                <!-- end : Filter ------------------------------------------>


                <!-- begin : Sounds ------------------------------------------>
                <div class="col-lg-9">
                    @if($sounds->isEmpty())
                        <img src="{!! asset('site/images/noRecordFound.svg') !!}"
                             class="img-fluid" id="no_data_img"
                             title="{!! trans('site.no_date') !!}">
                    @else
                        <div id="sounds_data">
                            @include('site.sounds-paging')
                        </div>
                    @endif
                </div>
                <!-- end : Sounds ------------------------------------------>
            </div>
        </div>


    </section>
@endsection

@push('js')
    <script type="text/javascript">

        $('.datepicker').datepicker({
            format: "yyyy-mm-dd",
            todayBtn: true,
            clearBtn: false,
            orientation: "bottom auto",
            language: "{!! Lang() !!}",
            autoclose: true,
            todayHighlight: true,
        });
        ////////////////////////////////////////////////////////////////////////
        $(document).on('click', '.pagination a', function (event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            getMoreSounds(page);
        });


        ////////////////////////////////////////////////////////////////////////
        /// search name function
        $('#search_name').on('keyup', function () {
            $value = $(this).val();
            getMoreSounds(1);
        });

        ////////////////////////////////////////////////////////////////////////
        // Length From ->To Function
        $('#length_to').on("change", function (e) {
            e.preventDefault();
            var length_from = $('#length_from').val();
            var length_to = $(this).val();

            if ($('#length_from').val() == '') {
                Swal.fire({
                    text: "{!! trans('site.select_length_from_firstly') !!}",
                    icon: "warning",
                    allowOutsideClick: false,
                    confirmButtonText: "{!! trans('site.ok') !!}",
                    customClass: {confirmButton: 'date_to_ok_button'}
                });
                $('.date_to_ok_button').click(function () {
                    $('#length_to').val('');
                });
            }
            getMoreSounds(1);
        });


        ////////////////////////////////////////////////////////////////////////
        // Date From ->To Function
        $('#date_to').on("change", function (e) {
            e.preventDefault();
            var date_from = $('#date_from').val();
            var date_to = $(this).val();

            if ($('#date_from').val() == '') {
                Swal.fire({
                    text: "{!! trans('site.select_date_from_firstly') !!}",
                    icon: "warning",
                    allowOutsideClick: false,
                    confirmButtonText: "{!! trans('site.ok') !!}",
                    customClass: {confirmButton: 'date_to_ok_button'}
                });
                $('.date_to_ok_button').click(function () {
                    $('#date_to').val('');
                });
            }
            getMoreSounds(1);
        });


        ////////////////////////////////////////////////////////////////////////
        // get More Sounds
        function getMoreSounds(page) {
            var search = $('#search_name').val();
            var length_from = $('#length_from').val();
            var length_to = $('#length_to').val();
            var date_from = $('#date_from').val();
            var date_to = $('#date_to').val();


            $.ajax({
                type: "GET",
                data: {
                    'search_query': search,
                    'length_from': length_from,
                    'length_to': length_to,
                    'date_from': date_from,
                    'date_to': date_to,
                },
                url: "/{!! Lang() !!}/get/more/sounds?page=" + page,
                success: function (data) {
                    console.log(data);
                    $('#sounds_data').html(data);
                    $('html, body').animate({
                        scrollTop: $("#sounds_section").offset().top
                    }, 1000);
                }
            });
        }

    </script>
@endpush
