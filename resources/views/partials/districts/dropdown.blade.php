<label class="col-form-label">District</label>
<select class="form-control @error('district_id') is-invalid @enderror single-select" style="width: 100%;" name="district_id">
    <option value="">Select district...</option>
    @foreach($districts as $district)
        <option value="{{$district->id}}" {{old('district_id',$old) == $district->id ? 'selected' : ''}}>{{$district->name}}</option>
    @endforeach
</select>
@error('district_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
