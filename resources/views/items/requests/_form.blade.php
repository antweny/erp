@csrf

<div class="form-group row">
    <div class="col-md-6">
        <label class="col-form-label" name="title">Item Name <span class="star">*</span></label>
        <select name="item_id" class="form-control" required>
            <option value="">Select Category...</option>
            @foreach($items as $item)
                <option value="{{$item->id}}" {{old('item_id') == $item->id ? 'selected' : '' }}>{{$item->name}}</option>
            @endforeach
        </select>
        @error('item_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
    <div class="col-md-6">
        <label class="col-form-label">Required <span class="star">*</span> </label>
        <input type="number" name="required" class="form-control @error('required') is-invalid @enderror" value="{{old('required',$itemIssued->required)}}" required></input>
        @error('required')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
</div>

<div class="form-group row justify-content-center">
    <div class="col-md-12">
        <div class="float-left">
            <a class="btn btn-outline-secondary" href="{{route('itemRequest.index')}}" title="create">cancel</a>
        </div>
        <div class="float-right">
            <input type="submit" class="btn btn-primary" value="{{$buttonText}}"/>
        </div>
    </div>
</div>
