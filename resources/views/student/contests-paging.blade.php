<div class="row">

    @foreach($studentEnrolledContests as $studentEnrolledContest)
        <div class="col-lg-4 col-md-6 mb-4">
            <div
                class="uk-background-cover bg-dark-opcity uk-height-medium uk-panel uk-flex
                uk-flex-bottom uk-flex-middle br-10"
                style="background-image: url({!! asset(Storage::url($studentEnrolledContest->contest->contest_image)) !!});
                    height: 400px;">

                @if(App\Models\MawhobEnrolledContest::where('contest_id',$studentEnrolledContest->contest_id)
                                ->where('mawhob_id',student()->user()->id)
                                ->first()->mawhob_winner == 'true')
                    <div class="uk-position-top-left p-2 font-size-xs mt-3">
                        <span class="text-danger font-weight-bold  mx-0 bg-light p-1 br-5">{!! trans('site.you_are_the_winner') !!}</span>
                    </div>
                    <div class="uk-position-top-right p-3 ">
                        <img class="float-right" src="http://127.0.0.1:8000/site/img/n1.svg" width="40" alt="{!! trans('site.winner')!!}">
                    </div>
                @endif

                <div class=" p-3 text-white">
                    <div class="uk-h4 text-white mb-1  text-bold">
                        {!! Lang()=='ar'?$studentEnrolledContest->contest->name_ar:$studentEnrolledContest->contest->name_en !!}
                    </div>
                    <p class=" text-white">
                        {!! Lang()=='ar'?$studentEnrolledContest->contest->short_description_ar:$studentEnrolledContest->contest->short_description_en !!}
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
                {{$studentEnrolledContests->links('vendor.pagination.bootstrap-4')}}
            </div>
        </div>
    </div>
</section>
