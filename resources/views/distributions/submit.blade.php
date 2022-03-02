@include('distributions/detailform')
@include('distributions/detailtable')
<div class="fila">
	<div class="space"></div>
	<div class="columna columna-1">
		<center>
		<button type="submit" class="btn-effie" onclick="if ($('#status').val() == 'SIN CONFIRMAR' || ($('#status').val() == 'CONFIRMADA' && confirm('Estás a punto de guardar la distribución con estado CONFIRMADA. Pasado este punto, no podrás modificarla. ¿Deseas continuar?'))) document.getElementById('frm-distribution').submit();">
			<i class="fa fa-save"></i>&nbsp;{{ isset($distribution) ? 'Guardar' : 'Registrar' }}
		</button>
		<a href="{{ route('distributions.index') }}" class="btn-effie-inv">
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
<style>.tbl-details td:nth-child(4),td:nth-child(6),td:nth-child(8) {background-color:#F0900620}</style>
<script src="{{ asset('js/distributions/details6.js') }}"></script>
@endsection