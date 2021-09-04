<div class="row">
    @foreach($summerCamps as $summerCamp)
        <div class="col-lg-4 col-md-6 mb-4">
            <div
                class="uk-background-cover bg-dark-opcity uk-height-medium uk-panel uk-flex uk-flex-bottom uk-flex-middle br-10"
                style="background-image: url({!! asset(Storage::url($summerCamp->summer_camp_image)) !!});
                    height: 400px;">
                <div class=" p-3 text-white">
                    <div class="uk-h4 text-white mb-1  text-bold">
                        {!! Lang()=='ar'?$summerCamp->name_ar:$summerCamp->name_en !!}
                    </div>
                    <p class=" text-white">
                        {!! Lang()=='ar'?$summerCamp->short_description_ar:$summerCamp->short_description_en !!}
                    </p>
                </div>
            </div>
        </div>
    @endforeach
</div>




<section class="content-section">
    <div class="container">
        <div class="row">
            <div class="pagination_section">
                {{$summerCamps->links('vendor.pagination.bootstrap-4')}}
            </div>
        </div>
    </div>
</section>


