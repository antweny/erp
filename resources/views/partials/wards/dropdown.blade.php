<label class="col-form-label">Ward</label>
<select class="form-control @error('ward_id') is-invalid @enderror single-select" style="width: 100%;" name="ward_id">
    <option value="">Select ward...</option>
    @foreach($wards as $ward)
        <option value="{{$ward->id}}" {{old('ward_id',$old) == $ward->id ? 'selected' : ''}}>{{$ward->name}}</option>
    @endforeach
</select>
@error('ward_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
