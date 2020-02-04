@csrf

<div class="form-group row">
    <div class="col-md-6">
        <label class="col-form-label">Date Issued <span class="star">*</span> </label>
        <input type="date" name="date_issued" class="form-control @error('date_issued') is-invalid @enderror" value="{{old('date_issued')}}" required></input>
        @error('date_issued')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
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
</div>

<div class="form-group row">
    <div class="col-md-6">
        <label class="col-form-label">Required <span class="star">*</span> </label>
        <input type="number" name="required" class="form-control @error('required') is-invalid @enderror" value="{{old('required',$itemIssued->required)}}" required></input>
        @error('required')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
    <div class="col-md-6">
        <label class="col-form-label">Supplied<span class="star">*</span> </label>
        <input type="number" name="quantity" class="form-control @error('quantity') is-invalid @enderror" value="{{old('quantity')}}" required></input>
        @error('quantity')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
</div>

<div class="form-group row">
    <div class="col-md-12">
        <label class="col-form-label">Employee Name<span class="star">*</span> </label>
        <select name="employee_id" class="form-control" required>
            <option value="">Select Employee...</option>
            @foreach($employees as $employee)
                <option value="{{$employee->id}}" {{old('employee_id') == $employee->id ? 'selected' : '' }}>{{$employee->full_name}}</option>
            @endforeach
        </select>
        @error('employee')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
</div>


<div class="form-group row justify-content-center">
    <div class="col-md-12">
        <div class="float-left">
            <a class="btn btn-outline-secondary" href="{{route('itemIssued.index')}}" title="create">cancel</a>
        </div>
        <div class="float-right">
            <input type="submit" class="btn btn-primary" value="{{$buttonText}}"/>
        </div>
    </div>
</div>
