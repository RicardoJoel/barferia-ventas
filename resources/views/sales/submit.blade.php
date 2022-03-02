<div class="fila">
	<div class="columna columna-1">
		<center>
		<button type="submit" class="btn-effie" onclick="document.getElementById('frm-sale').submit()">
			<i class="fa fa-save"></i>&nbsp;{{ isset($sale) ? 'Guardar' : 'Registrar' }}
		</button>
		<a href="{{ route('sales.index') }}" class="btn-effie-inv">
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
			<li>Para buscar un cliente debes ingresar su N° Documento y luego presionar Enter, o presionar sobre el botón "Buscar cliente"</li>
			<li>Para agregar un producto debes seleccionarlo, ingresar la cantidad y luego presionar sobre el botón "Agregar"</li>
		</ul></p>
	</div>
</div>
@include('sales/popups/centers')
@include('sales/popups/closest')
@include('sales/popups/customer')
@include('sales/popups/detail')
@include('sales/popups/notfound')
@include('sales/popups/promo')
@include('sales/popups/removed')
@include('sales/popups/stock')
@include('searches/customers')
@include('searches/ubications')
@section('script')
<style>
.tbl-details td input{
	width:70px !important;
	margin:0 !important;
	padding:0 10px !important;
}
</style>
<script src="{{ asset('js/sales/form17.js') }}"></script>
<script src="{{ asset('js/sales/details40.js') }}"></script>
<script src="{{ asset('js/searches/customers15.js') }}"></script>
<script src="{{ asset('js/searches/ubications14.js') }}"></script>
<script src="{{ asset('js/customers/form5.js') }}"></script>
<script src="{{ asset('js/customers/pets8.js') }}"></script>
<script src="{{ asset('js/customers/locations5.js') }}"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<link rel="stylesheet" href="{{ asset('css/google_maps.css') }}">
<script src="{{ asset('js/customers/maps.js') }}"></script>
<!-- Async script executes immediately and must be after any DOM elements used in callback. -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBiGvvtmWfu2G0_hpLS__FRfxiesHJ-sU&callback=initMap&libraries=places&v=weekly" async></script>
@endsection