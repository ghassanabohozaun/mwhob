<div class="row justify-content-center">
    @foreach($summerCamps as $summerCamp)
        <div class="col-lg-6 col-md-6 mb-6 mt-5">
            <div
                class="uk-background-cover bg-dark-opcity uk-height-medium uk-panel uk-flex uk-flex-bottom uk-flex-middle br-10"
                style="background-image: url({!! asset(Storage::url($summerCamp->summer_camp_image)) !!});
                    height: 400px;">
                <div class=" p-3 text-white">
                    <div class="uk-h4 text-white mb-1  text-bold">
                        {!! Lang()=='ar'?$summerCamp->name_ar:$summerCamp->name_en !!}
                        -   {!! $summerCamp->year !!}
                    </div>
                    <p class=" text-white">
                        {!! Lang()=='ar'?$summerCamp->short_description_ar:$summerCamp->short_description_en !!}
                    </p>


                    <div class="row mt-4 mb-4 mx-0 bg-dark p-2 br-5">
                        <div class="col-lg-6 px-1">
                            <div class="fs-12">
                                <span>{!! trans('site.start_at') !!}</span>
                                <span dir="{!! Lang()=='ar'?'rtl':'ltr' !!}"> {!! $summerCamp->start_at !!} </span>
                            </div>
                        </div>
                        <div class="col-lg-6 px-1">
                            <div class="fs-12 text-right">
                                <span>{!! trans('site.end_at') !!}</span>
                                <span dir="{!! Lang()=='ar'?'rtl':'ltr' !!}"> {!! $summerCamp->end_at !!} </span>
                            </div>
                        </div>
                    </div>


                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto d-flex align-items-center">
                            @if($summerCamp->discount!=null || $summerCamp->discount!=0)
                                <span class="net-price mr-2 text-warning">{!! $summerCamp->discount !!}$</span>
                                <span class="old-price text-white">{!! $summerCamp->cost !!}$</span>
                            @else
                                <span class="my_price text-white">{!! $summerCamp->cost !!}$</span>
                            @endif
                        </div>
                    </div>
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


