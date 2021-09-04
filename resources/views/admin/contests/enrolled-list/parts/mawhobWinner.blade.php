@if($instance->mawhob_winner =='false')
    <span class="label label-lg font-weight-bold label-light-danger label-inline">
            {!! trans('contests.not_winner') !!}
    </span>
@else

    <span class="label label-lg font-weight-bold label-light-success label-inline">
            {!! trans('contests.winner') !!}
    </span>
@endif



