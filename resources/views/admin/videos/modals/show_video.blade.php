<style>


    iframe, object, embed {
        max-width: 100%;
    }

    #model_show_video .modal-header {
        padding: 0.7rem 1.75rem;
        border-bottom: none;
    }

    .modal .modal-header .close i, .modal .modal-header .close .ki {
        padding-left: 5px;
        padding-top: 30px;
    }
    .modal .modal-header .close {
        margin: 5px 0;
    }
</style>

<!-- begin Modal-->
<div class="modal fade" id="model_show_video" data-backdrop="static" tabindex="-1" role="dialog"
     aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>


            <!--begin::Card-->
            <div class="card card-custom card-shadowless rounded-top-0">
                <!--begin::Body-->
                <div class="card-body p-1">

                    <div class="col-xl-12 col-xxl-10">

                        <div class="row justify-content-center">

                            <div id="video_view"></div>

                        </div>
                    </div>

                </div>
            </div>


        </div>
    </div>
</div>
<!-- end Modal-->

@push('js')
    <script type="text/javascript">


        /////////////////////////////////////////////////////////////////////////////////////
        // Close Video show modal By event
        $('#model_show_video').on('hidden.bs.modal', function (e) {
            e.preventDefault();
            $("#video_view iframe").attr('src', '');
            $('video').trigger('pause');
            $('#model_show_video').modal('hide');
        });
        //////////////////////////////////////////////////////
        //  show video modal
        $(document).on('click', '.show_video_btn', function (e) {
            e.preventDefault();
            var id = $(this).data('id');

            $('#video_view').empty();

            $.get("{{route('admin.video.view')}}", {id, id}, function (data) {
                console.log(data);
                if (data.data.video_class == 'uploaded_video') {
                    $('#video_view').html('<div class="col-md-4 col-xxl-3"><video  width="470" height="250"  controls><source src="' + data.data.upload_video_link + '"></video></div>');
                    $('#model_show_video').modal('show');
                } else if (data.data.video_class == 'vimeo') {
                    $('#video_view').html('<iframe width="470" height="250"' +
                        'src="' + data.data.vimeo_link + '"></iframe>');
                    $('#model_show_video').modal('show');
                } else if (data.data.video_class == 'youtube') {
                    $('#video_view').html('<iframe width="470" height="250"' +
                        'src="' + data.data.youtube_link + '"></iframe>');
                    $('#model_show_video').modal('show');
                }

                $('#model_show_video').modal('show');
            });

        });
    </script>
@endpush


