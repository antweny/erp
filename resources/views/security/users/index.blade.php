@extends('layouts.templates.security')
@section('title','List of Users')
@section('content')

    <div class="ca card">
        <div class="card-header">
            <div class="float-left">
                <h4 class="header-title">Users</h4>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="#newRecord" title="New Record" data-toggle="modal"><i class="fa fa-plus"></i> New User</a>
            </div>
        </div>
        <div class="card-body">
            @include('alerts._flash')
            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm" id="table">
                    <thead class="text-uppercase text-center">
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
                    @foreach ($users as $user)
                        <tr>
                            <td class="text-center">no</td>
                            <td class="text-center">{{$user->name}}</td>
                            <td class="text-center">{{$user->registered}}</td>
                            <td class="text-center">{{$user->email}}</td>
                            <td class="text-center">{{ $user->roles()->pluck('name')->implode(' | ') }}</td>{{-- Retrieve array of roles associated to a user and convert to string --}}
                            <td class="text-center p-0">
                                <div class="btn btn-group">
                                    <a class="btn btn-primary btn-sm mr-2" href="{{route('users.edit',$user)}}" title="edit"><i class="fas fa-edit"></i></a>
                                    <form class="form-delete" method="post" action="{{route('users.destroy',$user)}}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete {{$user->name}} user?')" title="Delete"><i class="fa fa-trash-alt"></i></button>
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

    <!-- start create new eventCategory form modal -->
    <div class="modal fade" id="newRecord" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{route('users.store')}}" class="form-horizontal" role="form" id="newRecord" name="newRecord" autocomplete="off">
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
                            @include('partials.roles.dropdown')
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" id="btn-save">save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end create new eventCategory form modal -->
  

@endsection
