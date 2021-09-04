<a href="#" class="btn btn-hover-info btn-icon btn-pill show_teacher_course_details_btn"
   data-id="{{$instance->id}}"
   title="{{trans('general.show')}}">
    <i class="fa fa-eye fa-1x"></i>
</a>


<a href="{!! route('teacher.edit.course',$instance->id) !!}"
   class="btn btn-hover-primary btn-icon btn-pill "
   title="{{trans('general.edit')}}">
    <i class="fa fa-edit fa-1x"></i>
</a>

