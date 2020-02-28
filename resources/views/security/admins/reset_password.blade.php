@extends('layouts.templates.security')
@section('title','Reset Admin Password')
@section('content')

    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h4 class="header-title">Reset Admin Password</h4>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-warning text-white" href="{{route('admin.index')}}" ><i class="fa fa-list"></i> view admin list</a>
                    </div>
                </div>

                <div class="card-body">
                    @include('alerts._flash')
                    {{ Form::model($admin, array('route' => array('admin.resetPassword',$admin), 'method' => 'PUT')) }}
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="name" class="col-form-label">Fullname</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$admin->name}}" required readonly>
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

                    <div class="form-group row justify-content-center">
                        <div class="col-md-12">
                            <div class="float-left">
                                <a href="{{route('admin.index')}}" class="btn btn-dark ">cancel</a>
                            </div>
                            <div class="float-right">
                                <button type="submit" class="btn btn-success">reset password</button>
                            </div>
                        </div>
                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

@endsection
