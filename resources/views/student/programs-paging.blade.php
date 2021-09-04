<div class="row">

    @foreach($mawhobEnrollPrograms as $mawhobEnrollProgram)
        <div class="col-lg-6 col-md-6 mb-6">
            <div class="box-program p-4 br-5">
                <div class="row align-items-center justify-content-between mb-3">
                    <div class="col-auto">
                        <img src="{!! asset(Storage::url($mawhobEnrollProgram->program->icon)) !!}"
                             width="60" alt="">
                    </div>
                    <div class="col-auto text-center">
                        <h2 class=" text-bold">{!! $mawhobEnrollProgram->program->hours !!}</h2>
                        <div class=" fs-14">{!! trans('site.hours') !!}</div>
                    </div>
                </div>
                <div class="title-pr fs-18 text-bold mt-4">
                    {!! Lang()=='ar'?$mawhobEnrollProgram->program->name_ar:$mawhobEnrollProgram->program->name_en !!}
                </div>
                <p>
                    {!! Lang()=='ar'?$mawhobEnrollProgram->program->short_description_ar:$mawhobEnrollProgram->program->short_description_en !!}
                </p>
                <div class="work-plan text-bold fs-16 mt-3 mb-2">{!! trans('site.work_plane') !!}</div>
                <div class="file-link d-flex justify-content-between align-items-center   px-2 py-2 br-5">
                    <div class="fs-14">
                        <img src="{!! asset('site/img/pdf-file.svg') !!}" width="16" alt="">
                        <span class=" d-inline-block ">
                            {!! trans('site.download_work_plane') !!}
                        </span>

                    </div>
                    <div class="download">
                        <a href="{!! asset(Storage::url($mawhobEnrollProgram->program->work_plan)) !!}"
                           target="_blank">
                            <i class="far fa-arrow-alt-circle-down text-dark"></i>
                        </a>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-3">
                      <span class=" d-inline-block btn btn-primary ">
                          {!! $mawhobEnrollProgram->program->price !!}$
                        </span>
                </div>

            </div>
        </div>
    @endforeach
</div>

<section class="content-section">
    <div class="container">
        <div class="row">
            <div class="pagination_section">
                {{$mawhobEnrollPrograms->links('vendor.pagination.bootstrap-4')}}
            </div>
        </div>
    </div>
</section>
