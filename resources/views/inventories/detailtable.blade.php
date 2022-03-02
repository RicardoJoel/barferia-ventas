<div class="fila">
	<div class="columna columna-1">
		<table id="tbl-details" class="tablealumno tbl-details col_numbers">
			<thead>
				<th width="14.28%">Producto</th>	
				<th width="14.28%">Stock inicial (uds.)</th>
				<th width="14.28%">Entrada (uds.)</th>
				<th width="14.28%">Salida (uds.)</th>
				<th width="14.28%">Devolución (uds.)</th>
				<th width="14.28%">Descarte (uds.)</th>
				<th width="14.28%">Stock final (uds.)</th>
			</thead>
			<tbody>
				@foreach ($details as $det)
				<tr>
					<td>{{ $det['product'] }}</td>
					<td>{{ $det['openstock'] }}</td>
					<td>{{ $det['entry'] }}</td>
					<td>{{ $det['exit'] }}</td>
					<td>{{ $det['returned'] }}</td>
					<td>{{ $det['removed'] }}</td>
					<td>{{ $det['finalstock'] }}</td>
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
				<td></td>
			</tfoot>
		</table>
	</div>
</div>