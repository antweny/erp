<label class="col-form-label">To date</label>
<input type="text" id="end_date" name="end_date" value="{{old('end_date',$old)}}" class="form-control @error('end_date') is-invalid @enderror" >
@error('end_date')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
