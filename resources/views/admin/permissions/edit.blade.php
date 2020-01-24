@extends('layouts.admin')
@section('title', 'Update permission')
@section('content')
    
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <div class="row hd mb-3">
                        <div class="col-md-12">
                            <div class="float-left">
                                <h4 class="header-title">Update permission</h4>
                            </div>
                            <div class="float-right">
                                @can('permission-read')
                                    <a class="btn btn-flat btn-info text-white " href="{{route('permissions.index')}}"><i class="fa fa-list"></i> view permissions</a>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts._flash')

                    {{ Form::model($permission, array('route' => array('permissions.update',$permission), 'method' => 'PUT')) }}
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label class="col-form-label" for="role_name">Permission Name <span class="star">*</span></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$permission->name}}" required/>
                            @error('name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="name" class="col-form-label">Guard Name <span class="star">*</span></label>
                            <select name="guard_name" class="form-control @error('guard_name') is-invalid @enderror">
                                <option value="web" {{old('guard_name',$permission->guard_name) == 'web' ? 'selected' : ''}}>web</option>
                                <option value="admin" {{old('guard_name',$permission->guard_name) == 'admin' ? 'selected' : ''}}>admin</option>
                            </select>
                            @error('guard_name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-12 col-form-label mb-1">Assign roles</label>
                        @foreach ($roles as $role)
                            <div class="col-md-4">
                                <label class="label">
                                    {{ Form::checkbox('roles[]',$role->id ) }}{{$role->name}}
                                      <span class="checkmark"></span>
                                </label>
                                @error('roles')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        @endforeach
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="desc" class="col-form-label">Short Descriptions</label>
                            <textarea id="desc" class="form-control @error('desc') is-invalid @enderror" name="desc" >{{ $permission->desc }}</textarea>
                            @error('desc')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                        </div>
                    </div>

                    <div class="form-group row justify-content-center">
                        <div class="col-md-6 float-left">
                            <a class="btn btn-outline-secondary" href="{{route('permissions.index')}}">Cancel</a>
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
