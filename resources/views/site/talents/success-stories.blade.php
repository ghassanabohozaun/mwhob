<div class="row shadow br-10 mb-5">
    <div class="col-lg-4 p-0">
        <img class="left-img-h-100 cover" width="100%"
             src="{!! asset('site/img/img-left-3.jpg') !!}"
             alt="{!! trans('site.success_stories') !!}">
    </div>
    <div class="col-lg-8">
        <div class="content-item-t py-4">
            <div class="fs-18 text-bold">{!! trans('site.success_stories') !!}</div>
            <p class="my-2">
                {!! Lang()=='ar'?staticStrings()->success_stories_description_ar:staticStrings()->success_stories_description_en !!}
            </p>

            @if($successStories->isEmpty())

                <img src="{!! asset('site/images/noRecordFound.svg') !!}"
                     class="img-fluid" id="no_data_img"
                     title="{!! trans('site.no_date') !!}">
            @else
                <ul class=" list-users-w">
                    @foreach($successStories as $successStory)
                        <li>
                            <div>
                                <img src="{!! Storage::url($successStory->story_icon) !!}"
                                     alt="{!! trans('site.mawhoob') !!}">
                            </div>
                        </li>
                    @endforeach
                    <li><div><span class="number fs-20 text-bold">{!! $storiesCount !!}+</span></div></li>
                </ul>
            @endif


        </div>
        <div class=" text-right pb-3 read-more">
            <a href="{!! route('success.stories.categories') !!}">
                {!! trans('site.more') !!}
                <i class="fas ml-1 fa-chevron-right"></i>
            </a>
        </div>
    </div>
</div>
