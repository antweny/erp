<label class="col-form-label">Facilitator <span class="star">*</span></label>
<select name="facilitator" class="form-control @error('facilitator') is-invalid @enderror single-select" required>
    <option value="">Select Facilitator </option>
    @foreach($individuals as $individual)
        <option value="{{$individual->id}}" {{old('facilitator',$old)  == $individual->id ? 'selected' : '' }}>{{$individual->full_name}}</option>
    @endforeach
</select>
@error('facilitator')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
