@extends('layouts.admin')
@section('title','Employment Histories')
@section('content')

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-12">
                    <div class="float-left">
                        <h4 class="header-title">Employment Histories</h4>
                    </div>
                    <div class="float-right">
                        @if(checkPermission('employee-create'))
                            <a class="btn btn-primary" href="#newCountry" data-toggle="modal"><i class="fa fa-plus"></i> New Employment History</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            @include('alerts._flash')

            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm" id="table">
                    <thead class="text-uppercase text-center bg-blue">
                        <tr class="text-white">
                            <th scope="col">Employee Name</th>
                            <th scope="col">Designation</th>
                            <th scope="col" >History</th>
                            <th scope="col" >Start Date</th>
                            <th scope="col" >End Date</th>
                            <th scope="col" >Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employmentHistory as $emphistory)
                            <tr>
                                <td class="text-left">{{$emphistory->employee->full_name}}</td>
                                <td class="text-left">{{$emphistory->designation->name}}</td>
                                <td class="text-center">{{$emphistory->employment_type->name}}</td>
                                <td class="text-center">{{$emphistory->start_date}}</td>
                                <td class="text-center">{{$emphistory->end_date}}</td>
                                <td class="text-center p-0">
                                    <div class="btn btn-group">
                                        @if(checkPermission('employee-update'))
                                            <a class="btn btn-primary btn-sm mr-2" href="{{route('employmentHistories.edit',$emphistory['id'])}}" title="Edit"><i class="fa fa-edit"></i></a>
                                        @endif
                                        @if(checkPermission('employee-update'))
                                            <form class="form-delete" method="post" action="{{route('employmentHistories.destroy',$emphistory['id'])}}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete Confirmation?')"><i class="fa fa-trash-alt"></i></button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if(checkPermission('employee-create'))
        <!-- start create new employmentHistory form modal -->
        <div class="modal fade" id="newCountry" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New Employment History</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{route('employmentHistories.store')}}" class="form-horizontal" role="form" id="employmentHistoryForm" name="employmentHistoryForm" autocomplete="off" >
                        @csrf
                        <div class="modal-body">

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="col-form-label">Employee Name<span class="star">*</span></label>
                                    <select name="employee_id" class="form-control @error('employee_id') is-invalid @enderror" required>
                                        <option value="">Select Employee...</option>
                                        @foreach($employees as $employee)
                                            <option value="{{$employee->id}}" {{old('employee_id') == $employee->id ? 'selected' : '' }}>{{$employee->full_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('employee_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label class="col-form-label">Designation<span class="star">*</span></label>
                                    <select name="designation_id" class="form-control @error('designation_id') is-invalid @enderror" required>
                                        <option value="">Select Employee...</option>
                                        @foreach($designations as $designation)
                                            <option value="{{$designation->id}}" {{old('designation_id') == $designation->id ? 'selected' : '' }}>{{$designation->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('designation_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="col-form-label">Employment History<span class="star">*</span></label>
                                    <select name="employment_type_id" class="form-control @error('employment_type_id') is-invalid @enderror " required>
                                        <option value="">Select Employee...</option>
                                        @foreach($employmentTypes as $employment_type)
                                            <option value="{{$employment_type->id}}" {{old('employment_type_id') == $employment_type->id ? 'selected' : '' }}>{{$employment_type->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('employment_type_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label class="col-form-label">Start date </label>
                                    <input type="text" id="date" name="start_date" value="{{old('start_date')}}" class="form-control" required>
                                    @error('start_date')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="col-form-label">End date</label>
                                    <input type="text" id="end_date" name="end_date" value="{{old('end_date')}}" class="form-control" >
                                    @error('end_date')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="btn-save">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end create new employmentHistory form modal -->

    @endif

@endsection
