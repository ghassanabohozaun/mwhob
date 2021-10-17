<style>


    iframe, object, embed {
        max-width: 100%;
    }

    #model_show_sound .modal-header {
        padding: 0.7rem 1.75rem;
        border-bottom: none;
    }

    .modal .modal-header .close i, .modal .modal-header .close .ki {
        padding-left: 5px;
        padding-top: 30px;
    }
</style>

<!-- begin Modal-->
<div class="modal fade" id="model_show_sound" data-backdrop="static" tabindex="-1" role="dialog"
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

                            <div id="sound_view"></div>

                        </div>
                    </div>

                </div>
            </div>


        </div>
    </div>
</div>
<!-- end Modal-->

@push('js')
    <script src="{!! asset('site/player/js/audioplayer.js') !!}"></script>

    <script type="text/javascript">


        /////////////////////////////////////////////////////////////////////////////////////
        // Close Video show modal By event
        $('#model_show_sound').on('hidden.bs.modal', function (e) {
            e.preventDefault();
            $("#sound_view iframe").attr('src', '');
            $('audio').trigger('pause');
            $('#model_show_sound').modal('hide');
        });
        //////////////////////////////////////////////////////
        //  show video modal
        $(document).on('click', '.show_sound_btn', function (e) {
            e.preventDefault();
            var id = $(this).data('id');

            $('#sound_view').empty();

            $.get("{{route('admin.sound.view')}}", {id, id}, function (data) {
                console.log(data);
                $('#sound_view').html('<div class="col-lg-12"><audio   id="my_audio" preload="auto" controls>' +
                    '<source src="{{url('/')}}/storage/' + data.data.sound_file + '"></audio></div>');
                $('#model_show_sound').modal('show');
                document.getElementById('my_audio').play();
            });
        });
    </script>
@endpush


