@extends('layouts.app')
@section('content')
<div class="fila">
	<div class="columna columna-1">
		<div class="title2">
			<h6>Entidades > Clientes > Nuevo ></h6>
		</div>
	</div>
</div>
<form method="POST" action="{{ route('customers.store') }}" role="form" id="frm-customer">
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
						<div class="columna columna-6">
							<p>Código</p>
							<input type="text" disabled>
						</div>
						<div class="columna columna-3d">
							<p>Nombre*</p>
							<input type="text" name="name" id="name" maxlength="50" value="{{ old('name') }}"  onkeypress="return checkName(event)" required>
						</div>
						<div class="columna columna-3d">
							<p>Apellido*</p>
							<input type="text" name="lastname" id="lastname" maxlength="50" value="{{ old('lastname') }}"  onkeypress="return checkName(event)" required>
						</div>
						<div class="columna columna-5">
							<p>F. Nacimiento</p>
							<input type="date" name="birthdate" id="birthdate" max="{{ Carbon\Carbon::today()->subYear(18)->toDateString() }}" value="{{ old('birthdate') }}">
						</div>
					</div>
					<div class="fila">
						<div class="columna columna-3d">
							<p>Tipo de documento*</p>
							@inject('documentTypes','App\Services\DocumentTypes')
							<select name="document_type_id" id="document_type_id" required>
								@foreach ($documentTypes->get() as $index => $documentType)
								<option value="{{ $index }}" {{ old('document_type_id') == $index ? 'selected' : '' }}>{{ $documentType['name'] }}</option>
								@endforeach
							</select>
						</div>
						<div class="columna columna-6">
							<p>N° Documento*</p>
							<input type="hidden" name="doc_pattern" id="doc_pattern" value="{{ old('doc_pattern') }}">
							<input type="text" name="document" id="document" value="{{ old('document') }}" onkeyup="return mayusculas(this)" disabled required>
						</div>
						<div class="columna columna-3e">
							<p>Correo electrónico</p>
							<input type="email" name="email" id="email" maxlength="50" value="{{ old('email') }}" onkeypress="return checkEmail(event)" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="fila">
		<div class="columna columna-2">
			<div class="form-section">
				<a onclick="showForm('ctt')">
					<h6 id="ctt_subt" class="title3">Contacto</h6>
					<p id="icn-ctt" class="icn-sct"><i class="fa fa-minus fa-icon"></i></p>
				</a>
				<div id="div-ctt">
					<div class="fila">
						<div class="columna columna-3">
							<p>Código país*</p>
							@inject('countries','App\Services\Countries')
							<select name="country_id" id="country_id" required>
								<option selected disabled hidden value="">Selecciona un país</option>
								@foreach ($countries->get() as $index => $country)
								<option value="{{ $index }}" {{ old('country_id',164) == $index ? 'selected' : '' }}>{{ $country }}</option>
								@endforeach
							</select>
						</div>
						<div class="columna columna-3">
							<p>Celular*</p>
							<input type="tel" name="mobile" id="mobile" maxlength="11" value="{{ old('mobile') }}" onkeypress="return checkNumber(event)" pattern="[0-9]{3} [0-9]{3} [0-9]{3}" required>
						</div>
						<div class="columna columna-3">
							<p>Teléfono fijo</p>
							<input type="tel" name="phone" id="phone" maxlength="11" value="{{ old('phone') }}" onkeypress="return checkNumber(event)" pattern="[0-9]{2} [0-9]{3} [0-9]{4}">
						</div>
					</div>
				</div>
			</div></form>
			@include('customers/locform')
		</div>
		<div class="columna columna-2">
			<div id="map"></div>
		</div>
	</div>
@include('customers/submit')
@endsection
