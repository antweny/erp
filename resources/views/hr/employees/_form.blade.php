@csrf

<div class="form-group row">
    <div class="col-md-4">
        <label class="col-form-label">Employee Number <span class="star">*</span> </label>
        <input type="text" name="employee_no" class="form-control @error('employee_no') is-invalid @enderror" value="{{old('employee_no',$employee->employee_no)}}" required></input>
        @error('employee_no')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
    <div class="col-md-4">
        <label class="col-form-label">First Name <span class="star">*</span> </label>
        <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{old('first_name',$employee->first_name)}}" required></input>
        @error('first_name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
    <div class="col-md-4">
        <label class="col-form-label">Middle Name <span class="star">*</span></label>
        <input type="text" name="middle_name" class="form-control @error('middle_name') is-invalid @enderror" value="{{old('middle_name',$employee->middle_name)}}" required></input>
        @error('middle_name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
</div>


<div class="form-group row">
    <div class="col-md-4">
        <label class="col-form-label">Last Name <span class="star">*</span></label>
        <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{old('last_name',$employee->last_name)}}" required></input>
        @error('last_name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
    <div class="col-md-4">
        <label class="col-form-label">Date of Birth <span class="star">*</span> </label>
        <input type="text" id="dob" name="dob" class="form-control @error('dob') is-invalid @enderror" value="{{old('dob',mysql_to_date($employee->dob))}}" required></input>
        @error('dob')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
    <div class="col-md-4">
        <label class="col-form-label">Email <span class="star">*</span></label>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email',$employee->email)}}" required></input>
        @error('email')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>

</div>

<div class="form-group row">
    <div class="col-md-4">
        <label class="col-form-label">Mobile <span class="star">*</span></label>
        <input type="number" name="mobile" class="form-control @error('mobile') is-invalid @enderror" value="{{old('mobile',$employee->mobile)}}" required></input>
        @error('mobile')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
    <div class="col-md-4">
        <label class="col-form-label">Department <span class="star">*</span></label>
        <select name="department_id" class="form-control @error('department_id') is-invalid @enderror" required>
            <option value="">Select Department...</option>
            @foreach($departments as $department)
                <option value="{{$department->id}}" {{old('department_id',$employee->department_id) == $department->id ? 'selected' : '' }}>{{$department->name}}</option>
            @endforeach
        </select>
        @error('department_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
    <div class="col-md-4">
        <label class="col-form-label">Join Date<span class="star">*</span> </label>
        <input type="text" id="doj" name="doj" class="form-control @error('doj') is-invalid @enderror" value="{{old('doj',mysql_to_date($employee->doj))}}" required></input>
        @error('doj')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
</div>

<div class="form-group row justify-content-center mt-5">
    <div class="col-md-12">
        <div class="float-left">
            <a class="btn btn-outline-secondary" href="{{route('employee.index')}}" title="create">cancel</a>
        </div>
        <div class="float-right">
            <input type="submit" class="btn btn-primary" value="{{$buttonText}}"/>
        </div>
    </div>
</div>

