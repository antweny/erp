    @csrf
    <div class="form-group row">
        <div class="col-md-12">
            @include('partials.employees.dropdown',['old'=>$jobHistory->employee_id])
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-6">
            <label class="col-form-label">Designation<span class="star">*</span></label>
            <select name="designation_id" class="form-control @error('designation_id') is-invalid @enderror" required>
                <option value="">Select Employee...</option>
                @foreach($designations as $designation)
                    <option value="{{$designation->id}}" {{$jobHistory->designation_id == $designation->id ? 'selected' : '' }}>{{$designation->name}}</option>
                @endforeach
            </select>
            @error('designation_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
        <div class="col-md-6">
            <label class="col-form-label">Employment History<span class="star">*</span></label>
            <select name="job_type_id" class="form-control @error('job_type_id') is-invalid @enderror " required>
                <option value="">Select Employee...</option>
                @foreach($jobTypes as $job_type)
                    <option value="{{$job_type->id}}" {{$jobHistory->job_type_id == $job_type->id ? 'selected' : '' }}>{{$job_type->name}}</option>
                @endforeach
            </select>
            @error('job_type_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-6">
            <label class="col-form-label">Start date </label>
            <input type="text" id="date" name="start_date" value="{{mysql_to_date($jobHistory->start_date)}}" class="form-control" required>
            @error('start_date')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
        <div class="col-md-6">
            <label class="col-form-label">End date</label>
            <input type="text" id="end_date" name="end_date" value="{{mysql_to_date($jobHistory->end_date)}}" class="form-control" >
            @error('end_date')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
    </div>

    <div class="form-group row justify-content-center">
        <div class="col-md-6 float-left">
            <a class="btn btn-dark" href="{{route('jobHistories.index')}}">Cancel</a>
        </div>
        <div class="col-md-6">
            <div class="float-right">
                <input type="submit" class="btn btn-success" value="{{$buttonText}}"/>
            </div>
        </div>
    </div>
