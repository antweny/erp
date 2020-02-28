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
        @include('partials.employees.dropdown',['old' => null ?? $event->employee_id,'label' => 'Coordinator'])
    </div>
</div>

<div class="form-group row">
    <div class="col-md-6">
        @include('partials.organizations.dropdown',['label'=> 'Organisers'])
    </div>
    <div class="col-md-6">
        @include('partials.individuals.dropdown',['label'=> 'Facilitators'])
    </div>
</div>

<div class="form-group row">
    <div class="col-md-6">
        @include('partials.dates.start_date',['old'=>null ?? mysql_to_date($event->start_date)])
    </div>
    <div class="col-md-6">
        @include('partials.dates.end_date',['old'=>null ?? mysql_to_date($event->end_date)])
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
            <a class="btn btn-dark" href="{{route('events.index')}}" title="create">cancel</a>
        </div>
        <div class="float-right">
            <input type="submit" class="btn btn-success" value="{{$buttonText}}"/>
        </div>
    </div>
</div>
