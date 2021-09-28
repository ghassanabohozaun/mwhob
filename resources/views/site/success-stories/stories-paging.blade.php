<div class="row">
    @foreach($stories as $story)
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="box-users  text-center itemuser p-3 br-10">
                <div class="imguser">
                    <img src="{!! asset(Storage::url($story->story_image)) !!}"
                         alt="">
                </div>
                <div class="nameuser fs-20 text-bold text-primary">
                    @if(Lang()=='ar')
                        {!! $story->mawhob->mawhob_full_name !!}
                    @else
                        {!! $story->mawhob->mawhob_full_name_en !!}
                    @endif
                </div>
                <div class="my-2 py-1">
                    <img class="mr-1" src="{!! asset('site/img/serv.svg') !!}" width="15"
                         alt="">
                    {!! App\Models\MawhobVideo::where('mawhob_id',$story->mawhob->id)->count() +
                        App\Models\MawhobSound::where('mawhob_id',$story->mawhob->id)->count()!!}
                    {!! trans('site.service') !!}
                </div>
                <p class=" fs-12">

                    @if(Lang() == 'ar')
                        {!! \Illuminate\Support\Str::limit(strip_tags($story->about_mawhob_ar),$limit = 200, $end = '...')!!}
                    @else
                        {!! \Illuminate\Support\Str::limit(strip_tags($story->about_mawhob_en ),$limit = 200, $end = '...')!!}
                    @endif
                </p>
                <div class=" text-right mt-3">
                    <a class=" text-primary " href="{!! route('story',$story->id) !!}">
                        {!! trans('site.discover') !!}
                        <i class="fas fa-chevron-right"></i>
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
                {{$stories->links('vendor.pagination.bootstrap-4')}}
            </div>
        </div>
    </div>
</section>
