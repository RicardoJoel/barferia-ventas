@include('productions/detailform')
@include('productions/detailtable')
<div class="fila">
	<div class="space"></div>
	<div class="columna columna-1">
		<center>
		<button type="submit" class="btn-effie" onclick="if ($('#status').val() == 'SIN CONFIRMAR' || ($('#status').val() == 'CONFIRMADA' && confirm('Estás a punto de guardar la producción con estado CONFIRMADA. Pasado este punto, no podrás modificarla. ¿Deseas continuar?'))) document.getElementById('frm-production').submit();">
			<i class="fa fa-save"></i>&nbsp;{{ isset($production) ? 'Guardar' : 'Registrar' }}
		</button>
		<a href="{{ route('productions.index') }}" class="btn-effie-inv">
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
			<li>Cantidades expresadas en unidades de paquete (uds.)</li>
		</ul></p>
	</div>
</div>
@section('script')
<style>.tbl-details td:nth-child(2) {text-align:center}</style>
<script src="{{ asset('js/productions/details5.js') }}"></script>
@endsection