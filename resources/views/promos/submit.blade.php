<div class="fila">
	<div class="columna columna-1">
		<center>
		<button type="submit" class="btn-effie" onclick="document.getElementById('frm-promo').submit()">
			<i class="fa fa-save"></i>&nbsp;{{ isset($promo) ? 'Guardar' : 'Registrar' }}
		</button>
		<a href="{{ route('promos.index') }}" class="btn-effie-inv">
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
			<li>Precios expresados en soles (PEN)</li>
		</ul></p>
	</div>
</div>
@section('script')
<script src="{{ asset('js/promos/details.js') }}"></script>
@endsection