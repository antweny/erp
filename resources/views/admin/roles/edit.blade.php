@extends('layouts.admin')
@section('title', 'Update Role')
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row hd mb-3">
                        <div class="col-md-12">
                            <div class="float-left">
                                <h4 class="header-title">Update role</h4>
                            </div>
                            <div class="float-right">
                                <a class="btn btn-primary " href="{{route('roles.index')}}"><i class="fa fa-list"></i> view roles</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts._flash')
                    {{ Form::model($role, array('route' => array('roles.update', $role->id), 'method' => 'PUT')) }}
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label class="col-form-label" for="role_name">Role Name <span class="star">*</span></label>
                            <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror" value="{{$role->name}}" required/>
                            @error('name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="name" class="col-form-label">Guard Name <span class="star">*</span></label>
                            <select name="guard_name" class="form-control @error('guard_name') is-invalid @enderror">
                                <option value="web" {{old('guard_name',$role->guard_name) == 'web' ? 'selected' : ''}}>web</option>
                                <option value="admin" {{old('guard_name',$role->guard_name) == 'admin' ? 'selected' : ''}}>admin</option>
                            </select>
                            @error('guard_name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-form-label mb-1">Assign Permissions <span class="star">*</span></label>
                        @foreach ($permissions as $permission)
                            <div class="col-sm-2">
                                <label class="label">
                                    {{ Form::checkbox('permissions[]', $permission->id )}} {{$permission->name}}
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        @endforeach
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="desc" class="col-form-label">Short Descriptions</label>
                            <textarea id="desc" class="form-control @error('desc') is-invalid @enderror" name="desc" >{{ $role->desc }}</textarea>
                            @error('desc')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                        </div>
                    </div>

                    <div class="form-group row justify-content-center">
                        <div class="col-md-6 float-left">
                            <a class="btn btn-outline-secondary" href="{{route('roles.index')}}">Cancel</a>
                        </div>
                        <div class="col-md-6">
                            <div class="float-right">
                                <input type="submit" class="btn btn-primary" value="update"/>
                            </div>
                        </div>
                    </div>
                    {{Form::close()}}

                </div>
            </div>
        </div>
    </div>

@endsection
