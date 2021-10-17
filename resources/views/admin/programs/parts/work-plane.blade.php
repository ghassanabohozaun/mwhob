@if($instance->work_plan ==null)
   -
@else
    <a href="{{asset(Storage::url($instance->work_plan))}}" target="_blank">
        {!! trans('programs.work_plan') !!}
    </a>
@endif

