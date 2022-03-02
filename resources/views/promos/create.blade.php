@extends('layouts.app')
@section('content')
<div class="fila">
	<div class="columna columna-1">
		<div class="title2">
			<h6>Entidades > Promociones > Nueva ></h6>
		</div>
	</div>
</div>
<form method="POST" action="{{ route('promos.store') }}" role="form" id="frm-promo">
	@csrf
	<input type="hidden" name="type" id="type" value="{{ old('type','P') }}">
	<input type="hidden" name="amount" id="amount" value="{{ old('amount',0) }}">
	<div class="fila">
        <div class="columna columna-1">
			<div class="form-section">
				<a onclick="showForm('gen')">
					<h6 id="gen_subt" class="title3">General</h6>
					<p id="icn-gen" class="icn-sct"><i class="fa fa-minus fa-icon"></i></p>
				</a>
				<div id="div-gen">
					<div class="fila">
						<div class="columna columna-6">
							<p>Código</p>
							<input type="text" disabled>
						</div>
						<div class="columna columna-2">
							<p>Nombre*</p>
							<input type="text" name="name" id="name" maxlength="100" value="{{ old('name') }}" required>
						</div>
						<div class="columna columna-6">
							<p>Fecha inicio*</p>
							<input type="date" name="start_at" id="start_at" value="{{ old('start_at',Carbon\Carbon::today()->format('Y-m-d')) }}" required>
						</div>
						<div class="columna columna-6">
							<p>Fecha fin*</p>
							<input type="date" name="end_at" id="end_at" value="{{ old('end_at',Carbon\Carbon::tomorrow()->format('Y-m-d')) }}" required>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
@include('promos/details')
<div class="fila">
	<div class="columna columna-1">
		<div class="form-section">
			<a onclick="showForm('pay')">
				<h6 id="pay_subt" class="title3">Resumen</h6>
				<p id="icn-pay" class="icn-sct"><i class="fa fa-minus fa-icon"></i></p>
			</a>
			<div id="div-pay">
				<div class="fila">
					<div class="columna columna-6">
						<p>Total normal (PEN)</p>
						<input type="text" name="aux_total" id="aux_total" value="{{ old('aux_total','0.00') }}" disabled>
					</div>
					<div class="columna columna-3">
						<p>Tipo de descuento*</p>
						<select name="aux_type" id="aux_type" required>
							<option value="P" {{ old('aux_type') == 'P' ? 'selected' : '' }}>Porcentaje de descuento (%)</option>
							<option value="M" {{ old('aux_type') == 'M' ? 'selected' : '' }}>Precio de monto fijo (PEN)</option>
						</select>
					</div>
					<div class="columna columna-6">
						<p>Monto / Porc. (%)</p>
						<input type="number" name="aux_amount" id="aux_amount" value="{{ old('aux_amount','0.00') }}" step="any">
					</div>
					<div class="columna columna-6">
						<p>Dcto. Total (PEN)</p>
						<input type="text" name="aux_discount" id="aux_discount" value="{{ old('aux_discount','0.00') }}" readonly>
					</div>
					<div class="columna columna-6">
						<p>Precio final (PEN)</p>
						<input type="text" name="aux_price" id="aux_price" value="{{ old('aux_price','0.00') }}" readonly>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@include('promos/submit')
@endsection