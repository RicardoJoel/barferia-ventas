@extends('layouts.auth')
@section('content')
<div class="caja-login">
    <h6>{{ __('Inicia sesión con tu correo institucional') }}</h6>
    
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo electrónico') }}</label>
            <div class="col-md-6">
                <input type="email" name="email" id="login_email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" minlength="8" maxlength="50" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>
            <div class="col-md-6">
                <input type="password" name="password" id="login_password" class="form-control @error('password') is-invalid @enderror" minlength="8" maxlength="50" required autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn-effie-inv">
                    {{ __('Iniciar sesión') }}
                </button>
            </div>
        </div>
    </form>
</div>
@if (Route::has('password.request'))
<div class="form-group row mb-0">
    <div class="col-md-8 offset-md-4">
        <p><a class="btn btn-link" href="{{ route('password.request') }}">
            {{ __('Olvidé mi contraseña') }}
        </a></p>
    </div>
</div>
@endif
@endsection
