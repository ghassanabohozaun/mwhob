@if($instance->link == null)
   -
@else
    <a href="{{$instance->link}}" target="_blank">
        {!! trans('contests.link') !!}
    </a>
@endif




