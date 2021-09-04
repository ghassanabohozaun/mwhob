@if( $instance->status == 'new')
    <span class="label label-lg font-weight-bold label-light-warning label-inline">
      {!! trans('supportCenter.new') !!}
</span>
@elseif( $instance->status == 'contacted')
    <span class="label label-lg font-weight-bold label-light-ifo label-inline">
 {!! trans('supportCenter.contacted') !!}
</span>
@elseif( $instance->status == 'solved')
    <span class="label label-lg font-weight-bold label-light-success label-inline">
 {!! trans('supportCenter.solved') !!}
</span>
@endif

