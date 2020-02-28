<label class="col-form-label">{{ $label ?? 'Employee Name'}}<span class="star">*</span> </label>
<select name="employee_id" class="form-control @error('employee_id') is-invalid @enderror single-select" required>
    <option value="">Select Employee...</option>
    @foreach($employees as $employee)
        <option value="{{$employee->id}}" {{old('employee_id',$old) == $employee->id ? 'selected' : '' }}>{{$employee->full_name}}</option>
    @endforeach
</select>
@error('employee_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
