@csrf

<div class="form-group row">
    <div class="col-md-6">
        <label class="col-form-label">Event Name <span class="star">*</span></label>
        <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }} " value="{{old('name',$event->name)}}" placeholder="Ex. Gender Festival" required/>
        @if ($errors->has('name'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('name') }}</strong></span>@endif
    </div>
    <div class="col-md-6">
        <label name="venue" class="col-form-label">Venue</label>
        <input list="venues" type="text" value="{{old('venue',$event->venue->name)}}" name="venue" class="form-control {{ $errors->has('venue') ? ' is-invalid' : '' }}" />
        <datalist id="venues">
            @foreach($venues as $venue)
                <option value="{{$venue->name}}"/>
            @endforeach
        </datalist>
        @if ($errors->has('venue'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('venue') }}</strong></span>@endif
    </div>
</div>
<div class="form-group row">
    <div class="col-md-6">
        <label class="col-form-label">Event Category <span class="star">*</span> </label>
        <select name="event_category_id" class="form-control @error('event_category_id') is-invalid @enderror" required>
            <option value="">Select Category....</option>
            @foreach($eventCategories as $event_category)
                <option value="{{$event_category->id}}" {{old('event_category_id',$event->event_category_id) == $event_category->id ? 'selected' : ''}}>{{$event_category->name}}</option>
            @endforeach
        </select>
        @error('event_category_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
    <div class="col-md-6">
        <label class="col-form-label">Coordinator <span class="star">*</span></label>
        <select name="employee_id" class="form-control @error('employee_id') is-invalid @enderror" required>
            <option value="">Select Coordinator</option>
            @foreach($employees as $employee)
                <option value="{{$employee->id}}" {{old('employee_id',$event->employee_id) == $employee->id ? 'selected' : ''}}>{{$employee->full_name}}</option>
            @endforeach
        </select>
        @error('employee_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
</div>

<div class="form-group row">
    <div class="col-md-6">
        <label class="col-form-label">Organiser(s) <span class="star">*</span></label>
        <select name="organization_id[]" class="form-control @error('organization_id') is-invalid @enderror multiple-select-id" multiple="multiple" required >
            <option value="">Select Organiser</option>
            @foreach($organizations as $organization)
                <option value="{{$organization->id}}" {{old('organization_id',$event->organization_id) == $organization->id ? 'selected' : ''}}>{{$organization->organization_name}}</option>
            @endforeach
        </select>
        @error('organization_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
    <div class="col-md-6">
        <label class="col-form-label">Facilitator(s) </label>
        <select name="individual_id[]" class="form-control @error('individual_id') is-invalid @enderror multiple-select-id" required multiple="multiple">
            <option value="">Select Facilitator(s)</option>
            @foreach($individuals as $individual)
                <option value="{{$individual->id}}" {{old('individual_id',$event->individual_id) }}>{{$individual->full_name}}</option>
            @endforeach
        </select>
        @error('individual_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
</div>

<div class="form-group row">
    <div class="col-md-6">
        <label class="col-form-label">From date </label>
        <input type="text" id="start_date" name="start_date" value="{{old('start_date',mysql_to_date($event->start_date))}}" class="form-control" >
        @error('start_date')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
    <div class="col-md-6">
        <label class="col-form-label">To date</label>
        <input type="text" id="end_date" name="end_date" value="{{old('end_date',mysql_to_date($event->end_date))}}" class="form-control" >
        @error('end_date')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
</div>

<div class="form-group row">
    <div class="col-sm-12">
        <label class="col-form-label">Objectives <span class="star">*</span></label>
        <textarea name="objectives" id="objectives" class="event_objectives form-control{{ $errors->has('objectives') ? ' is-invalid' : '' }}" rows="5" required>{{old('objectives',$event->objectives)}}</textarea>
        @if ($errors->has('objectives'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('objectives') }}</strong></span>@endif
    </div>
</div>

<div class="form-group row justify-content-center">
    <div class="col-md-12">
        <div class="float-left">
            <a class="btn btn-outline-secondary" href="{{route('employee.events.index')}}" title="create">cancel</a>
        </div>
        <div class="float-right">
            <input type="submit" class="btn btn-primary" value="{{$buttonText}}"/>
        </div>
    </div>
</div>
