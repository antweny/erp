@csrf

<div class="form-group row">
    <div class="col-md-8">
        <label class="col-form-label" name="title">Item Name <span class="star">*</span></label>
        <select name="item_id" class="form-control @error('item_id') is-invalid @enderror single-select">
            <option value="">Select Item...</option>
            @foreach($items as $item)
                <option value="{{$item->id}}" {{old('item_id') == $item->id ? 'selected' : '' }}>{{$item->name}}</option>
            @endforeach
        </select>
        @error('item_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror

    </div>
    <div class="col-md-4">
        <label class="col-form-label">Date Issued <span class="star">*</span> </label>
        <input type="date" id="date_issued" name="date_issued" class="form-control @error('date_issued') is-invalid @enderror" value="{{old('date_issued')}}" required></input>
        @error('date_issued')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
</div>


<div class="form-group row">
    <div class="col-md-6">
        <label class="col-form-label">Required <span class="star">*</span> </label>
        <input type="number" name="required" class="form-control @error('required') is-invalid @enderror" value="{{old('required')}}" required></input>
        @error('required')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
    <div class="col-md-6">
        <label class="col-form-label">Quantity <span class="star">*</span> </label>
        <input type="number" name="quantity" class="form-control @error('quantity') is-invalid @enderror" value="{{old('quantity')}}" required></input>
        @error('quantity')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
</div>

<div class="form-group row">
    <div class="col-md-12">
        @include('partials.employees.dropdown',['value'=>null])
    </div>
</div>


<div class="form-group row">
    <div class="col-sm-12">
        <label class="col-form-label">Descriptions</label>
        <textarea name="desc" id="desc" class="form-control{{ $errors->has('desc') ? ' is-invalid' : '' }}" rows="5">{{old('desc')}}</textarea>
        @if ($errors->has('desc'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('desc') }}</strong></span>@endif
    </div>
</div>


<div class="form-group row justify-content-center">
    <div class="col-md-12">
        <div class="float-left">
            <a class="btn btn-dark" href="{{route('itemRequests.index')}}" title="create">cancel</a>
        </div>
        <div class="float-right">
            <input type="submit" class="btn btn-success" value="{{$buttonText}}"/>
        </div>
    </div>
</div>
