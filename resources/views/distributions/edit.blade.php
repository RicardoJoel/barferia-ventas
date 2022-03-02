@extends('layouts.app')
@section('content')
<div class="fila">
	<div class="columna columna-1">
		<div class="title2">
			<h6>Procesos > Distribución > Editar ></h6>
		</div>
	</div>
</div>
<form method="POST" action="{{ route('distributions.update',$distribution->id) }}" role="form" id="frm-distribution">
	@csrf
	<input type="hidden" name="_method" id="_method" value="PATCH">
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
							<input type="text" value="{{ $distribution->code }}" disabled>
						</div>
						<div class="columna columna-5b">
							<p>Fecha y hora de envío*</p>
							<input type="datetime-local" name="date" id="date" value="{{ old('date',Carbon\Carbon::parse($distribution->date)->format('Y-m-d\TH:i')) }}" max="{{ Carbon\Carbon::now()->format('Y-m-d\TH:i') }}" required>
						</div>
						<div class="columna columna-5a">
							@if(Auth::user()->is_admin)
							<p>Origen*</p>
							@inject('centers','App\Services\Centers')
							<select name="origin_id" id="origin_id" required>
								@foreach ($centers->getByType('F') as $index => $center)
								<option value="{{ $index }}" {{ old('origin_id',$distribution->origin_id) == $index ? 'selected' : '' }}>{{ $center }}</option>
								@endforeach
							</select>
							@else
							<p>Origen</p>
							<input type="text" value="{{ Auth::user()->center->name ?? '' }}" disabled>
							<input type="hidden" name="origin_id" id="origin_id" value="{{ old('origin_id',$distribution->origin_id) }}">
							@endif
						</div>
						<div class="columna columna-5h">
							<p>Destino*</p>
							@inject('centers','App\Services\Centers')
							<select name="destiny_id" id="destiny_id" required>
								@foreach ($centers->getByType('T') as $index => $center)
								<option value="{{ $index }}" {{ old('destiny_id',$distribution->destiny_id) == $index ? 'selected' : '' }}>{{ $center }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="fila">
						<div class="columna columna-5">
							<p>Estado</p>
							<select name="status" id="status" required>
                                <option value="SIN CONFIRMAR" {{ old('status',$distribution->status) == 'SIN CONFIRMAR' ? 'selected' : '' }}>SIN CONFIRMAR</option>
                                <option value="CONFIRMADA" {{ old('status',$distribution->status) == 'CONFIRMADA' ? 'selected' : '' }}>CONFIRMADA</option>
                            </select>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
@include('distributions/submit')
@endsection