<label class="col-form-label">Event Category <span class="star">*</span> </label>
<select name="event_category_id" class="form-control @error('event_category_id') is-invalid @enderror" required>
    <option value="">Select Category....</option>
    @foreach($eventCategories as $event_category)
        <option value="{{$event_category->id}}" {{old('event_category_id',$value) == $event_category->id ? 'selected' : ''}}>{{$event_category->name}}</option>
    @endforeach
</select>
@error('event_category_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
