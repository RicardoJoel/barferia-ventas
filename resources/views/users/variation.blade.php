<div class="fila">
    <div class="space"></div>
    <div class="columna columna-1">
		<div class="form-section">
			<a onclick="showForm('var')">
                <h6 id="var_subt" class="title3">Variaciones salariales</h6>
                <p id="icn-var" class="icn-sct"><i class="fa fa-plus fa-icon"></i></p>
            </a>
			<div id="div-var" style="display:none">
				<div class="fila">
					<div class="columna columna-1">
						<div class="span-fail" id="variation_fail_div"><span id="variation_fail_msg"></span></div>
					</div>
				</div>
				<form method="POST" action="{{ action('VariationController@store') }}" role="form" id="variation_form">
					@csrf
					<input type="hidden" name="cur_salary" value="{{ $user->cur_salary }}">
					<div class="fila"  style="margin-bottom:5px">
						<div class="columna columna-5">
							<p>Tipo*</p>
							<select name="variation_type" id="variation_type" required>
								<option value="Aumento" {{ old('variation_type') == 'Aumento' ? 'selected' : '' }}>Aumento</option>
								<option value="Disminución" {{ old('variation_type') == 'Disminución' ? 'selected' : '' }}>Disminución</option>
							</select>
						</div>
						<div class="columna columna-5">
							<p>Monto (PEN)*</p>
							<input type="number" name="variation_amount" id="variation_amount" value="{{ old('variation_amount') }}" onkeypress="return checkNumber(event)" required>
						</div>
						<div class="columna columna-5">
							<p>Fecha efectiva*</p>
							<input type="date" name="variation_start_at" id="variation_start_at" value="{{ old('variation_start_at') }}" required>
						</div>
						<div class="columna columna-5d">
							<p>Observación</p>
							<input type="text" name="variation_observation" id="variation_observation" value="{{ old('variation_observation') }}" maxlength="100">
						</div>
					</div>
					<div class="fila">
						<div class="columna columna-1">
							<center>
							<button id="variation_submit" type="submit" class="btn-effie"><i class="fa fa-plus"></i>&nbsp;Agregar</button>
							<a onclick="clearVarForm()" class="btn-effie-inv"><i class="fa fa-paint-brush"></i>&nbsp;Limpiar</a>
							</center>
						</div>
					</div>
				</form>
				<div class="space"></div>
				<table id="tbl-variations" class="tablealumno" style="margin-bottom:10px">
					<thead>
						<th width="10%">F. Ingreso</th>
						<th width="10%">Tipo</th>
						<th width="10%">F. Efectiva</th>
						<th width="20%">Sueldo inicial (PEN)</th>
						<th width="10%">Monto (PEN)</th>
						<th width="20%">Sueldo final (PEN)</th>
						<th width="20%">Observación</th>
					</thead>
					<tbody>
						@foreach ($variations as $variation)
						<tr>
							<td><center>{{ Carbon\Carbon::parse($variation['created_at'])->format('d/m/Y') }}</center></td>
							<td><center>{{ $variation['type'] }}</center></td>
							<td><center>{{ Carbon\Carbon::parse($variation['start_at'])->format('d/m/Y') }}</center></td>
							<td><center>{{ number_format($variation['before'],2) }}</center></td>
							<td><center>{{ number_format($variation['amount'],2) }}</center></td>
							<td><center>{{ number_format($variation['after'],2) }}</center></td>
							<td>{{ $variation['observation'] }}</td>
						</tr>
						@endforeach
					</tbody>			
				</table>
			</div>
        </div>
    </div>
</div>