@extends('layouts.auth')
@section('content')
@error('password')
<div class="span-alert">
    <span class="invalid-feedback" role="alert">
        {{ $message }}
    </span>
</div>
@enderror
@error('email')
<div class="span-alert">
    <span class="invalid-feedback" role="alert">
        {{ $message }}
    </span>
</div>
@enderror
<div class="caja-login">
    <h6>{{ __('Restablecimiento de contraseña') }}</h6>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo electrónico') }}</label>
            <div class="col-md-6">
                <input type="email" name="email" id="login_email" class="form-control @error('email') is-invalid @enderror" value="{{ $email ?? old('email') }}" minlength="8" maxlength="20" required autocomplete="email" autofocus>
            </div>
        </div>

        <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Nueva contraseña') }}</label>
            <div class="col-md-6">
                <input type="password" name="password" id="new_password" class="form-control @error('password') is-invalid @enderror" minlength="8" maxlength="20" required autocomplete="new-password">
            </div>
        </div>

        <div class="form-group row">
            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar contraseña') }}</label>
            <div class="col-md-6">
                <input type="password" name="password_confirmation" id="new_confirm_password" class="form-control" minlength="8" maxlength="20" required autocomplete="new-password">
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn-effie-inv">
                    {{ __('Restablecer contraseña') }}
                </button>
            </div>
        </div>
    </form>
</div>
<div class="form-group row mb-0">
    <div class="col-md-8 offset-md-4">
        <p><a class="btn btn-link" href="{{ route('login') }}">
            {{ __('Ir a Inicio de sesión') }}
        </a></p>
    </div>
</div>
@endsection
