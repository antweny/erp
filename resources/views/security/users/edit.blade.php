@extends('layouts.templates.security')
@section('title','Update user')
@section('content')

    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h4 class="header-title">Update user</h4>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-warning text-white" href="{{route('users.index')}}" ><i class="fa fa-list"></i> view list</a>
                    </div>
                </div>

                <div class="card-body">
                    @include('alerts._flash')
                    {{ Form::model($user, array('route' => array('users.update',$user), 'method' => 'PUT')) }}
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="name" class="col-form-label">Full name <span class="star">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$user->name}}" required placeholder="Fullname">
                                @error('name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="email" class=" col-form-label">Email <span class="star">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user->email}}" readonly >
                                @error('email')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            @include('partials.roles.dropdown')
                        </div>

                        <div class="form-group row justify-content-center">
                            <div class="col-md-12">
                                <div class="float-left">
                                   <a href="{{route('users.index')}}" class="btn btn-dark">cancel</a>
                                </div>
                                <div class="float-right">
                                    <button type="submit" class="btn btn-success">update user</button>
                                </div>
                            </div>
                        </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

@endsection
