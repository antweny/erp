<label class="col-form-label">Participant Role</label>
<select name="participant_role_id" class="form-control @error('group_id') is-invalid @enderror single-select ">
    <option value="">Please select...</option>
    @foreach($roles as $role)
        <option value="{{$role->id}}" {{old('participant_role_id',$old) == $role->id ? 'selected' : ''}}>{{$role->name}}</option>
    @endforeach
</select>
@error('participant_role_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
