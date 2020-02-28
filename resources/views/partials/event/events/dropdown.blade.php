<label class="col-form-label">Event Name <span class="star">*</span></label>
<select name="event_id" class="form-control @error('event_id') is-invalid @enderror single-select"  required>
    <option value="">Please select...</option>
    @foreach($events as $event)
        <option value="{{$event->id}}" {{old('event_id',$old) == $event->id ? 'selected' : '' }}>{{$event->name}}</option>
    @endforeach
</select>
@error('event_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
