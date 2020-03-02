<label class="col-form-label">Sector</label>
<select class="form-control @error('sector_id') is-invalid @enderror" name="sector_id">
    <option value="">Select sector...</option>
    @foreach($sectors as $sector)
        <option value="{{$sector->id}}" {{old('sector_id',$old) == $sector->id ? 'selected' : ''}}>{{$sector->name}}</option>
    @endforeach
</select>
@error('sector_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
