@extends('layouts.app')
@section('content')
<div class="fila">
	<div class="columna columna-1">
		<div class="title2">
			<h6>Mi cuenta > Seguridad ></h6>
		</div>
	</div>
</div>
<form method="POST" action="{{ route('changePassword') }}" role="form">
	@csrf
	<input type="hidden" name="email" value="{{ Auth::user()->email }}">
	<div class="fila">
        <div class="columna columna-1">
			<div class="form-section">
				<a onclick="showForm('gen')">
					<h6 id="gen_subt" class="title3">Cambio de contraseña</h6>
					<p id="icn-gen" class="icn-sct"><i class="fa fa-minus fa-icon"></i></p>
				</a>
				<div id="div-gen">
					<div class="fila">
						<div class="columna columna-8"><br></div>
						<div class="columna columna-4">
							<p>Contraseña actual*</p>
							<input type="password" name="current_password" id="current_password" maxlength="20" required>
						</div>
						<div class="columna columna-4">
							<p>Nueva contraseña*</p>
							<input type="password" name="new_password" id="new_password" maxlength="20" required>
						</div>
						<div class="columna columna-4">
							<p>Confirmar contraseña*</p>
							<input type="password" name="new_confirm_password" id="new_confirm_password" maxlength="20" required>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="fila">
		<div class="columna columna-1">
			<center>
			<button type="submit" class="btn-effie"><i class="fa fa-save"></i>&nbsp;Guardar</button>
			<a href="{{ route('home') }}" class="btn-effie-inv"><i class="fa fa-home"></i>&nbsp;Ir al inicio</a>
			</center>
		</div>
	</div>
</form>
<div class="fila">
	<div class="space"></div>
	<div class="columna columna-1">
		<p><i class="fa fa-info-circle fa-icon" aria-hidden="true"></i>&nbsp;<b>Importante</b>
		<ul>
			<li>(*) Campos obligatorios</li>
			<li>La nueva contraseña debe ser diferente a su correo electrónico.</li>
			<li>La nueva contraseña debe estar compuesta por entre ocho (8) y veinte (20) caracteres con, al menos, una letra y un dígito.</li>
		</ul></p>
	</div>
</div>
@endsection