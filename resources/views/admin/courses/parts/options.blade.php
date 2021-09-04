<a href="#" class="btn btn-hover-info btn-icon btn-pill show_course_details_btn"
   data-id="{{$instance->id}}"
   title="{{trans('general.show')}}">
    <i class="fa fa-eye fa-1x"></i>
</a>


<a href="{!! route('admin.edit.course',$instance->id) !!}"
   class="btn btn-hover-primary btn-icon btn-pill "
   title="{{trans('general.edit')}}">
    <i class="fa fa-edit fa-1x"></i>
</a>


<a href="{!! route('admin.lectures',$instance->id) !!}"
   class="btn btn-hover-primary btn-icon btn-pill "
   title="{{trans('courses.lectures')}}">
    <i class="flaticon2-open-text-book fa-1x"></i>
</a>


<a href="#" class="btn btn-hover-secondary btn-icon btn-pill change_teacher_of_course_btn"
   data-id="{{$instance->id}}"
   title="{{trans('teachers.change_teacher')}}">
    <i class="fas fa-user-edit fa-1x"></i>
</a>



<a href="{!! route('admin.courses.enrolled.list',$instance->id) !!}" class="btn btn-hover-info btn-icon btn-pill"
   title="{{trans('contests.enrolled_list')}}">
    <i class="fa fa-users fa-1x"></i>
</a>


<a href="#" class="btn btn-hover-danger btn-icon btn-pill delete_course_btn"
   data-id="{{$instance->id}}"
   title="{{trans('general.delete')}}">
    <i class="fa fa-trash fa-1x"></i>
</a>


