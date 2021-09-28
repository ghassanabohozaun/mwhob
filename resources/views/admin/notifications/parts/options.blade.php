<a href="#" class="btn btn-secondary btn-icon btn-pill  btn-sm mr-3  read_admin_notification_btn"
   data-id="{{$instance->id}}"
   title="{{trans('general.show')}}">
    <i class="flaticon-bell {!! $instance->notify_class=='read'? 'text-info':'text-danger' !!}  icon-lg"></i>
</a>



