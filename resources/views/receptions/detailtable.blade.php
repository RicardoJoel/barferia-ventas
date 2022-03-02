<div class="fila">
	<div class="columna columna-1">
		<div class="span-fail" id="det_fail_div"><span id="det_fail_msg"></span></div>
	</div>
</div>
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
				@foreach ($details as $index => $detail)
				<tr>
					<td>{{ $detail['product'] }}</td>
					<td id="{{ 'qty'.$index }}">{{ $detail['quantity'] }}</td>
					<td><input type="checkbox" name="{{ 'chk'.$index }}" id="{{ 'chk'.$index }}" {{ old('chk'.$index,$detail['checked']) ? 'checked="checked"' : '' }}></td>
					<td><input type="number" value="{{ $detail['received'] }}" id="{{ 'rec'.$index }}" min="0" onkeypress="return checkNumber(event)" {{ old('chk'.$index,$detail['checked']) ? 'disabled' : '' }}></td>
					<td><input type="number" value="{{ $detail['returned'] }}" id="{{ 'ret'.$index }}" min="0" onkeypress="return checkNumber(event)" {{ old('chk'.$index,$detail['checked']) ? 'disabled' : '' }}></td>
					<td><input type="text" value="{{ $detail['observation'] }}" id="{{ 'obs'.$index }}" maxlength="100" {{ old('chk'.$index,$detail['checked']) ? 'disabled' : '' }}></td>
				</tr>
				@endforeach
			</tbody>
			<tfoot>
				<td>Total</td>
				<td></td>
				<td><input type="checkbox" checked="checked" id="chkfoot"></td>
				<td></td>
				<td></td>
				<td></td>
			</tfoot>
		</table>
	</div>
</div>