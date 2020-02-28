@extends('layouts.templates.security')
@section('title','Reset Employee Password')
@section('content')

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h4 class="header-title">Reset Employee Password</h4>
                    </div>
                </div>

                <div class="card-body">
                    @include('alerts._flash')
                    {{ Form::model($employee, array('route' => array('employee.resetPassword',$employee), 'method' => 'PUT')) }}
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="name" class="col-form-label">Fullname</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$employee->full_name}}" required readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="name" class="col-form-label">Email</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$employee->email}}" required readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="password" class="col-form-label">Password <span class="star">*</span></label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="col-form-label">Confirm Password <span class="star">*</span></label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            @error('password')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <div class="col-md-12">
                            <div class="float-left">
                                <a href="{{route('employeeLogin')}}" class="btn btn-dark ">cancel</a>
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
