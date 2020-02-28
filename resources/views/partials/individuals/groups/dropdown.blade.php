<label class="col-form-label">{{$label ?? 'Participant Group'}}</label>
<select name="group_id" class="form-control @error('group_id') is-invalid @enderror single-select">
    <option value="">Please select...</option>
    @foreach($groups as $group)
        <option value="{{$group->id}}" {{old('group_id',$old) == $group->id ? 'selected' : ''}}>{{$group->name}}</option>
    @endforeach
</select>
@error('group_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
