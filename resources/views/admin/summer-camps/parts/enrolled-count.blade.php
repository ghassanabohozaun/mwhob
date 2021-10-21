@if(App\Models\MawhobEnrollSummerCamp::where('summer_camp_id',$instance->id)->count() == 0)
    0
@else
    {!! App\Models\MawhobEnrollSummerCamp::where('summer_camp_id',$instance->id)->count() !!}
@endif
