<label class="col-form-label" name="title">Item Name <span class="star">*</span></label>
<select name="item_id" class="form-control @error('item_id') is-invalid @enderror single-select">
    <option value="">Select Item...</option>
    @foreach($items as $item)
        <option value="{{$item->id}}" {{old('item_id',$value) == $item->id ? 'selected' : '' }}>{{$item->name}}</option>
    @endforeach
</select>
@error('item_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
