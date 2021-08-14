@if( $instance->status == 'new')
    <span class="text-warning   mr-2">
      {!! trans('supportCenter.new') !!}
</span>
@elseif( $instance->status == 'contacted')
    <span class="text-info   mr-2">
 {!! trans('supportCenter.contacted') !!}
</span>
@elseif( $instance->status == 'solved')
    <span class="text-success mr-2">
 {!! trans('supportCenter.solved') !!}
</span>
@endif

