@extends('layouts.admin')

@section('title','List of Admins')

@section('content')

    <div class="ca card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-12">
                    <div class="float-left">
                        <h4 class="header-title">Administrators</h4>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-primary" href="#newRecord" title="New Record" data-toggle="modal"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            @include('alerts._flash')
            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm" id="table">
                    <thead class="text-uppercase text-center bg-blue">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Date</th>
                        <th scope="col">Email</th>
                        <th scope="col">Roles</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($admins as $admin)
                        <tr>
                            <td class="text-center">no</td>
                            <td class="text-center">{{$admin->name}}</td>
                            <td class="text-center">{{$admin->registered}}</td>
                            <td class="text-center">{{$admin->email}}</td>
                            <td class="text-center">{{ $admin->roles()->pluck('name')->implode(' | ') }}</td>{{-- Retrieve array of roles associated to a user and convert to string --}}
                            <td class="text-center">
                                <div class="btn-group">
                                    <a class="btn btn-primary btn-sm mr-3" href="{{route('admin.edit',$admin)}}" title="edit"><i class="fas fa-edit"></i></a>
                                    <form class="form-delete" method="post" action="{{route('admin.destroy',$admin)}}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btm-sm" onclick="return confirm('Delete {{$admin->name}} administrator?')" title="Delete"><i class="fa fa-trash-alt"></i></button>
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
                    <h5 class="modal-title">New Admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{route('admin.store')}}" class="form-horizontal" role="form" id="newRecord" name="newRecord" autocomplete="off">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="name" class="col-form-label">Full Name <span class="star">*</span></label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="off" autofocus>
                                @error('name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="email" class="col-form-label">E-Mail Address <span class="star">*</span></label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off" autofocus>
                                @error('email')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="password" class="col-form-label">Password <span class="star">*</span></label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="password" class="col-form-label">Confirm Password <span class="star">*</span></label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                @error('password')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-12 col-form-label">Assign roles</label>
                            @foreach ($roles as $role)
                                <div class="col-md-4">
                                    <label class="label">
                                        {{ Form::checkbox('roles[]',  $role->name ) }}{{$role->name}}<span class="checkmark"></span>
                                    </label>
                                    @error('roles')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            @endforeach
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

@section('scripts')

<script>

</script>

@endsection
