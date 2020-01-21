@extends('layouts.login')
@section('title','Please Login!')
@section('body')

    <div class="row justify-content-center login-form">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">User Login</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
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

                        <div class="form-group row justify-content-center">
                            <div class="col-md-5">
                                <button type="submit" class="btn btn-block btn-primary ">{{ __('Login') }}</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
