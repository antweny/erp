<label class="col-form-label">City</label>
<select class="form-control @error('city_id') is-invalid @enderror single-select" style="width: 100%;" name="city_id">
    <option value="">Select city...</option>
    @foreach($cities as $city)
        <option value="{{$city->id}}" {{old('city_id',$old) == $city->id ? 'selected' : ''}}>{{$city->name}}</option>
    @endforeach
</select>
@error('city_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
