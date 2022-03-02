@extends('layouts.app')
@section('content')
<div class="fila">
	<div class="columna columna-1">
		<div class="title2">
			<h6>Utilitarios > Ajustes > Editar ></h6>
		</div>
	</div>
</div>
<form method="POST" action="{{ route('parameters.update',$parameter->id) }}" role="form">
	@csrf
	<input name="_method" type="hidden" value="PATCH">
	<div class="fila">
		<div class="columna columna-1">
			<div class="form-section">
				<a onclick="showForm('gen')">
					<h6 id="gen_subt" class="title3">General</h6>
					<p id="icn-gen" class="icn-sct"><i class="fa fa-minus fa-icon"></i></p>
				</a>
				<div id="div-gen">
					<div class="fila">
						<div class="columna columna-5c">
							<label>{{ $parameter->description }}</label>
						</div>
						<div class="columna columna-5">
							<input type="number" name="value" id="value" min="1" value="{{ old('value', $parameter->value) }}" onkeypress="return checkNumber(event)" required>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="fila">
		<div class="columna columna-1">
			<center>
			<button type="submit" class="btn-effie"><i class="fa fa-save"></i>&nbsp;Guardar</button>
			<a href="{{ route('parameters.index') }}" class="btn-effie-inv"><i class="fa fa-reply"></i>&nbsp;Regresar</a>	
			</center>
		</div>
	</div>
</form>
@endsection