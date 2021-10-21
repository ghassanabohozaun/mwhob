@if(App\Models\MawhobEnrolledContest::where('contest_id',$instance->id)->count() == 0)
    0
@else
    {!! App\Models\MawhobEnrolledContest::where('contest_id',$instance->id)->count() !!}
@endif
