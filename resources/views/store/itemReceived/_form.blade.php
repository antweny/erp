@csrf

    <div class="form-group row">
        <div class="col-md-6">
            <label class="col-form-label">Date Received <span class="star">*</span> </label>
            <input type="date" name="date_received" class="form-control @error('date_received') is-invalid @enderror" value="{{old('date_received',$itemReceived->date_received)}}"></input>
            @error('date_received')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
        <div class="col-md-6">
                @include('partials.item.items.dropdown',['value'=>null])
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-6">
            <label class="col-form-label">Quantity <span class="star">*</span> </label>
            <input type="number" name="quantity" class="form-control @error('date_received') is-invalid @enderror" value="{{old('quantity',$itemReceived->quantity)}}" required></input>
            @error('quantity')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
        <div class="col-md-6">
            <label class="col-form-label">Unit Rate <span class="star">*</span> </label>
            <input type="number" name="unit_rate" class="form-control @error('unit_rate') is-invalid @enderror" value="{{old('unit_rate',$itemReceived->unit_rate)}}" required></input>
            @error('unit_rate')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-12">
            <label class="col-form-label">Remarks</label>
            <textarea name="remarks" id="desc" class="form-control @error('remarks') is-invalid @enderror" rows="3">{{old('remarks',$itemReceived->remarks)}}</textarea>
            @error('remarks')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
    </div>


    <div class="form-group row justify-content-center">
        <div class="col-md-12">
            <div class="float-left">
                <a class="btn btn-dark" href="{{route('itemReceived.index')}}" title="create">cancel</a>
            </div>
            <div class="float-right">
                <input type="submit" class="btn btn-success" value="{{$buttonText}}"/>
            </div>
        </div>
    </div>
