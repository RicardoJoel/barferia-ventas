<div class="fila">
	<div class="columna columna-1">
		<center>
		<button type="submit" class="btn-effie" onclick="document.getElementById('frm-center').submit();">
			<i class="fa fa-save"></i>&nbsp;{{ isset($center) ? 'Guardar' : 'Registrar' }}
		</button>
		<a href="{{ route('centers.index') }}" class="btn-effie-inv">
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
			<li>El tamaño máximo del nombre es (50) caracteres.</li>
			<li>El tamaño máximo de la dirección y la referencia es cien (100) caracteres.</li>
		</ul></p>
	</div>
</div>
@section('script')
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<link  rel="stylesheet" href="{{ asset('css/google_maps.css') }}">
<script src="{{ asset('js/centers/maps3.js') }}"></script>
<!-- Async script executes immediately and must be after any DOM elements used in callback. -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBiGvvtmWfu2G0_hpLS__FRfxiesHJ-sU&callback=initMap&libraries=places&v=weekly" async></script>
@endsection