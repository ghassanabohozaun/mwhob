<div class="table-responsive">
    <table class="table" style="vertical-align: middle; font-size: 14px">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{!! trans('site.notification_title') !!}</th>
            <th scope="col">{!! trans('site.notification_details') !!}</th>
            <th scope="col">{!! trans('site.action') !!}</th>

        </tr>
        </thead>
        <tbody>

        @foreach($notifications as $key=>$notification)
            <tr>
                <td>{!! $key+1 !!}</td>
                <td>
                    {!! Lang()=='ar'? $notification->title_ar :$notification->title_en !!}
                </td>
                <td>
                    {!! Lang()=='ar'? $notification->details_ar :$notification->details_en !!}
                </td>
                <td>
                    <a href="#" title="{!! trans('site.mark_as_read') !!}" class="read_student_notification"
                       data-id="{!! $notification->id !!}">
                        <i style="font-size: 20px"
                           class="fa fa-envelope  {!! $notification->notify_class=='unread'?'text-danger':'text-info' !!} ">
                        </i>
                    </a>
                </td>
            </tr>
        @endforeach


        </tbody>
    </table>

    {{$notifications->links('vendor.pagination.bootstrap-4')}}
</div>
