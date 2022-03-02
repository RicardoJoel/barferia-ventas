<div class="fila">
	<div class="space"></div>
	<div class="columna columna-1">
		<center>
		<button type="submit" class="btn-effie" onclick="document.getElementById('frm-supplier').submit();">
			<i class="fa fa-save"></i>&nbsp;{{ isset($supplier) ? 'Guardar' : 'Registrar' }}
		</button>
		<a href="{{ route('suppliers.index') }}" class="btn-effie-inv">
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
			<li>El tamaño máximo del nombre o razón social y la dirección de facturación es cien (100) caracteres.</li>
			<li>El tamaño máximo del correo electrónico es cincuenta (50) caracteres.</li>
		</ul></p>
	</div>
</div>
@section('script')
<script src="{{ asset('js/suppliers/form3.js') }}"></script>
@endsection