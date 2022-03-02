@extends('layouts.app')
@section('content')
<div class="fila">
	<div class="columna columna-1">
		<div class="title2">
			<h6>Procesos > Producción > Nueva ></h6>
		</div>
	</div>
</div>
<form method="POST" action="{{ route('productions.store') }}" role="form" id="frm-production">
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
							<p>Código</p>
							<input type="text" disabled>
						</div>
						<div class="columna columna-5b">
							<p>Fecha y hora de cierre*</p>
							<input type="datetime-local" name="date" id="date" value="{{ old('date',Carbon\Carbon::now()->format('Y-m-d\TH:i')) }}" max="{{ Carbon\Carbon::now()->format('Y-m-d\TH:i') }}" required>
						</div>
						<div class="columna columna-5g">
							@if(Auth::user()->is_admin)
							<p>Centro de producción*</p>
							@inject('centers','App\Services\Centers')
							<select name="center_id" id="center_id" required>
								@foreach ($centers->getByType('F') as $index => $center)
								<option value="{{ $index }}" {{ old('center_id') == $index ? 'selected' : '' }}>{{ $center }}</option>
								@endforeach
							</select>
							@else
							<p>Centro de producción</p>
							<input type="text" value="{{ Auth::user()->center->name ?? '' }}" disabled>
							<input type="hidden" name="center_id" id="center_id" value="{{ old('center_id',Auth::user()->center_id) }}">
							@endif
						</div>
						<div class="columna columna-5">
							<p>Estado</p>
							<select name="status" id="status" required>
                                <option value="SIN CONFIRMAR" {{ old('status') == 'SIN CONFIRMAR' ? 'selected' : '' }}>SIN CONFIRMAR</option>
                                <option value="CONFIRMADA" {{ old('status') == 'CONFIRMADA' ? 'selected' : '' }}>CONFIRMADA</option>
                            </select>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
@include('productions/submit')
@endsection