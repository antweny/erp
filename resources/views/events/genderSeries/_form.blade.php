@csrf

<div class="form-group row">
    <div class="col-md-12">
        <label class="col-form-label">Topic Title <span class="star">*</span></label>
        <input type="text" name="topic" id="topic" class="form-control {{ $errors->has('topic') ? ' is-invalid' : '' }} " value="{{old('topic',$genderSeries->topic)}}" required/>
        @if ($errors->has('topic'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('topic') }}</strong></span>@endif
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <label class="col-form-label">Coordinator <span class="star">*</span></label>
        <select name="coordinator" class="form-control @error('coordinator') is-invalid @enderror" required>
            <option value="">Select Coordinator</option>
            @foreach($employees as $employee)
                <option value="{{$employee->id}}" {{old('coordinator',$genderSeries->coordinator) == $employee->id ? 'selected' : ''}}>{{$employee->full_name}}</option>
            @endforeach
        </select>
        @error('coordinator')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
    <div class="col-md-4">
        <label class="col-form-label">Facilitator <span class="star">*</span></label>
        <select name="facilitator" class="form-control @error('facilitator') is-invalid @enderror single-select" required>
            <option value="">Select Facilitator </option>
            @foreach($individuals as $individual)
                <option value="{{$individual->id}}" {{old('facilitator',$genderSeries->facilitator)  == $individual->id ? 'selected' : '' }}>{{$individual->full_name}}</option>
            @endforeach
        </select>
        @error('facilitator')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
    <div class="col-md-4">
        <label class="col-form-label">Date <span class="star">*</span></label>
        <input type="text" id="start_date" name="date" value="{{old('date',mysql_to_date($genderSeries->date))}}" class="form-control" required >
        @error('date')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
</div>


<div class="form-group row">
    <div class="col-sm-12">
        <label class="col-form-label">Follow up</label>
        <textarea name="follow_up" id="follow_up" class="form-control{{ $errors->has('follow_up') ? ' is-invalid' : '' }}" rows="7">{{old('follow_up',$genderSeries->follow_up)}}</textarea>
        @if ($errors->has('follow_up'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('follow_up') }}</strong></span>@endif
    </div>
</div>

<div class="form-group row justify-content-center">
    <div class="col-md-12">
        <div class="float-left">
            <a class="btn btn-outline-secondary" href="{{route('genderSeries.index')}}" title="create">cancel</a>
        </div>
        <div class="float-right">
            <input type="submit" class="btn btn-primary" value="{{$buttonText}}"/>
        </div>
    </div>
</div>
