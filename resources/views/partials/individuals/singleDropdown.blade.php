<label class="col-form-label">{{$label ?? 'Individual Name'}} <span class="star">*</span></label>
<select name="individual_id" class="form-control @error('individual_id') is-invalid @enderror single-select" required>
    <option value="">Select Individual.. </option>
    @foreach($individuals as $individual)
        <option value="{{$individual->id}}" {{old('individual_id',$old)  == $individual->id ? 'selected' : '' }}>{{$individual->full_name}}</option>
    @endforeach
</select>
@error('individual_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
