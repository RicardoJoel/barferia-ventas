@extends('layouts.app')
@section('content')
<div class="fila">
	<div class="columna columna-1">
		<div class="title2">
			<h6>Procesos > Recepción > Revisar ></h6>
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
						<p>Código recepción</p>
						<input type="text" value="{{ $reception->code ?? '' }}"disabled>
					</div>
					<div class="columna columna-5">
						<p>Código distribución</p>
						<input type="text" value="{{ $reception->distribution->code ?? '' }}" disabled>
					</div>
					<div class="columna columna-5a">
						<p>Origen</p>
						<input type="text" value="{{ $reception->distribution->origin->name ?? '' }}" disabled>
					</div>
					<div class="columna columna-5a">
						<p>Destino</p>
						<input type="text" value="{{ $reception->distribution->destiny->name ?? '' }}" disabled>
					</div>
					<div class="columna columna-5">
						<p>Fecha y hora envío</p>
						<input type="text" value="{{ Carbon\Carbon::parse($reception->distribution->date)->format('d/m/Y H:i') }}" disabled>
					</div>
					<div class="columna columna-5">
						<p>Fecha y hora llegada</p>
						<input type="text" value="{{ Carbon\Carbon::parse($reception->date)->format('d/m/Y H:i') }}" disabled>
					</div>
					<div class="columna columna-5">
						<p>Estado</p>
						<input type="text" value="{{ $reception->status ?? '' }}" disabled>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@include('receptions/detailview')
<div class="fila">
	<div class="space"></div>
	<div class="columna columna-1">
		<center>
		<a href="{{ route('receptions.index') }}" class="btn-effie-inv">
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
<style>
.tbl-details td:nth-child(3),td:nth-child(6){text-align:center !important}
.tbl-details td input{margin:0 !important;}
</style>
<script src="{{ asset('js/receptions/detailsview.js') }}"></script>
@endsection