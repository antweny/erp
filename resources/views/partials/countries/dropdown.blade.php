<label class="col-form-label">Country</label>
<select class="form-control @error('country_id') is-invalid @enderror single-select" style="width: 100%;" name="country_id">
    <option value="">Select country...</option>
    @foreach($countries as $country)
        <option value="{{$country->id}}" {{old('country_id',$value) == $country->id ? 'selected' : ''}}>{{$country->name}}</option>
    @endforeach
</select>
@error('country_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror



