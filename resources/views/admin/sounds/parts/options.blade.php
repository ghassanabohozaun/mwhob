<a href="{!! route('admin.edit.sound',$instance->id) !!}" class="btn btn-hover-primary btn-icon btn-pill "
   title="{{trans('general.edit')}}">
    <i class="fa fa-edit fa-1x"></i>
</a>


<a href="#" class="btn btn-hover-info btn-icon btn-pill show_sound_btn"
   data-id="{{$instance->id}}"
   title="{{trans('general.show')}}">
    <i class="fa fa-eye fa-1x"></i>
</a>


<a href="#" class="btn btn-hover-danger btn-icon btn-pill delete_sound_btn"
   data-id="{{$instance->id}}"
   title="{{trans('general.delete')}}">
    <i class="fa fa-trash fa-1x"></i>
</a>


