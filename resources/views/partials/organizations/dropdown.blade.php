<label class="col-form-label">{{$label ?? 'Organization'}}<span class="star">*</span></label>
<select name="organization_id[]" class="form-control @error('organization_id') is-invalid @enderror multiple-select-id" multiple="multiple"  >
    <option value="">Select Organiser</option>
    @foreach($organizations as $organization)
        <option value="{{$organization->id}}" {{ (collect(old('organization_id'))->contains($organization->id)) ? 'selected' : ''}}>{{$organization->organization_name}}</option>
    @endforeach
</select>
@error('organization_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
