@include('receptions/detailtable')
<div class="fila">
	<div class="space"></div>
	<div class="columna columna-1">
		<center>
		<button type="submit" class="btn-effie" onclick="if ($('#status').val() == 'SIN CONFIRMAR' || ($('#status').val() == 'CONFIRMADA' && confirm('Estás a punto de guardar la recepción con estado CONFIRMADA. Pasado este punto, no podrás modificarla. ¿Deseas continuar?'))) document.getElementById('frm-reception').submit();">
			<i class="fa fa-save"></i>&nbsp;{{ isset($reception) ? 'Guardar' : 'Registrar' }}
		</button>
		<a href="{{ route('receptions.index') }}" class="btn-effie-inv">
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
<style>
.tbl-details td:nth-child(3),td:nth-child(4),td:nth-child(5) {text-align:center}
.tbl-details td input{
	width:70px !important;
	margin:0 !important;
	padding:0 10px !important;
	border:1px solid #c0c0c0;
}
.tbl-details td input[type="text"]{
	width:100% !important;
}
</style>
<script src="{{ asset('js/receptions/details3.js') }}"></script>
@endsection