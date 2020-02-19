@extends('layouts.admin')

@section('title','Roles')

@section('content')

    <div class="ca card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-12">
                    <div class="float-left">
                        <h4 class="header-title">Roles</h4>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-primary" href="#newRecord" data-toggle="modal"><i class="fa fa-plus"></i> Add role</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            @include('alerts._flash')
            <div class="table-responsive">
                <table class="table table-striped  table-sm table-hover" id="table">
                    <thead class="text-uppercase text-center bg-blue">
                    <tr>
                        <th scope="col">Role Names</th>
                        <th scope="col">Guard Name</th>
                        <th scope="col">Permissions</th>
                        <th scope="col"><i class="icon_cogs"></i> Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td class="text-left">{{$role->name}}</td>
                            <td class="text-center">{{$role->guard_name}}</td>
                            <td class="text-center">
                                {!! str_replace(array('[', ']', '"'),' ', $role->permissions()->pluck('name')) !!}
                            </td>{{-- Retrieve array of permissions associated to a role and convert to string --}}
                            <td class="text-center p-0">
                                <div class="btn btn-group">

                                    <a class="btn btn-primary btn-sm mr-2" href="{{route('roles.edit',$role)}}" title="Edit"><i class="fa fa-edit"></i></a>
                                    <form class="form-delete" method="post" action="{{route('roles.destroy',$role)}}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete {{$role->name}} role?')" title="Delete"><i class="fa fa-trash-alt"></i></button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Form to add New Record -->
    <!-- start create new eventCategory form modal -->
    <div class="modal fade" id="newRecord" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{route('roles.store')}}" class="form-horizontal" role="form" id="newRecord" name="newRecord" autocomplete="off">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="name" class="col-form-labelt">Role Name <span class="star">*</span></label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="off" autofocus>
                                @error('name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="name" class="control-label">Guard Name <span class="star">*</span></label>
                                <select name="guard_name" class="form-control @error('guard_name') is-invalid @enderror">
                                    <option value="">Select guard.....</option>
                                    <option value="web" {{old('guard_name') == 'web' ? 'selected' : ''}}>web</option>
                                    <option value="admin" {{old('guard_name') == 'admin' ? 'selected' : ''}}>admin</option>
                                    <option value="employee" {{old('guard_name') == 'employee' ? 'selected' : ''}}>employee</option>
                                </select>
                                @error('guard_name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-12 control-label">Assign Permissions</label>
                            @foreach ($permissions as $permission)
                                <div class="col-md-4">
                                    <label class="label">
                                        {{ Form::checkbox('permissions[]',  $permission->id) }}{{$permission->name}}<span class="checkmark"></span>
                                    </label>
                                    @error('permissions')<span class="invalid-feedback" permission="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            @endforeach
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="desc" class="col-form-labelt">Short Descriptions</label>
                                <textarea id="desc" class="form-control @error('desc') is-invalid @enderror" name="desc" >{{ old('desc') }}</textarea>
                                @error('desc')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
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
    <!-- end create new eventCategory form modal -->



@endsection
