<div class="fila">
	<div class="columna columna-1">
		<table id="tbl-details" class="tablealumno tbl-details col_numbers">
			<thead>
				<th width="16.66%">Producto</th>
				<th width="16.66%">Lote</th>
				<th width="16.66%">Stock inicial (uds.)</th>
				<th width="16.66%">Producción (uds.)</th>
				<th width="16.66%">Merma (uds.)</th>
				<th width="16.66%">Stock final (uds.)</th>
			</thead>
			<tbody>
				@foreach ($details as $detail)
				<tr>
					<td>{{ $detail['product'] }}</td>
					<td>{{ $detail['batch'] }}</td>
					<td>{{ $detail['openstock'] }}</td>
					<td>{{ $detail['quantity'] }}</td>
					<td>{{ $detail['removed'] }}</td>
					<td>{{ $detail['finalstock'] }}</td>
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