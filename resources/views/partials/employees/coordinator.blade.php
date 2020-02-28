<label class="col-form-label">Coordinator<span class="star">*</span> </label>
<select name="coordinator" class="form-control @error('coordinator') is-invalid @enderror single-select" required>
    <option value="">Select Employee...</option>
    @foreach($employees as $employee)
        <option value="{{$employee->id}}" {{old('coordinator',$old) == $employee->id ? 'selected' : '' }}>{{$employee->full_name}}</option>
    @endforeach
</select>
@error('coordinator')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
