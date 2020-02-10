@csrf

<div class="form-group row">
    <div class="col-md-8">
        <label class="col-form-label">Event Name <span class="star">*</span></label>
        <select name="event_id" class="form-control @error('event_id') is-invalid @enderror single-select"  required>
            <option value="">Please select...</option>
            @foreach($events as $event)
                <option value="{{$event->id}}" {{old('event_id',$participant->event_id) == $event->id ? 'selected' : '' }}>{{$event->name}}</option>
            @endforeach
        </select>
        @error('event_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
    <div class="col-md-4">
        <label class="col-form-label">Engage Date<span class="star">*</span></label>
        <input type="text" id="start_date" name="date" value="{{old('date',mysql_to_date($participant->date))}}" class="form-control  @error('date') is-invalid @enderror" required >
        @error('date')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
</div>
<div class="form-group row">
    <div class="col-md-8">
        <label class="col-form-label">Participant Name <span class="star">*</span></label>
        <select name="individual_id" class="form-control @error('individual_id') is-invalid @enderror single-select"  required>
            <option value="">Please select...</option>
            @foreach($individuals as $individual)
                <option value="{{$individual->id}}" {{old('individual_id',$participant->individual_id) == $individual->id ? 'selected' : '' }}>{{$individual->full_name}}</option>
            @endforeach
        </select>
        @error('individual_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
    <div class="col-md-4">
        <label class="col-form-label">Participation Level</label>
        <select name="participant_level" class="form-control @error('participant_level') is-invalid @enderror">
            <option value="L" {{old('level',$participant->level) == 'L' ? 'selected' : '' }}>Local Participant</option>
            <option value="I" {{old('level',$participant->level) == 'I' ? 'selected' : '' }}>International Participant</option>
        </select>
        @error('participant_level')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        
    </div>
</div>

<div class="form-group row">
    <div class="col-md-6">
        <label class="col-form-label">Participant Group</label>
        <select name="group_id" class="form-control @error('group_id') is-invalid @enderror single-select">
            <option value="">Please select...</option>
            @foreach($groups as $group)
                <option value="{{$group->id}}" {{old('group_id',$participant->group_id) == $group->id ? 'selected' : ''}}>{{$group->name}}</option>
            @endforeach
        </select>
        @error('group_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
    <div class="col-md-6">
        <label class="col-form-label">Participant Role</label>
        <select name="participant_role_id" class="form-control @error('group_id') is-invalid @enderror single-select ">
            <option value="">Please select...</option>
            @foreach($roles as $role)
                <option value="{{$role->id}}" {{old('participant_role_id',$participant->participant_role_id) == $role->id ? 'selected' : ''}}>{{$role->name}}</option>
            @endforeach
        </select>
        @error('participant_role_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>

</div>


<div class="form-group row">
    <div class="col-md-6">
        <label class="col-form-label">Group/Organization Name</label>
        <select name="organization_id" class="form-control @error('organization_id') is-invalid @enderror single-select ">
            <option value="">Please select...</option>
            @foreach($organizations as $organization)
                <option value="{{$organization->id}}" {{old('organization_id',$participant->organization_id) == $organization->id ? 'selected' : ''}}>{{$organization->organization_name}}</option>
            @endforeach
        </select>
        @error('organization_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
    <div class="col-md-6">
        <label class="col-form-label">Ward</label>
        <input list="wards" type="text"  name="ward" value="{{old('ward',$participant->ward->name)}}" class="form-control{{ $errors->has('ward') ? ' is-invalid' : '' }}" >
        <datalist id="wards">
            @foreach($wards as $ward)
                <option value="{{$ward->name}}"/>
            @endforeach
        </datalist>
        @error('ward')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
</div>

<div class="form-group row justify-content-center">
    <div class="col-md-12">
        <div class="float-left">
            <a class="btn btn-outline-secondary" href="{{route('participants.index')}}" title="create">cancel</a>
        </div>
        <div class="float-right">
            <input type="submit" class="btn btn-primary btn-lg" value="{{$buttonText}}"/>
        </div>
    </div>
</div>

