@extends('layouts.app')
@section('content')
<div class="fila">
	<div class="columna columna-1">
		<div class="title2">
			<h6>Procesos > Recepción > Verificar ></h6>
		</div>
	</div>
</div>
<form method="POST" action="{{ route('receptions.store') }}" role="form" id="frm-reception">
	@csrf
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
							<input type="text" disabled>
						</div>
						<div class="columna columna-5">
							<p>Código distribución</p>
							<input type="text" name="code" value="{{ $distribution->code ?? '' }}" readonly>
						</div>
						<div class="columna columna-5a">
							<p>Origen</p>
							<input type="text" value="{{ $distribution->origin->name ?? '' }}" disabled>
						</div>
						<div class="columna columna-5a">
							<p>Destino</p>
							<input type="text" value="{{ $distribution->destiny->name ?? '' }}" disabled>
						</div>
						<div class="columna columna-5">
							<p>Fecha y hora envío</p>
							<input type="text" value="{{ Carbon\Carbon::parse($distribution->date)->format('d/m/Y H:i') }}" disabled>
						</div>
						<div class="columna columna-5">
							<p>Fecha y hora llegada*</p>
							<input type="datetime-local" name="date" id="date" value="{{ old('date',Carbon\Carbon::now()->format('Y-m-d\TH:i')) }}" max="{{ Carbon\Carbon::now()->format('Y-m-d\TH:i') }}" required>
						</div>
						<div class="columna columna-5">
							<p>Estado</p>
							<select name="status" id="status" required>
                                <option value="CONFIRMADA" {{ old('status') == 'CONFIRMADA' ? 'selected' : '' }}>CONFIRMADA</option>
                            </select>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
@include('receptions/submit')
@endsection