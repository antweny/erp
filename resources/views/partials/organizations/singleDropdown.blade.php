<label class="col-form-label">Group/Organization Name<span class="star">*</span></label>
<select name="organization_id" class="form-control @error('organization_id') is-invalid @enderror single-select" >
    <option value="">Select</option>
    @foreach($organizations as $organization)
        <option value="{{$organization->id}}" {{ old('organization_id',$old)== $organization->id ? 'selected' : ''}}>{{$organization->organization_name}}</option>
    @endforeach
</select>
@error('organization_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
