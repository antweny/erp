<label class="col-form-label">Measurement</label>
<select name="item_unit_id" class="form-control @error('item_unit_id') is-invalid @enderror" >
    <option value="">Select Unit...</option>
    @foreach($itemUnits as $itemUnit)
        <option value="{{$itemUnit->id}}" {{old('item_unit_id',$value) == $itemUnit->id ? 'selected' : '' }}>{{$itemUnit->name}}</option>
    @endforeach
</select>
@error('item_unit_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
