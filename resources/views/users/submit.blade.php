<div class="fila">
	<div class="space"></div>
	<div class="columna columna-1">
		<center>
		<button type="submit" class="btn-effie" onclick="document.getElementById('frm-user').submit();">
			<i class="fa fa-save"></i>&nbsp;{{ isset($user) ? 'Guardar' : 'Registrar' }}
		</button>
		<a href="{{ route('users.index') }}" class="btn-effie-inv">
			<i class="fa fa-reply"></i>&nbsp;Regresar
		</a>
		</center>
	</div>
</div>
<div class="fila">
	<div class="space"></div>
	<div class="columna columna-1">
		<p><i class="fa fa-info-circle fa-icon" aria-hidden="true"></i>&nbsp;<b>Importante</b>
		<ul>
			<li>(*) Campos obligatorios</li>
			<li>El correo electrónico institucional es único y tiene un tamaño máximo de cincuenta (50) caracteres.</li>
			<li>El tamaño máximo del nombre y apellidos del usuario es cincuenta (50) caracteres.</li>
			<li>El tamaño máximo de la dirección de domicilio del usuario es cien (100) caracteres.</li>
			<li>El tamaño máximo del nombre completo y parentesco del contacto en caso de emergencia es cincuenta (50) caracteres.</li>
			<li>El tamaño máximo de la dirección del contacto en caso de emergencia es cien (100) caracteres.</li>
			<li>El tamaño máximo del nombre y apellidos de los dependientes es cincuenta (50) caracteres.</li>
		</ul></p>
	</div>
</div>
@section('script')
<script src="{{ asset('js/users/dependents2.js') }}"></script>
<script src="{{ asset('js/users/variations2.js') }}"></script>
<script src="{{ asset('js/users/form8.js') }}"></script>
@endsection