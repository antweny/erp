@csrf

<div class="form-group row">
    <div class="col-md-12">
        <label class="col-form-label">GDSS Topic Name <span class="star">*</span></label>
        <select name="gender_series_id" class="form-control single-select"  required>
            <option value="">Please Topic...</option>
            @foreach($genders as $gender)
                <option value="{{$gender->id}}" {{old('gender_series_id',$genderSeriesParticipant->gender_series_id) == $gender->id ? 'selected' : '' }}>{{$gender->topic}}</option>
            @endforeach
        </select>
        @error('gender_series_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
</div>
<div class="form-group row">
    <div class="col-md-12">
        <label class="col-form-label">Participant Name <span class="star">*</span></label>
        <select name="individual_id" class="form-control single-select"  required>
            <option value="">Please select...</option>
            @foreach($individuals as $individual)
                <option value="{{$individual->id}}" {{old('individual_id',$genderSeriesParticipant->individual_id) == $individual->id ? 'selected' : '' }}>{{$individual->full_name}}</option>
            @endforeach
        </select>
        @error('individual_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
</div>

<div class="form-group row">
    <div class="col-md-12">
        <label class="col-form-label">Group/Organization Name</label>
        <select name="organization_id" class="single-select form-control">
            <option value="">Please select...</option>
            @foreach($organizations as $organization)
                <option value="{{$organization->id}}" {{old('organization_id',$genderSeriesParticipant->organization_id) == $organization->id ? 'selected' : ''}}>{{$organization->organization_name}}</option>
            @endforeach
        </select>
        @error('organization_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
</div>

<div class="form-group row">
    <div class="col-md-12">
        <label class="col-form-label">Ward</label>
        <input list="wards" type="text"  name="ward" value="{{old('ward',$genderSeriesParticipant->ward->name)}}" class="form-control{{ $errors->has('ward') ? ' is-invalid' : '' }}" >
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
            <a class="btn btn-outline-secondary" href="{{route('genderSeriesParticipants.index')}}" title="create">cancel</a>
        </div>
        <div class="float-right">
            <input type="submit" class="btn btn-primary btn-lg" value="{{$buttonText}}"/>
        </div>
    </div>
</div>

