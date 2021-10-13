<a href="#" class="btn btn-hover-danger btn-icon btn-pill delete_lecture_btn"
   data-id="{{$instance->id}}"
   title="{{trans('general.delete')}}">
    <i class="fa fa-trash fa-1x"></i>
</a>

@if($instance->lecture_cancel == null)
    <a href="{!! route('admin.attendance.record',['cid'=>last(request()->segments()),'lid'=>$instance->id])!!}"
       class="btn btn-hover-info btn-icon btn-pill"
       data-id="{{$instance->id}}"
       title="{{trans('courses.attendance_record')}}">
        <i class="fab fa-readme"></i>
    </a>
@endif

