@extends('layouts.templates.hrm')
@section('title','Job Histories')
@section('content')

    <div class="card">
        <div class="card-header">
            <div class="float-left">
                <h4 class="header-title">Job Histories</h4>
            </div>
            <div class="float-right">
                @can('jobHistory-create')
                    <a class="btn btn-success" href="#newCountry" data-toggle="modal"><i class="fa fa-plus"></i> New Job History</a>
                @endcan
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
                        @foreach ($jobHistory as $emphistory)
                            <tr>
                                <td class="text-left">{{$emphistory->employee->full_name}}</td>
                                <td class="text-left">{{$emphistory->designation->name}}</td>
                                <td class="text-center">{{$emphistory->job_type->name}}</td>
                                <td class="text-center">{{$emphistory->start_date}}</td>
                                <td class="text-center">{{$emphistory->end_date}}</td>
                                <td class="text-center p-0">
                                    <div class="btn btn-group">
                                        @if(checkPermission('jobHistory-update'))
                                            <a class="btn btn-primary btn-sm mr-2" href="{{route('jobHistories.edit',$emphistory['id'])}}" title="Edit"><i class="fa fa-edit"></i></a>
                                        @endif
                                        @if(checkPermission('jobHistory-update'))
                                            <form class="form-delete" method="post" action="{{route('jobHistories.destroy',$emphistory['id'])}}">
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

    @can('jobHistory-create')
        <!-- start create new jobHistory form modal -->
        <div class="modal fade" id="newCountry" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New Job History</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{route('jobHistories.store')}}" class="form-horizontal" role="form" id="jobHistoryForm" name="jobHistoryForm" autocomplete="off" >
                        @csrf
                        <div class="modal-body">

                            <div class="form-group row">
                                <div class="col-md-12">
                                    @include('partials.employees.dropdown',['old'=>null])
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label class="col-form-label">Designation<span class="star">*</span></label>
                                    <select name="designation_id" class="form-control @error('designation_id') is-invalid @enderror" required>
                                        <option value="">Select Designation...</option>
                                        @foreach($designations as $designation)
                                            <option value="{{$designation->id}}" {{old('designation_id') == $designation->id ? 'selected' : '' }}>{{$designation->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('designation_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="col-form-label">Job Type <span class="star">*</span></label>
                                    <select name="job_type_id" class="form-control @error('job_type_id') is-invalid @enderror " required>
                                        <option value="">Select Employee...</option>
                                        @foreach($jobTypes as $job_type)
                                            <option value="{{$job_type->id}}" {{old('job_type_id') == $job_type->id ? 'selected' : '' }}>{{$job_type->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('job_type_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label class="col-form-label">Start date <span class="star">*</span></label>
                                    <input type="text" id="start_date" name="start_date" value="{{old('start_date')}}" class="form-control @error('start_date') is-invalid @enderror" required>
                                    @error('start_date')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="col-form-label">End date </label>
                                    <input type="text" id="end_date" name="end_date" value="{{old('end_date')}}" class="form-control @error('end_date') is-invalid @enderror" >
                                    @error('end_date')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success" id="btn-save">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end create new jobHistory form modal -->

    @endcan

@endsection
