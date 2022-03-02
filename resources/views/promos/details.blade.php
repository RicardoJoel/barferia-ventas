<div class="fila">
	<div class="columna columna-1">
		<div class="form-section">
			<a onclick="showForm('det')">
				<h6 id="det_subt" class="title3">Detalle</h6>
				<p id="icn-det" class="icn-sct"><i class="fa fa-minus fa-icon"></i></p>
			</a>
			<div id="div-det">
				<form method="POST" action="{{ action('PromoDetailController@store') }}" role="form" id="det_form">
					@csrf
					<input type="hidden" name="det_id" id="det_id" value="{{ old('det_id') }}">
					<div class="fila">
						<div class="columna columna-1">
							<div class="span-fail" id="det_fail_div"><p id="det_fail_msg"></p></div>
						</div>
					</div>
					<div class="fila">
						<div class="columna columna-3">
							<p>Producto*</p>
							@inject('products','App\Services\Products')
							<select name="det_product_id" id="det_product_id">
								<option selected value="">Cualquier producto</option>
								@foreach ($products->get() as $index => $product)
								<option value="{{ $index }}" {{ old('det_product_id') == $index ? 'selected' : '' }}>{{ $product }}</option>
								@endforeach
							</select>
						</div>
						<div class="columna columna-6">
							<p>Precio normal</p>
							<input type="text" name="det_price" id="det_price" value="{{ old('det_price') }}" disabled>
						</div>
						<div class="columna columna-6">
							<p>Cantidad*</p>
							<input type="number" name="det_quantity" id="det_quantity" value="{{ old('det_quantity',1) }}" min="1" onkeypress="return checkNumber(event)" required>
						</div>
						<div class="columna columna-6">
							<p>Subtotal normal</p>
							<input type="text" name="det_subtotal" id="det_subtotal" value="{{ old('det_subtotal') }}" disabled>					
						</div>
						<div class="columna columna-6">
							<p>&nbsp;</p>
							<button type="submit" class="btn-effie-inv" style="width:100%"><i class="fa fa-plus"></i>&nbsp;Agregar</button>
						</div>
					</div>
					<div class="fila" id="not-stock-div" style="display:none">
						<div class="columna columna-1">
							<p class="lbl-msg"><b>Nota: Producto sin stock</b></p>
						</div>
					</div>
				</form>
				<table id="tbl-details" class="tablealumno tbl-details" style="margin-bottom:10px">
					<thead>
						<th width="30%">Producto</th>
						<th width="20%">Precio normal (PEN)</th>
						<th width="20%">Cantidad</th>
						<th width="20%">Subtotal normal (PEN)</th>
						<th width="10%">Quitar</th>
					</thead>
					<tbody>
						@foreach ($details as $index => $det)
						<tr>
							<td>{{ $det['product'] }}</td>
							<td><center>{{ number_format($det['price'],2) }}</center></td>
							<td><center>{{ $det['quantity'] }}</center></td>
							<td><center>{{ number_format($det['subtotal'],2) }}</center></td>
							<td><center><a name="{{ $index }}" onclick="removeDetail(this)"><i class="fa fa-trash"></i></a></center></td>
						</tr>
						@endforeach
					</tbody>
					<tfoot>
						<td>Total</td>
						<td></td>
						<td></td>
						<td style="text-align:center"></td>
						<td></td>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>