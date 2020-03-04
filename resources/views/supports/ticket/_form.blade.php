@csrf
<div class="form-group row">
    <div class="col-md-6">
        <label class="col-form-label">Ticket Title <span class="star">*</span> </label>
        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{old('title',$ticket->title)}}" required></input>
        @error('title')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
    <div class="col-md-6">
        @include('partials.employees.dropdown',['old'=>null ?? $ticket->employee_id,'label'=>'Submitted By'])
    </div>
</div>

<div class="form-group row">
    <div class="col-md-4">
        <label class="col-form-label">Ticket Category</label>
        <select name="ticket_category_id" class="form-control @error('ticket_category_id') is-invalid @enderror single-select" required>
            <option value="">--Select Ticket Category--</option>
            @foreach($categories as $category)
                <option value="{{$category->id}}" {{old('ticket_category_id',$ticket->ticket_category_id) == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
            @endforeach
        </select>
        @error('ticket_category_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
    <div class="col-md-4">
        <label class="col-form-label">Priority</label>
        <select class="form-control @error('priority') is-invalid @enderror" name="priority">
            <option value="">--Select Ticket Priority--</option>
            <option value="L" {{old('priority',$ticket->priority) == 'L' ? 'selected' : ''}}>Low</option>
            <option value="M" {{old('priority',$ticket->priority) == 'M' ? 'selected' : ''}}>Medium</option>
            <option value="H" {{old('priority',$ticket->priority) == 'H' ? 'selected' : ''}}>High</option>
            <option value="U" {{old('priority',$ticket->priority) == 'U' ? 'selected' : ''}}>Urgent</option>
        </select>
        @error('priority')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
    <div class="col-md-4">
        <label class="col-form-label">Status</label>
        <select class="form-control @error('priority') is-invalid @enderror" name="status">
            <option value="">--Select Ticket Status--</option>
            <option value="O" {{old('status',$ticket->status) == 'O' ? 'selected' : ''}}>Open</option>
            <option value="C" {{old('status',$ticket->status) == 'C' ? 'selected' : ''}}>Closed</option>
        </select>
        @error('status')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
</div>

<div class="form-group row">
    <div class="col-sm-12">
        <label class="col-form-label">Ticket Description</label>
        <textarea name="desc" id="desc" class="form-control @error('desc') is-invalid @enderror" rows="5">{{old('remarks',$ticket->desc)}}</textarea>
        @error('desc')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
</div>


<div class="form-group row justify-content-center">
    <div class="col-md-12">
        <div class="float-left">
            <a class="btn btn-dark" href="{{route('tickets.index')}}" title="create">cancel</a>
        </div>
        <div class="float-right">
            <input type="submit" class="btn btn-success" value="{{$buttonText}}"/>
        </div>
    </div>
</div>
