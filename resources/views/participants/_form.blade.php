@csrf

<div class="form-group row">
    <div class="col-md-6">
        @include('partials.event.events.dropdown',['old'=>null ?? $participant->event_id])
    </div>
    <div class="col-md-6">
        @include('partials.individuals.singleDropdown',['old'=>null ?? $participant->individual_id,'label'=>'Participant Name'])
    </div>

</div>
<div class="form-group row">
    <div class="col-md-4">
        @include('partials.dates.date',['old'=>null ?? mysql_to_date($participant->date),'label'=>'Engage Date'])
    </div>
    <div class="col-md-4">
        <label class="col-form-label">Participation Level</label>
        <select name="participant_level" class="form-control @error('participant_level') is-invalid @enderror">
            <option value="L" {{old('level',$participant->level) == 'L' ? 'selected' : '' }}>Local Participant</option>
            <option value="I" {{old('level',$participant->level) == 'I' ? 'selected' : '' }}>International Participant</option>
        </select>
        @error('participant_level')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
    <div class="col-md-4">
        @include('partials.individuals.groups.dropdown',['old'=>null ?? $participant->group_id,'label'=>'Participant Group'])
    </div>
</div>

<div class="form-group row">
    <div class="col-md-4">
        @include('partials.individuals.roles.dropdown',['old'=>null ?? $participant->participant_role_id])
    </div>
    <div class="col-md-4">
        @include('partials.organizations.singleDropdown',['old'=>null ?? $participant->organization_id])
    </div>
    <div class="col-md-4">
        @include('partials.wards.dropdown',['old'=>null ?? $participant->ward_id])
    </div>
</div>


<div class="form-group row justify-content-center">
    <div class="col-md-12">
        <div class="float-left">
            <a class="btn btn-dark" href="{{route('participants.index')}}" title="create">cancel</a>
        </div>
        <div class="float-right">
            <input type="submit" class="btn btn-success" value="{{$buttonText}}"/>
        </div>
    </div>
</div>

