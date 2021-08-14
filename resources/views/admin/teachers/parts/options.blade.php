<a href="{{route('teacher.profile',$instance->id)}}" class="btn btn-hover-info btn-icon btn-pill "
   title="{{trans('teachers.profile')}}">
    <i class="fa fa-eye fa-1x"></i>
</a>


<a href="{{route('teacher.edit',$instance->id)}}" class="btn btn-hover-primary btn-icon btn-pill "
   title="{{trans('general.edit')}}">
    <i class="fa fa-edit fa-1x"></i>
</a>

<a href="#" class="btn btn-hover-bg-secondary btn-icon btn-pill teacher_change_password_btn" data-id="{{$instance->id}}"
   title="{{trans('teachers.change_password')}}">
    <i class="fas fa-key fa-1x"></i>
</a>

<a href="#" class="btn btn-hover-bg-warning btn-icon btn-pill teacher_categories_btn" data-id="{{$instance->id}}"
   title="{{trans('teachers.teacher_categories')}}">
    <i class="fas fa-th-large fa-1x"></i>
</a>


<a href="#" class="btn btn-hover-danger btn-icon btn-pill delete_teacher_btn" data-id="{{$instance->id}}"
   title="{{trans('general.delete')}}">
    <i class="fa fa-trash fa-1x"></i>
</a>






