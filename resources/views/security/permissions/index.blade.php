@extends('layouts.templates.security')
@section('title','Role Permissions List')
@section('content')

    <div class="ca card ">
        <div class="card-header">
            <div class="float-left">
                <h4 class="header-title">Role Permissions List</h4>
            </div>
            <div class="float-right">
                <a class="btn btn-success " href="#newRecord" data-toggle="modal"><i class="fa fa-plus"></i> New Permission </a>
            </div>
        </div>
        <!-- end card header -->

        <div class="card-body">
            @include('alerts._flash')
            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm" id="table">
                    <thead class="text-uppercase text-center">
                        <tr>
                            <th scope="col">Permissions</th>
                            <th scope="col">Guard Name</th>
                            <th scope="col">Descriptions</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @include('partials.permissions.list')
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
                                    <option value="employee" {{old('guard_name') == 'employee' ? 'selected' : ''}}>employee</option>
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
                                <textarea id="desc" class="form-control @error('desc') is-invalid @enderror" name="desc" >{{ old('desc') }}</textarea>
                                @error('desc')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" id="btn-save">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end create new permission form modal -->

@endsection
