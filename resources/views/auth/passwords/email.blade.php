@extends('layouts.auth')
@section('content')
<div class="caja-login">
    <h6>{{ __('Restablecimiento de contraseña') }}</h6>
    
    <form method="POST" action="{{ route('password.email') }}">
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

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn-effie-inv">
                    {{ __('Recibir enlace') }}
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
