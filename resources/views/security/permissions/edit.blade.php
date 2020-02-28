@extends('layouts.templates.security')
@section('title', 'Update permission')
@section('content')
    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h4 class="header-title">Update permission</h4>
                    </div>
                    <div class="float-right">
                        @can('permission-read')
                            <a class="btn btn-warning text-white " href="{{route('permissions.index')}}"><i class="fa fa-list"></i> view permissions</a>
                        @endcan
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
                        @include('partials.roles.dropdown')
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
                            <a class="btn btn-dark" href="{{route('permissions.index')}}">Cancel</a>
                        </div>
                        <div class="col-md-6">
                            <div class="float-right">
                                <input type="submit" class="btn btn-success" value="update"/>
                            </div>
                        </div>
                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

@endsection
