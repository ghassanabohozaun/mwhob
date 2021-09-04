@extends('layouts.admin')
@section('title') @endsection
@push('css')
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css"/>
@endpush

@section('content')

    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div
            class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">

                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <!--begin::Actions-->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0);" class="text-muted">
                            {{trans('menu.landing_page')}}
                        </a>
                    </li>

                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">
                            {{trans('menu.footer_images')}}
                        </a>
                    </li>
                </ul>

                <!--end::Actions-->
            </div>
            <!--end::Info-->

        </div>
    </div>
    <!--end::Subheader-->

    <!--begin::content-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class=" container">
            <!--begin::Row-->
            <div class="row">
                <div class="col-lg-12">
                    <!--begin::Card-->
                    <div class="card card-custom" id="card_posts">
                        <div class="card-body">



                            <div class="row justify-content-center">
                                <div class="col-xl-12">

                                    <!--begin::body-->
                                    <div class="my-5">
                                        <label
                                            style="font-weight:bold">{{trans('landing.footer_images')}}</label>
                                        <div class="dropzone dropzone-default dz-clickable"
                                             id="dropzoneFileUpload"></div>

                                    </div>
                                    <!--begin::body-->
                                </div>
                            </div>

                        </div>

                    </div>
                    <!--end::Card-->
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->

        <!--begin::Form-->
    </div>
    <!--end::content-->

@endsection
@push('js')


    <script>
        Dropzone.autoDiscover = false;
        $(document).ready(function () {

            ///////////////////////////////////////////////////////////////////////////////////////////////////////////
            ///  Upload Footer Images
            $('#dropzoneFileUpload').dropzone({
                url: "{{route('admin.upload.footer.image')}}",
                paramName: 'file',
                uploadMultiple: false,
                maxFiles: 15,  // Max File  Count
                maximumFileSize: 2, // File Size
                acceptedFiles: 'image/*',  // File Type
                resizeWidth: 700,
                //// Default Message
                dictDefaultMessage: "{{trans('landing.footer_images_upload')}}",
                ///// Remove Image
                params: {
                    _token: "{{csrf_token()}}"
                },
                ///////////////////////////////////////////////////
                ////////// Delete File
                dictRemoveFile: "{{trans('general.delete')}}",
                addRemoveLinks: true,
                removedfile: function (file) {
                    $.post("{{route('admin.delete.footer.image')}}", {id: file.fid}, function (data) {
                        console.log(data);
                        if (data.status == true) {
                            Swal.fire({
                                title: data.msg,
                                text: "",
                                icon: "success",
                                allowOutsideClick: false,
                                customClass: {confirmButton: 'add_footer_image_button'}
                            });
                        }
                    });
                    var fmock;
                    return (fmock = file.previewElement) != null ? fmock.parentNode.removeChild(file.previewElement) : void 0;
                },


                ///////////////////////////////// Start Get Images
                ////// Get Images From Model --> tip: take care there is relation between post and file
                init: function () {
                    @foreach(App\File::get() as $file)
                    var mock = {
                        name: '{{$file->file_name}}',
                        fid: '{{$file->id}}',
                        size: '{{$file->file_size}}',
                        type: '{{$file->file_mimes_type}}'
                    };
                    this.emit('addedfile', mock);

                    this.options.thumbnail.call(this, mock, '{{url('storage/'.$file->full_path_after_upload)}}');

                    @endforeach
                        this.on('sending', function (file, xhr, formData) {
                        formData.append('fid', '');
                        file.fid = '';
                    });

                    this.on('success', function (file, response) {
                        file.fid = response.id;
                    })
                }
                ///////////////////////////////// End Get Images
            });//end dropzone

            $('.dz-preview').addClass('dz-complete');
        });//end document
    </script>

@endpush

@push('css')

@endpush
