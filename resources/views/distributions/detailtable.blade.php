<div class="fila">
	<div class="columna columna-1">
		<table id="tbl-details" class="tablealumno tbl-details col_numbers">
			<thead>
				<th width="14.60%">Producto</th>
				<th width="12.20%">Stock inicial origen</th>
				<th width="12.20%">Stock inicial destino</th>
				<th width="12.20%">Enviados</th>
				<th width="12.20%">Recibidos</th>
				<th width="12.20%">Devueltos</th>
				<th width="12.20%">Stock final origen</th>
				<th width="12.20%">Stock final destino</th>
				<th></th>
			</thead>
			<tbody>
				@foreach ($details as $detail)
				<tr>
					<td>{{ $detail['product'] }}</td>
					<td>{{ $detail['openstock'] }}</td>
					<td>{{ $detail['opendestiny'] }}</td>
					<td>{{ $detail['quantity'] }}</td>
					<td>{{ $detail['received'] }}</td>
					<td>{{ $detail['returned'] }}</td>
					<td>{{ $detail['finalstock'] }}</td>
					<td>{{ $detail['finaldestiny'] }}</td>
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
				<td></td>
				<td></td>
				<td></td>
			</tfoot>
		</table>
	</div>
</div>