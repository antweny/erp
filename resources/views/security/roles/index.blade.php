@extends('layouts.templates.security')
@section('title','User Roles List')
@section('content')

    <div class="ca card">
        <div class="card-header">
            <div class="float-left">
                <h5>User Roles List</h5>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="#newRecord" data-toggle="modal"><i class="fa fa-plus"></i> Add role</a>
            </div>
        </div>

        <div class="card-body">
            @include('alerts._flash')
            <div class="table-responsive">
                <table class="table table-striped  table-sm table-hover" id="table">
                    <thead class="text-uppercase text-center">
                        <tr>
                            <th scope="col">Role Names</th>
                            <th scope="col">Guard Name</th>
                            <th scope="col">Permissions</th>
                            <th scope="col"><i class="icon_cogs"></i> Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @include('partials.roles.list')
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
                            @include('partials.permissions.dropdown')
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
                        <button type="submit" class="btn btn-success" id="btn-save">save record</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end create new eventCategory form modal -->



@endsection
