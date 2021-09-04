@if( $instance->active == 'on')
    <span class="label label-lg font-weight-bold label-light-success label-inline">
      {!! trans('general.enable') !!}
</span>
@elseif( $instance->active == '')
    <span class="label label-lg font-weight-bold label-light-warning label-inline">
 {!! trans('general.disable') !!}
</span>
@endif

