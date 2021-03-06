@extends('layouts.templates.hrm')
@section('title','Departments')
@section('content')

    <div class="card">
        <div class="card-header">
            <div class="float-left">
                <h4 class="header-title">List Departments</h4>
            </div>
            <div class="float-right">
                @can('department-create')
                    <a class="btn btn-success" href="#newRecord" data-toggle="modal"><i class="fa fa-plus"></i> Add Department</a>
                @endcan
            </div>
        </div>
        <div class="card-body">
            @include('alerts._flash')
            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm" id="table">
                    <thead class="text-uppercase text-center">
                        <tr class="text-white">
                            <th scope="col">Name</th>
                            <th scope="col">Descriptions</th>
                            <th scope="col" >Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($departments as $department)
                            <tr>
                                <td class="text-left">{{$department->name}}</td>
                                <td class="text-center">{{$department->desc}}</td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        @can('department-update')
                                            <a class="btn btn-primary btn-sm mr-2" href="{{route('departments.edit',$department->id)}}" title="Edit"><i class="fa fa-edit"></i></a>
                                        @endcan

                                        @can('department-delete')
                                            <form class="form-delete" method="post" action="{{route('departments.destroy',$department->id)}}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete {{$department->name}} department?')" title="Delete"><i class="fa fa-trash-alt"></i></button>
                                            </form>
                                        @endcan

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@if(checkPermission('department-create'))
    <!-- start create new pillar form modal -->
    <div class="modal fade" id="newRecord" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Department</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{route('departments.store')}}" class="form-horizontal" role="form" autocomplete="off">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="col-form-label">Department Name <span class="star">*</span></label>
                                <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }} " value="{{old('name')}}" placeholder="Ex. Finance, KRA, IT" required/>
                                @if ($errors->has('name'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('name') }}</strong></span>@endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label class="col-form-label">Descriptions</label>
                                <textarea name="desc" id="desc" class="form-control{{ $errors->has('desc') ? ' is-invalid' : '' }}" rows="5">{{old('desc')}}</textarea>
                                @if ($errors->has('desc'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('desc') }}</strong></span>@endif
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" id="btn-save">save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end create new pillar form modal -->
@endif

@endsection
