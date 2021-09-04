<section class=" content-section  px-4 px-md-0 mb-5 pb-5" id="contests_section">
    <div class=" container">
        <div class=" mt-4 mb-2  fs-24">{!! trans('site.latest') !!}
            <span class="text-bold text-warning">{!! trans('site.contests') !!}</span>
        </div>
        <p class="mb-5 ">
            {!! Lang()=='ar'?staticStrings()->contests_description_ar:staticStrings()->contests_description_en !!}
        </p>

        <div class="row justify-content-center">
            <div class="col-lg-11 px-md-0">
                @if($contests->isEmpty())

                    <img src="{!! asset('site/images/noRecordFound.svg') !!}"
                         class="img-fluid" id="no_data_img"
                         title="{!! trans('site.no_date') !!}">
                @else

                    <div id="contests_data">
                        @include('site.contests-paging')
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>


@push('js')
    <script type="text/javascript">

        $(document).on('click', '.pagination a', function (event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetch_data(page);
        });

        function fetch_data(page) {
            $.ajax({
                url: "/{!! Lang() !!}/contests/paging?page=" + page,
                success: function (data) {
                    $('#contests_data').html(data);
                    $('html, body').animate({
                        scrollTop: $("#contests_section").offset().top
                    }, 1000);
                }
            });
        }

    </script>
@endpush
