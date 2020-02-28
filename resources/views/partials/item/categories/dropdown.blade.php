<label class="col-form-label">Category <span class="star">*</span></label>
<select name="item_category_id" class="form-control @error('item_category_id') is-invalid @enderror" required>
    <option value="">Select Category...</option>
    @foreach($itemCategories as $itemCategory)
        <option value="{{$itemCategory->id}}" {{old('item_category_id',$value) == $itemCategory->id ? 'selected' : '' }}>{{$itemCategory->name}}</option>
    @endforeach
</select>
@error('item_category_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
