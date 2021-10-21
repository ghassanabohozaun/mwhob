<a href="#" class="btn btn-hover-info btn-icon btn-pill show_summer_camp_details_btn"
   data-id="{{$instance->id}}"
   title="{{trans('general.show')}}">
    <i class="fa fa-eye fa-1x"></i>
</a>


<a href="{!! route('admin.edit.summer.camp',$instance->id) !!}" class="btn btn-hover-primary btn-icon btn-pill "
   title="{{trans('general.edit')}}">
    <i class="fa fa-edit fa-1x"></i>
</a>


<a href="{!! route('admin.summer.camp.enrolled.list',$instance->id) !!}"
   class="btn btn-hover-info btn-icon btn-pill"
   title="{{trans('summerCamps.enrolled_list')}}">
    <i class="fa fa-users fa-1x"></i>
</a>


<a href="#" class="btn btn-hover-danger btn-icon btn-pill delete_summer_camp_btn"
   data-id="{{$instance->id}}"
   title="{{trans('general.delete')}}">
    <i class="fa fa-trash fa-1x"></i>
</a>


