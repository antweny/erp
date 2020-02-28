@extends('layouts.login')
@section('title','Please Login!')
@section('sub-header','Employee Login Page')
@section('content')

    <form method="POST" action="{{ route('employee.login.submit') }}">
        @csrf
        <div class="form-group">
            <label for="email" class="form-control-label">{{ __('E-Mail Address:') }}</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
            @error('email')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
        <div class="form-group">
            <label for="password" class="form-control-label">{{ __('Password:') }}</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            @error('password')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
        <button class="btn btn-success btn-block">Login</button>
    </form>

@endsection
