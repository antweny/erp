@extends('layouts.admin')

@section('title','Permissions')

@section('content')

    <div class="ca card ">
        <div class="card-header">
            <div class="row">
                <div class="col-md-12">
                    <div class="float-left">
                        <h4 class="header-title">Permissions</h4>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-primary " href="#newRecord" data-toggle="modal"><i class="fa fa-plus"></i> Add permission </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- end card header -->

        <div class="card-body">
            @include('alerts._flash')
            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm" id="table">
                    <thead class="text-uppercase text-center bg-blue">
                    <tr>
                        <th scope="col">Permissions</th>
                        <th scope="col">Guard Name</th>
                        <th scope="col">Roles</th>
                        <th scope="col">Descriptions</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $permission)
                            <tr>
                                <td>{{$permission->name}}</td>
                                <td  class="text-center">{{$permission->guard_name}}</td>
                                <td  class="text-center">{{$permission->roles()->pluck('name')->implode(' | ') }}</td>
                                <td  class="text-center">{{$permission->desc}}</td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a class="btn btn-primary btn-sm mr-3" href="{{route('permissions.edit',$permission)}}" title="Edit"><i class="fa fa-edit"></i> </a>
                                        <form class="form-delete" method="post" action="{{route('permissions.destroy',$permission)}}">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete {{$permission->name}} permission?')"><i class="fa fa-trash-alt"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- end table -->
            </div>
        </div>
        <!-- end card body -->
    </div>


    <!-- start create new permission form modal -->
    <div class="modal fade" id="newRecord" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Permsission</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{route('permissions.store')}}" class="form-horizontal" role="form" autocomplete="off">
                    @csrf

                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="name" class="col-form-label">Permission Name <span class="star">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name')}}" required placeholder="name">
                                @error('name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="name" class="col-form-label">Guard Name <span class="star">*</span></label>
                                <select name="guard_name" class="form-control @error('guard_name') is-invalid @enderror">
                                    <option value="web" {{old('guard_name') == 'web' ? 'selected' : ''}}>web</option>
                                    <option value="admin" {{old('guard_name') == 'admin' ? 'selected' : ''}}>admin</option>
                                </select>
                                @error('guard_name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-12 col-form-label mb-1">Assign roles</label>
                            @foreach ($roles as $role)
                                <div class="col-md-4">
                                    <label class="label">
                                        {{ Form::checkbox('roles[]',  $role->id ) }}{{$role->name}}<span class="checkmark"></span>
                                    </label>
                                    @error('roles')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            @endforeach
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="desc" class="col-form-label">Short Descriptions</label>
                                <textarea id="desc" class="form-control @error('desc') is-invalid @enderror" name="desc" >{{ old('desc') }}</textarea>
                                @error('desc')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="btn-save">Save Record</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end create new permission form modal -->

@endsection
