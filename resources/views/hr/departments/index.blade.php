@extends('layouts.hr')
@section('title','Departments')
@section('content')

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-12">
                    <div class="float-left">
                        <h4 class="header-title">Departments</h4>
                    </div>
                    <div class="float-right">
                        @if(checkPermission('department-create'))
                            <a class="btn btn-primary" href="#newRecord" data-toggle="modal"><i class="fa fa-plus"></i> Add Department</a>
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
                            <th scope="col">Name</th>
                            <th scope="col">Sort</th>
                            <th scope="col">Descriptions</th>
                            <th scope="col" >Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($departments as $department)
                            <tr>
                                <td class="text-left">{{$department->name}}</td>
                                <td class="text-center">{{$department->sort}}</td>
                                <td class="text-center">{{$department->desc}}</td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        @if(checkPermission('department-update'))
                                            <a class="btn btn-primary btn-sm mr-2" href="{{route('departments.edit',$department->id)}}" title="Edit"><i class="fa fa-edit"></i></a>
                                        @endif

                                        @if(checkPermission('department-delete'))
                                            <form class="form-delete" method="post" action="{{route('departments.destroy',$department->id)}}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete {{$department->name}} department?')" title="Delete"><i class="fa fa-trash-alt"></i></button>
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
                            <div class="col-md-8">
                                <label class="col-form-label">Department Name <span class="star">*</span></label>
                                <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }} " value="{{old('name')}}" placeholder="Ex. Finance, KRA, IT" required/>
                                @if ($errors->has('name'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('name') }}</strong></span>@endif
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label">Sort Number</label>
                                <input type="number" name="sort" id="sort" class="form-control {{ $errors->has('sort') ? ' is-invalid' : '' }} " value="{{old('sort')}}" placeholder="0, 1, 2" />
                                @if ($errors->has('sort'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('sort') }}</strong></span>@endif
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
                        <button type="submit" class="btn btn-primary" id="btn-save">save record</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end create new pillar form modal -->
@endif

@endsection
