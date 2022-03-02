@include('inventories/detailform')
@include('inventories/detailtable')
<div class="fila">
	<div class="space"></div>
	<div class="columna columna-1">
		<center>
		<button type="submit" class="btn-effie" onclick="if ($('#status').val() == 'SIN CONFIRMAR' || ($('#status').val() == 'CONFIRMADA' && confirm('Estás a punto de guardar el inventario con estado CONFIRMADA. Pasado este punto, no podrás modificarlo. ¿Deseas continuar?'))) document.getElementById('frm-inventory').submit();">
			<i class="fa fa-save"></i>&nbsp;{{ isset($inventory) ? 'Guardar' : 'Registrar' }}
		</button>
		<a href="{{ route('inventories.index') }}" class="btn-effie-inv">
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
<style>.tbl-details td:nth-child(4),td:nth-child(7) {background-color:#F0900620}</style>
<script src="{{ asset('js/inventories/details6.js') }}"></script>
@endsection