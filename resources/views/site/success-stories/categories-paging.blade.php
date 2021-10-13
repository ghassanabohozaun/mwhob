<div class="row justify-content-center">
    @foreach($storyCategories as $storyCategory)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="box-program p-4 br-5">
                <div class="row align-items-center justify-content-between mb-3">
                    <div class="col-auto">
                        <img src="{!! asset(Storage::url($storyCategory->category_icon)) !!}"
                             width="60"
                             alt="{!! Lang()=='ar'?$storyCategory->name_ar:$storyCategory->name_en!!}">
                    </div>
                    <div class="col-auto text-center">
                        <h2 class=" text-bold">+
                            {!! App\Models\Story::where('story_category_id',$storyCategory->id)
                                                 ->where('status', 'on')->count() !!}
                        </h2>
                        <div class=" fs-14">{!! trans('site.mawhoobs') !!}</div>
                    </div>
                </div>
                <div class="title-pr fs-18 text-bold mt-4">
                    {!! Lang()=='ar'?$storyCategory->name_ar:$storyCategory->name_en!!}
                </div>
                <p>
                    {!! Lang()=='ar'?$storyCategory->description_ar:$storyCategory->description_en!!}
                </p>
                @if(App\Models\Story::orderByDesc('id')
                          ->where('story_category_id',$storyCategory->id)->where('status', 'on')
                           ->get()->isEmpty())
                    <ul class=" list-users-w sm mt-3">
                        <li id="my_list_user_li"></li>
                    </ul>
                @else
                    <ul class=" list-users-w sm mt-3">
                        @foreach(App\Models\Story::orderByDesc('id')
                              ->where('story_category_id',$storyCategory->id)->where('status', 'on')
                               ->take(7)->get() as $story)
                            <li>
                                <a href="javascript:void(0)">
                                    <img src="{!! asset(Storage::url($story->story_icon))  !!}"
                                         alt="{!! Lang()=='ar'?$storyCategory->name_ar:$storyCategory->name_en!!}">
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif


                <div class=" text-right pt-3 read-more">
                    <a href="{!! route('success.stories',Lang()=='ar'?$storyCategory->slug_name_ar:$storyCategory->slug_name_en) !!}">
                        {!! trans('site.more') !!}
                        <i class="fas ml-1 fa-chevron-right"></i>
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>

<section class="content-section">
    <div class="container">
        <div class="row">
            <div class="pagination_section">
                {{$storyCategories->links('vendor.pagination.bootstrap-4')}}
            </div>
        </div>
    </div>
</section>
