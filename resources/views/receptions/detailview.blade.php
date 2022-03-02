<div class="fila">
	<div class="columna columna-1">
		<table id="tbl-details" class="tablealumno tbl-details col_numbers">
			<thead>
				<th width="20%">Producto</th>
				<th width="10%">Enviados (uds.)</th>
				<th width="10%">¿Conforme?</th>
				<th width="10%">Recibidos (uds.)</th>
				<th width="10%">Devueltos (uds.)</th>
				<th width="40%">Observación</th>
			</thead>
			<tbody>
				@foreach ($details as $detail)
				<tr>
					<td>{{ $detail['product'] }}</td>
					<td>{{ $detail['quantity'] }}</td>
					<td>@if ($detail['checked'])<i class="fa fa-check"></i>@endif</td>
					<td>{{ $detail['received'] }}</td>
					<td>{{ $detail['returned'] }}</td>
					<td>{{ $detail['observation'] }}</td>
				</tr>
				@endforeach
			</tbody>
			<tfoot>
				<td>Total</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tfoot>
		</table>
	</div>
</div>