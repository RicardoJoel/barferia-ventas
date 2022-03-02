@extends('layouts.auth')
@section('content')
@if ($errors->has('password'))
<div class="span-alert">
    <span class="invalid-feedback" role="alert">
        {{ $errors->first('password') }}
    </span>
</div>
@endif
<div class="caja-login">
    <h6>{{ __('Activación de nueva cuenta') }}</h6>

    <form method="POST" action="{{ url('/complete/'.$id) }}">
        @csrf
        <input type="hidden" name="email" value="{{ $email }}">

        <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>
            <div class="col-md-6">
                <input type="password" name="password" id="new_password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" minlength="8" maxlength="20" required autofocus>
            </div>
        </div>

        <div class="form-group row">
            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar contraseña') }}</label>
            <div class="col-md-6">
                <input type="password" name="password_confirmation" id="new_confirm_password" class="form-control" minlength="8" maxlength="20" required>
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn-effie-inv">
                    {{ __('Activar mi cuenta') }}
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
