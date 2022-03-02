@extends('layouts.app')
@section('content')
<div class="fila">
	<div class="columna columna-1">
		<div class="title2">
			<h6>Entidades > Locales > Editar ></h6>
		</div>
	</div>
</div>
<form method="POST" action="{{ route('centers.update',$center->id) }}" role="form" id="frm-center">
	@csrf
	<input type="hidden" name="_method" id="_method" value="PATCH">
	<input type="hidden" id="other_ubigeo" value="{{ old('ubigeo',$center->other_ubigeo) }}">
	<div class="fila">
		<div class="columna columna-2">
			<div class="form-section">
				<a onclick="showForm('gen')">
					<h6 id="gen_subt" class="title3">General</h6>
					<p id="icn-gen" class="icn-sct"><i class="fa fa-minus fa-icon"></i></p>
				</a>
				<div id="div-gen">
					<div class="fila">
						<div class="columna columna-3">
							<p>Código</p>
							<input type="text" value="{{ $center->code }}" disabled>
						</div>
						<div class="columna columna-3c">
							<p>Nombre*</p>
							<input type="text" name="name" id="name" maxlength="50" value="{{ old('name',$center->name) }}" required>
						</div>
						<div class="columna columna-3">
							<p>Cod. Referencial*</p>
							<input type="text" name="nemo" id="nemo" maxlength="3" value="{{ old('nemo',$center->nemo) }}" onkeypress="return checkAlNum(event)" onkeyup="return mayusculas(this)" required>
						</div>
						<div class="columna columna-3c">
							<p>Tipo*</p>
							<select name="type" id="type" required>
                                <option value="T" {{ old('type',$center->type) == 'T' ? 'selected' : '' }}>Centro de distribución</option>
                                <option value="F" {{ old('type',$center->type) == 'F' ? 'selected' : '' }}>Centro de producción</option>
                            </select>
						</div>
					</div>
				</div>
			</div>
			<div class="form-section">
				<a onclick="showForm('ubi')">
					<h6 id="ubi_subt" class="title3">Ubicación</h6>
					<p id="icn-ubi" class="icn-sct"><i class="fa fa-minus fa-icon"></i></p>
				</a>
				<div id="div-ubi">
					<div class="fila">
						<input type="hidden" name="lat" id="lat" value="{{ old('lat',$center->lat) }}">
						<input type="hidden" name="lng" id="lng" value="{{ old('lng',$center->lng) }}">
						<div class="columna columna-1">
							<p>Dirección*</p>
							<input type="text" name="address" id="address" value="{{ old('address',$center->address) }}" maxlength="100" class="controls" placeholder="" required>
						</div>
						<div class="columna columna-1">
							<p>Ubicación* (puede que necesite ser ajustada)</p>
							@inject('ubigeos','App\Services\Ubigeos')
							<select name="ubigeo" id="ubigeo" required>
								@foreach ($ubigeos->get() as $index => $ubigeo)
								<option value="{{ $index }}" {{ old('ubigeo',$center->ubigeo_id) == $index ? 'selected' : '' }}>{{ $ubigeo }}</option>
								@endforeach
							</select>
						</div>
						<div class="columna columna-1">
							<p>Referencia, N°, Mz., Lote y/o Interior</p>
							<input type="text" name="ref" id="ref" value="{{ old('ref',$center->ref) }}" maxlength="100">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="columna columna-2">
			<div style="height:510px" id="map"></div>
		</div>
	</div>	
</form>
@include('centers/submit')
@endsection
