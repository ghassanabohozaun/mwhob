<a href="{!! route('admin.edit.program',$instance->id) !!}"
   class="btn btn-hover-primary btn-icon btn-pill "
   title="{{trans('general.edit')}}">
    <i class="fa fa-edit fa-1x"></i>
</a>


<a href="{!! route('admin.programs.enrolled.list',$instance->id) !!}" class="btn btn-hover-info btn-icon btn-pill"
   title="{{trans('programs.enrolled_list')}}">
    <i class="fa fa-users fa-1x"></i>
</a>


<a href="#" class="btn btn-hover-danger btn-icon btn-pill delete_program_btn"
   data-id="{{$instance->id}}"
   title="{{trans('general.delete')}}">
    <i class="fa fa-trash fa-1x"></i>
</a>


