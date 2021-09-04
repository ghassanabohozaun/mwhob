<section class=" content-section  px-4 px-md-0 my-5 pb-5" id="courses_section">
    <div class=" container">

        <div class="row justify-content-center">
            <div class="col-lg-11 px-md-0">
                @if($courses->isEmpty())
                    <img src="{!! asset('site/images/noRecordFound.svg') !!}"
                         class="img-fluid" id="no_data_img" title="{!! trans('site.no_date') !!}">
                @else
                    <div id="courses_date">

                        @include('site.courses-paging')
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
                url: "/{!! Lang() !!}/courses/paging?page=" + page,
                success: function (data) {
                    $('#courses_date').html(data);
                    $('html, body').animate({
                        scrollTop: $("#courses_section").offset().top
                    }, 1000);
                }
            });
        }

    </script>
@endpush
