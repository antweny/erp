<label class="col-form-label">{{$label ?? 'Individuals'}} </label>
<select name="individual_id[]" class="form-control @error('individual_id') is-invalid @enderror multiple-select-id"  multiple="multiple">
    <option value="">Select Facilitator(s)</option>
    @foreach($individuals as $individual)
        <option value="{{$individual->id}}" {{(collect(old('individual_id'))->contains($individual->id)) ? 'selected' : '' }}>{{$individual->full_name}}</option>
    @endforeach
</select>
@error('individual_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
