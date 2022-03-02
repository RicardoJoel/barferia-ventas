@extends('layouts.auth')
@section('content')
<div class="caja-login">
    <h6>{{ __('Confirmación de contraseña') }}</h6>

    {{ __('Por favor, confirma tu contraseña antes de continuar') }}
    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf
        <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>
            <div class="col-md-6">
                <input type="password" name="password" id="current_password" class="form-control @error('password') is-invalid @enderror" minlength="8" maxlength="20" required autocomplete="current-password">
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
                    {{ __('Confirmar contraseña') }}
                </button>
                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('¿Olvidaste tu contraseña?') }}
                    </a>
                @endif
            </div>
        </div>
    </form>
</div>
@endsection
