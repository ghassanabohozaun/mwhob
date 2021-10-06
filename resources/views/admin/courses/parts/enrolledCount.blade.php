@if(App\Models\MawhobEnrollCourse::where('course_id',$instance->id)->count() == 0)
    0
@else
    {!! App\Models\MawhobEnrollCourse::where('course_id',$instance->id)->count() !!}
@endif
