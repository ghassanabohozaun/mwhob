@if($instance->file == null)
   -
@else
    <a href="{{asset(Storage::url($instance->file))}}" target="_blank">
        {!! trans('contests.file') !!}
    </a>
@endif


