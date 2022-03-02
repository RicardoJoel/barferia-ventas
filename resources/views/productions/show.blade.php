@extends('layouts.app')
@section('content')
<div class="fila">
	<div class="columna columna-1">
		<div class="title2">
			<h6>Procesos > Producción > Revisar ></h6>
		</div>
	</div>
</div>
<div class="fila">
	<div class="columna columna-1">
		<div class="form-section">
			<a onclick="showForm('gen')">
				<h6 id="gen_subt" class="title3">General</h6>
				<p id="icn-gen" class="icn-sct"><i class="fa fa-minus fa-icon"></i></p>
			</a>
			<div id="div-gen">
				<div class="fila">
					<div class="columna columna-5">
						<p>Código</p>
						<input type="text" value="{{ $production->code }}" disabled>
					</div>
					<div class="columna columna-5b">
						<p>Fecha y hora de cierre</p>
						<input type="text" value="{{ Carbon\Carbon::parse($production->date)->format('d/m/Y H:i') }}" disabled>
					</div>
					<div class="columna columna-5g">
						<p>Centro de producción</p>
						<input type="text" value="{{ $production->center->name }}" disabled>
					</div>
					<div class="columna columna-5">
						<p>Estado</p>
						<input type="text" value="{{ $production->status }}" disabled>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@include('productions/detailview')
@include('productions/detailtable')
<div class="fila">
	<div class="space"></div>
	<div class="columna columna-1">
		<center>
		<a href="{{ route('productions.index') }}" class="btn-effie-inv">
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
			<li>Cantidades expresadas en unidades de paquete (uds.)</li>
		</ul></p>
	</div>
</div>
@endsection
@section('script')
<style>.tbl-details td:nth-child(2) {text-align:center}</style>
<script src="{{ asset('js/productions/details5.js') }}"></script>
@endsection