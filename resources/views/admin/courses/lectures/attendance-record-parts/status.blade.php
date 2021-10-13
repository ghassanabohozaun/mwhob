@if( App\Models\lecture_mawhob::where('lecture_id',last(request()->segments()))
              ->where('mawhob_id',$instance->id)->value('status') =='on')
    <i class="fa fa-check text-success"></i>
@else
    <i class="fa fa-times text-danger"></i>
@endif
