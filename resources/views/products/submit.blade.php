<div class="fila">
	<div class="columna columna-1">
		<center>
		<button type="submit" class="btn-effie" onclick="document.getElementById('frm-product').submit();">
			<i class="fa fa-save"></i>&nbsp;{{ isset($product) ? 'Guardar' : 'Registrar' }}
		</button>
		<a href="{{ route('products.index') }}" class="btn-effie-inv">
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
			<li>El tamaño máximo del nombre es cincuenta (50) caracteres.</li>
			<li>El tamaño máximo de la descripción es quinientos (500) caracteres.</li>
		</ul></p>
	</div>
</div>