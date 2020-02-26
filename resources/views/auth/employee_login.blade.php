@extends('layouts.app')
@section('title','Please Login!')
@section('content')

    <div class="row justify-content-center login-form">
        <div class="col-md-3">
            <div class="card">
                <div class="text-center card-header">
                    <img src="{{asset('img/employee.png')}}">
                    <span class="h3">Employee Portal Login</span>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('employee.login.submit') }}">
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="email" class="col-form-labelt">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off" autofocus>
                                @error('email')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="password" class="col-form-label">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 float-left">
                                <a href="{{url('/')}}" class="btn btn-outline-secondary">Home</a>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="float-right btn btn-primary btn-lg">{{ __('Login') }}</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
