
@if($notifications->isEmpty())
    <div class="item-noty  p-2 br-5">
        <a href="#">
            <div class="text-bold text-primary">{!! trans('site.no_notifications') !!}</div>
        </a>
    </div>
@else
    @foreach($notifications as $notification)
        <div class="item-noty  p-2 br-5 text-left">
            <a href="#">
                <div class="text-bold text-primary">
                    {!! Lang()=='ar'?$notification->title_ar:$notification->title_en !!}
                </div>
                <div class="fs-12 text-dark">
                    {!! Lang()=='ar'?$notification->details_ar:$notification->details_en !!}
                </div>
            </a>
        </div>
    @endforeach
@endif
