@csrf

<div class="form-group row">
    <div class="col-md-6">
        <label class="col-form-label">GDSS Topic Name <span class="star">*</span></label>
        <select name="gender_series_id" class="form-control single-select"  required>
            <option value="">Please Topic...</option>
            @foreach($genders as $gender)
                <option value="{{$gender->id}}" {{old('gender_series_id',$genderSeriesParticipant->gender_series_id) == $gender->id ? 'selected' : '' }}>{{$gender->topic}}</option>
            @endforeach
        </select>
        @error('gender_series_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
    <div class="col-md-6">
        @include('partials.individuals.singleDropdown',['old'=>null ?? $genderSeriesParticipant->individual_id,'label'=>'Participant Name'])
    </div>
</div>

<div class="form-group row">
    <div class="col-md-6">
        @include('partials.organizations.singleDropdown',['old'=>null ?? $genderSeriesParticipant->organization_id])
    </div>
    <div class="col-md-6">
        @include('partials.wards.dropdown',['old'=>null ?? $genderSeriesParticipant->ward_id])
    </div>
</div>

<div class="form-group row justify-content-center">
    <div class="col-md-12">
        <div class="float-left">
            <a class="btn btn-dark" href="{{route('genderSeriesParticipants.index')}}" title="create">cancel</a>
        </div>
        <div class="float-right">
            <input type="submit" class="btn btn-success" value="{{$buttonText}}"/>
        </div>
    </div>
</div>

