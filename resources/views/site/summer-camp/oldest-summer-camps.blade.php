
<section class=" content-section py-5 px-4 px-md-0" id="summer_camps_section">
    <div class=" container">
        <div class=" mt-4 mb-2  fs-24 ">
            <span class="text-bold text-warning">{!! trans('site.oldest_summer_camps') !!}</span>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                @if($summerCamps->isEmpty())
                    <img src="{!! asset('site/images/noRecordFound.svg') !!}"
                         class="img-fluid" id="no_data_img"
                         title="{!! trans('site.no_date') !!}">
                @else
                    <div id="summer_camps_data">
                        @include('site.summer-camps-paging')
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
                url: "/{!! Lang() !!}/summer-camps/paging?page=" + page,
                success: function (data) {
                    $('#summer_camps_data').html(data);
                    $('html, body').animate({
                        scrollTop: $("#summer_camps_section").offset().top
                    }, 1000);
                }
            });
        }

    </script>
@endpush
