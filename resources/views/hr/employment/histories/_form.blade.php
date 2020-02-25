    @csrf
    <div class="form-group row">
        <div class="col-md-12">
            <label class="col-form-label">Employee Name<span class="star">*</span></label>
            <select name="employee_id" class="form-control @error('employee_id') is-invalid @enderror" required>
                <option value="">Select Employee...</option>
                @foreach($employees as $employee)
                    <option value="{{$employee->id}}" {{$employmentHistory->employee_id == $employee->id ? 'selected' : '' }}>{{$employee->full_name}}</option>
                @endforeach
            </select>
            @error('employee_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-6">
            <label class="col-form-label">Designation<span class="star">*</span></label>
            <select name="designation_id" class="form-control @error('designation_id') is-invalid @enderror" required>
                <option value="">Select Employee...</option>
                @foreach($designations as $designation)
                    <option value="{{$designation->id}}" {{$employmentHistory->designation_id == $designation->id ? 'selected' : '' }}>{{$designation->name}}</option>
                @endforeach
            </select>
            @error('designation_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
        <div class="col-md-6">
            <label class="col-form-label">Employment History<span class="star">*</span></label>
            <select name="employment_type_id" class="form-control @error('employment_type_id') is-invalid @enderror " required>
                <option value="">Select Employee...</option>
                @foreach($employmentTypes as $employment_type)
                    <option value="{{$employment_type->id}}" {{$employmentHistory->employment_type_id == $employment_type->id ? 'selected' : '' }}>{{$employment_type->name}}</option>
                @endforeach
            </select>
            @error('employment_type_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-6">
            <label class="col-form-label">Start date </label>
            <input type="text" id="date" name="start_date" value="{{mysql_to_date($employmentHistory->start_date)}}" class="form-control" required>
            @error('start_date')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
        <div class="col-md-6">
            <label class="col-form-label">End date</label>
            <input type="text" id="end_date" name="end_date" value="{{mysql_to_date($employmentHistory->end_date)}}" class="form-control" >
            @error('end_date')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
    </div>

    <div class="form-group row justify-content-center">
        <div class="col-md-6 float-left">
            <a class="btn btn-outline-secondary" href="{{route('employmentHistories.index')}}">Cancel</a>
        </div>
        <div class="col-md-6">
            <div class="float-right">
                <input type="submit" class="btn btn-primary" value="{{$buttonText}}"/>
            </div>
        </div>
    </div>
