@extends('layouts.app')
@section('content')
<div class="fila">
	<div class="columna columna-1">
		<div class="title2">
			<h6>Procesos > Recepción > Editar ></h6>
		</div>
	</div>
</div>
<form method="POST" action="{{ route('receptions.update',$reception->id) }}" role="form" id="frm-reception">
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
							<input type="text" value="{{ $reception->code ?? '' }}" disabled>
						</div>
						<div class="columna columna-5">
							<p>Código distribución</p>
							<input type="text" name="code" value="{{ $reception->distribution->code ?? '' }}" readonly>
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
							<p>Fecha y hora llegada*</p>
							<input type="datetime-local" name="date" id="date" value="{{ old('date',Carbon\Carbon::parse($reception->date)->format('Y-m-d\TH:i')) }}" max="{{ Carbon\Carbon::now()->format('Y-m-d\TH:i') }}" required>
						</div>
						<div class="columna columna-5">
							<p>Estado</p>
							<select name="status" id="status" required>
                                <option value="VERIFICADA" {{ old('status',$reception->status) == 'VERIFICADA' ? 'selected' : '' }}>VERIFICADA</option>
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