@extends('layouts.admin')
@section('title','Update user')
@section('content')

    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="float-left">
                                <h4 class="header-title">Update user</h4>
                            </div>
                            <div class="float-right">
                                <a class="btn btn-primary" href="{{route('users.index')}}" ><i class="fa fa-list"></i> view list</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @include('alerts._flash')
                    {{ Form::model($user, array('route' => array('users.update',$user), 'method' => 'PUT')) }}
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 control-label">Fullname</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$user->name}}" required placeholder="Fullname">
                                @error('name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 control-label">Email</label>
                            <div class="col-md-8">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user->email}}" readonly >
                                @error('email')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-12 control-label">Assign roles</label>
                            @foreach ($roles as $role)
                                <div class="col-md-4">
                                    <label class="label">
                                        {{ Form::checkbox('roles[]',  $role->id ) }}{{$role->name}}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <div class="form-group row justify-content-center">
                            <div class="col-md-12">
                                <div class="float-left">
                                   <a href="{{route('users.index')}}" class="btn btn-secondary ">cancel</a>
                                </div>
                                <div class="float-right">
                                    <button type="submit" class="btn btn-primary">update user</button>
                                </div>
                            </div>
                        </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

@endsection
