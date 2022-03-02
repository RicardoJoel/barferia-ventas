@extends('layouts.app')
@section('content')
<div class="fila">
	<div class="columna columna-1">
		<div class="title2">
			<h6>Procesos > Inventario > Editar ></h6>
		</div>
	</div>
</div>
<form method="POST" action="{{ route('inventories.update',$inventory->id) }}" role="form" id="frm-inventory">
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
							<input type="text" value="{{ $inventory->code }}" disabled>
						</div>
						<div class="columna columna-5b">
							<p>Fecha y hora de cierre*</p>
							<input type="datetime-local" name="date" id="date" value="{{ old('date',Carbon\Carbon::parse($inventory->date)->format('Y-m-d\TH:i')) }}" max="{{ Carbon\Carbon::now()->format('Y-m-d\TH:i') }}" required>
						</div>
						<div class="columna columna-5g">
							@if(Auth::user()->is_admin)
							<p>Local*</p>
							@inject('centers','App\Services\Centers')
							<select name="center_id" id="center_id" required>
								@foreach ($centers->get() as $index => $center)
								<option value="{{ $index }}" {{ old('center_id',$inventory->center_id) == $index ? 'selected' : '' }}>{{ $center }}</option>
								@endforeach
							</select>
							@else
							<p>Local</p>
							<input type="text" value="{{ $inventory->center->name }}" disabled>
							<input type="hidden" name="center_id" id="center_id" value="{{ old('center_id',$inventory->center_id) }}">
							@endif
						</div>
						<div class="columna columna-5">
							<p>Estado</p>
							<select name="status" id="status" required>
                                <option value="SIN CONFIRMAR" {{ old('status',$inventory->status) == 'SIN CONFIRMAR' ? 'selected' : '' }}>SIN CONFIRMAR</option>
                                <option value="CONFIRMADA" {{ old('status',$inventory->status) == 'CONFIRMADA' ? 'selected' : '' }}>CONFIRMADA</option>
                            </select>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
@include('inventories/submit')
@endsection