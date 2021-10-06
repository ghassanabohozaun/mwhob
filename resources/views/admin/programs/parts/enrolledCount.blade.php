@if(App\Models\MawhobEnrollProgram::where('program_id',$instance->id)->count() == 0)
    0
@else
    {!! App\Models\MawhobEnrollProgram::where('program_id',$instance->id)->count() !!}
@endif
