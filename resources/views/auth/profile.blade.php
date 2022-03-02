@extends('layouts.app')
@section('content')
<div class="fila">
	<div class="columna columna-1">
		<div class="title2">
			<h6>Mi cuenta > Mis datos ></h6>
		</div>
	</div>
</div>
<form method="POST" action="{{ route('updateAccount') }}" role="form" id="frm-profile">
	@csrf
	<input type="hidden" id="other_ubigeo" value="{{ old('ubigeo',Auth::user()->other_ubigeo) }}">
	<input type="hidden" id="contact_other_ubigeo" value="{{ old('contact_ubigeo',Auth::user()->contact_other_ubigeo) }}">
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
							<input type="text" value="{{ Auth::user()->code }}" disabled>
						</div>
						<div class="columna columna-3d">
							<p>Nombres*</p>
							<input type="text" name="name" id="name" maxlength="50" value="{{ old('name',Auth::user()->name) }}" onkeypress="return checkName(event)" required>
						</div>
						<div class="columna columna-3d">
							<p>Apellidos*</p>
							<input type="text" name="lastname" id="lastname" maxlength="50" value="{{ old('lastname',Auth::user()->lastname) }}" onkeypress="return checkName(event)" required>
						</div>
						<div class="columna columna-5">
							<p>F. Nacimiento*</p>
							<input type="date" name="birthdate" id="birthdate" value="{{ old('birthdate',Auth::user()->birthdate) }}" max="{{ Carbon\Carbon::today()->subYear(18)->toDateString() }}" required>
						</div>
					</div>
					<div class="fila">
						<div class="columna columna-3">
							<p>Tipo de documento</p>
							<input type="text" value="{{ Auth::user()->documentType->name ?? '' }}" disabled>
						</div>
						<div class="columna columna-6">
							<p>N° Documento</p>
							<input type="text" value="{{ Auth::user()->document }}" disabled>
						</div>
						<div class="columna columna-6">
							<p>Género*</p>
							@inject('genders','App\Services\Genders')
							<select name="gender_id" id="gender_id" required>
								<option selected disabled hidden value="">Selecciona</option>
								@foreach ($genders->get() as $index => $gender)
								<option value="{{ $index }}" {{ old('gender_id',Auth::user()->gender_id) == $index ? 'selected' : '' }}>
									{{ $gender }}
								</option>
								@endforeach
							</select>
						</div>
						<div class="columna columna-3">
							<p>Correo electrónico institucional</p>
							<input type="text" value="{{ Auth::user()->email }}" disabled>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="fila">
        <div class="columna columna-1">
			<div class="form-section">
				<a onclick="showForm('ctt')">
					<h6 id="ctt_subt" class="title3">Contacto</h6>
					<p id="icn-ctt" class="icn-sct"><i class="fa fa-minus fa-icon"></i></p>
				</a>
				<div id="div-ctt">
					<div class="fila">
						<div class="columna columna-2">
							<p>Dirección de domicilio*</p>
							<input type="text" name="address" id="address" maxlength="100" value="{{ old('address',Auth::user()->address) }}" required>
						</div>
						<div class="columna columna-2">
							<p>Departamento / Provincia / Distrito de domicilio*</p>
							@inject('ubigeos','App\Services\Ubigeos')
							<select name="ubigeo" id="ubigeo" required>
								@foreach ($ubigeos->get() as $index => $ubigeo)
								<option value="{{ $index }}" {{ old('ubigeo',Auth::user()->ubigeo_id) == $index ? 'selected' : '' }}>{{ $ubigeo }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="fila">
						<div class="columna columna-6">
							<p>Código país*</p>
							@inject('countries','App\Services\Countries')
							<select name="country_id" id="country_id" required>
								<option selected disabled hidden value="">Selecciona un país</option>
								@foreach ($countries->get() as $index => $country)
								<option value="{{ $index }}" {{ old('country_id',Auth::user()->country_id ?? 164) == $index ? 'selected' : '' }}>{{ $country }}</option>
								@endforeach
							</select>
						</div>
						<div class="columna columna-6">
							<p>Celular*</p>
							<input type="tel" name="mobile" id="mobile" maxlength="17" value="{{ old('mobile',Auth::user()->mobile) }}" onkeypress="return checkNumber(event)" pattern="[0-9]{3} [0-9]{3} [0-9]{3}" required>
						</div>
						<div class="columna columna-6">
							<p>Teléfono fijo</p>
							<input type="tel" name="phone" id="phone" maxlength="11" value="{{ old('phone',Auth::user()->phone) }}" onkeypress="return checkNumber(event)" pattern="[0-9]{2} [0-9]{3} [0-9]{4}">
						</div>
						<div class="columna columna-6">
							<p>Anexo</p>
							<input type="tel" name="annex" id="annex" maxlength="6" value="{{ old('annex',Auth::user()->annex) }}" onkeypress="return checkNumber(event)" pattern="[0-9]{4,6}">
						</div>
						<div class="columna columna-3">
							<p>Correo electrónico personal</p>
							<input type="email" name="alt_email" id="alt_email" maxlength="50" value="{{ old('alt_email',Auth::user()->alt_email) }}" onkeypress="return checkEmail(event)" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
	<div class="fila">
        <div class="columna columna-1">
			<div class="form-section">
				<a onclick="showForm('lab')">
					<h6 id="lab_subt" class="title3">Laboral</h6>
					<p id="icn-lab" class="icn-sct"><i class="fa fa-minus fa-icon"></i></p>
				</a>
				<div id="div-lab">
					<div class="fila">
						<div class="columna columna-5">
							<p>Vínculo laboral</p>
							<input type="text" value="{{ Auth::user()->relationship->name ?? '' }}" disabled>
						</div>
						<div class="columna columna-5d">
							<p>Cargo</p>
							<input type="text" value="{{ Auth::user()->profile->name ?? '' }}" disabled>
						</div>
						<div class="columna columna-5d">
							<p>Tienda / Centro de producción</p>
							<input type="text" value="{{ Auth::user()->center->name ?? '' }}" disabled>
						</div>
					</div>
					<div class="fila">
						<div class="columna columna-5">
							<p>Sueldo bruto (PEN)</p>
							<input type="text" value="{{ number_format(Auth::user()->cur_salary,2) }}" disabled>
						</div>
						<div class="columna columna-5">
							<p>Comisión (%)</p>
							<input type="text" value="{{ number_format(Auth::user()->commission,2) }}" disabled>
						</div>
						<div class="columna columna-5">
							<p>Variación salarial</p>
							<input type="text" value="{{ Auth::user()->frequency->name ?? '' }}" disabled>
						</div>
						<div class="columna columna-5">
							<p>Fecha de inicio</p>
							<input type="text" value="{{ Auth::user()->start_at ? Carbon\Carbon::parse(Auth::user()->start_at)->format('d/m/Y') : '' }}" disabled>
						</div>
						<div class="columna columna-5">
							<p>Fecha de cese</p>
							<input type="text" value="{{ Auth::user()->end_at ? Carbon\Carbon::parse(Auth::user()->end_at)->format('d/m/Y') : '' }}" disabled>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="fila">
        <div class="columna columna-1">
			<div class="form-section">
				<a onclick="showForm('pln')">
					<h6 id="pln_subt" class="title3">Planilla</h6>
					<p id="icn-pln" class="icn-sct"><i class="fa fa-plus fa-icon"></i></p>
				</a>
				<div id="div-pln" style="display:none">
					<div class="fila">
						<div class="columna columna-3">
							<p>Entidad bancaria Sueldo</p>
							<input type="text" value="{{ Auth::user()->bank->name ?? '' }}" disabled>
						</div>
						<div class="columna columna-3">
							<p>N° Cuenta Sueldo</p>
							<input type="text" value="{{ Auth::user()->bank_account }}" disabled>
						</div>
						<div class="columna columna-3">
							<p>Código de Cuenta Interbancario (CCI)</p>
							<input type="text" value="{{ Auth::user()->cci }}" disabled>
						</div>
					</div>
					<div class="fila">
						<div class="columna columna-3">
							<p>Adm. Fondo de pensiones (AFP)</p>
							<input type="text" value="{{ Auth::user()->afp->name ?? '' }}" disabled>

						</div>
						<div class="columna columna-3">
							<p>Tipo de comisión</p>
							<input type="text" value="{{ Auth::user()->afpCommission->name ?? '' }}" disabled>
						</div>
						<div class="columna columna-3">
							<p>Código CUSPP</p>
							<input type="text" value="{{ Auth::user()->cuspp }}" disabled>
						</div>
					</div>
					<div class="fila">
						<div class="columna columna-3">
							<p>Entidad bancaria CTS</p>
							<input type="text" value="{{ Auth::user()->cts->name ?? '' }}" disabled>
						</div>
						<div class="columna columna-3">
							<p>N° Cuenta CTS</p>
							<input type="text" value="{{ Auth::user()->cts_account }}" disabled>
						</div>
					</div>
					<div class="fila">
						<div class="columna columna-3">
							<p>Plan EPS</p>
							<input type="text" value="{{ Auth::user()->eps->name ?? '' }}" disabled>
						</div>
						<div class="columna columna-3">
							<p>Código Essalud</p>
							<input type="text" value="{{ Auth::user()->essalud }}" disabled>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="fila">
        <div class="columna columna-1">
			<div class="form-section">
				<a onclick="showForm('mrg')">
					<h6 id="mrg_subt" class="title3">Contacto de emergencia</h6>
					<p id="icn-mrg" class="icn-sct"><i class="fa fa-plus fa-icon"></i></p>
				</a>
				<div id="div-mrg" style="display:none">
					<div class="fila">
						<div class="columna columna-3">
							<p>Nombre completo</p>
							<input type="text" name="contact_fullname" id="contact_fullname" maxlength="50" value="{{ old('contact_fullname',Auth::user()->contact_fullname) }}" onkeypress="return checkName(event)">
						</div>
						<div class="columna columna-3">
							<p>Parentesco</p>
							<input type="text" name="contact_relationship" id="contact_relationship" maxlength="50" value="{{ old('contact_relationship',Auth::user()->contact_relationship) }}" onkeypress="return checkName(event)">
						</div>
						<div class="columna columna-3">
							<p>Dirección laboral o de domicilio</p>
							<input type="text" name="contact_address" id="contact_address" maxlength="100" value="{{ old('contact_address',Auth::user()->contact_address) }}">
						</div>
					</div>
					<div class="fila">
						<div class="columna columna-3">
							<p>Departamento / Provincia / Distrito</p>
							@inject('ubigeos','App\Services\Ubigeos')
							<select name="contact_ubigeo" id="contact_ubigeo">
								@foreach ($ubigeos->get() as $index => $ubigeo)
								<option value="{{ $index }}" {{ old('contact_ubigeo',Auth::user()->contact_ubigeo_id) == $index ? 'selected' : '' }}>{{ $ubigeo }}</option>
								@endforeach
							</select>
						</div>
						<div class="columna columna-6">
							<p>Código país</p>
							@inject('countries','App\Services\Countries')
							<select name="contact_country_id" id="contact_country_id">
								<option selected disabled hidden value="">Selecciona un país</option>
								@foreach ($countries->get() as $index => $country)
								<option value="{{ $index }}" {{ old('contact_country_id',Auth::user()->contact_country_id ?? 164) == $index ? 'selected' : '' }}>{{ $country }}</option>
								@endforeach
							</select>
						</div>
						<div class="columna columna-6">
							<p>Celular</p>
							<input type="tel" name="contact_mobile" id="contact_mobile" maxlength="11" value="{{ old('contact_mobile',Auth::user()->contact_mobile) }}" onkeypress="return checkNumber(event)" pattern="[0-9]{3} [0-9]{3} [0-9]{3}">
						</div>
						<div class="columna columna-6">
							<p>Teléfono fijo</p>
							<input type="tel" name="contact_phone" id="contact_phone" maxlength="11" value="{{ old('contact_phone',Auth::user()->contact_phone) }}" onkeypress="return checkNumber(event)" pattern="[0-9]{2} [0-9]{3} [0-9]{4}">
						</div>
						<div class="columna columna-6">
							<p>Anexo</p>
							<input type="tel" name="contact_annex" id="contact_annex" maxlength="6" value="{{ old('contact_annex',Auth::user()->contact_annex) }}" onkeypress="return checkNumber(event)" pattern="[0-9]{4,6}">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
<div class="fila">
    <div class="columna columna-1">
		<div class="form-section">
			<a onclick="showForm('lst')">
				<h6 id="lst_subt" class="title3">Dependientes</h6>
				<p id="icn-lst" class="icn-sct"><i class="fa fa-plus fa-icon"></i></p>
			</a>
			<div id="div-lst" class="fila" style="display:none">
				<table id="tbl-dependents" class="tablealumno" style="margin-bottom:10px">
					<thead>
						<th width="20%">Nombre completo</th>
						<th width="20%">Vínculo</th>
						<th width="20%">Tipo de documento</th>
						<th width="10%">N° Documento</th>
						<th width="10%">Género</th>
						<th width="10%">F. Nacimiento</th>
					</thead>
					<tbody>
						@foreach (Auth::user()->dependents as $dependent)
						<tr>
							<td>{{ $dependent->fullname }}</td>
							<td>{{ $dependent->dependentType->name ?? '' }}</td>
							<td>{{ $dependent->documentType->name ?? '' }}</td>
							<td><center>{{ $dependent->document }}</center></td>
							<td><center>{{ $dependent->gender->name ?? '' }}</center></td>
							<td><center>{{ Carbon\Carbon::parse($dependent->birthdate)->format('d/m/Y') }}</center></td>
						</tr>
						@endforeach
					</tbody>	
				</table>
			</div>
		</div>
	</div>
</div>
<div class="fila">
    <div class="columna columna-1">
		<div class="form-section">
			<a onclick="showForm('sal')">
				<h6 id="sal_subt" class="title3">Variaciones salariales</h6>
				<p id="icn-sal" class="icn-sct"><i class="fa fa-plus fa-icon"></i></p>
			</a>
			<div id="div-sal" class="fila" style="display:none">
				<table id="tbl-variations" class="tablealumno" style="margin-bottom:10px">
					<thead>
						<th width="20%">F. Efectiva</th>
						<th width="20%">Tipo</th>
						<th width="20%">Sueldo inicial (PEN)</th>
						<th width="20%">Monto (PEN)</th>
						<th width="20%">Sueldo final (PEN)</th>
					</thead>
					<tbody>
						@foreach (Auth::user()->variations as $variation)
						<tr>
							<td><center>{{ Carbon\Carbon::parse($variation->start_at)->format('d/m/Y') }}</center></td>
							<td><center>{{ $variation->type }}</center></td>
							<td><center>{{ number_format($variation->before,2) }}</center></td>
							<td><center>{{ number_format($variation->amount,2) }}</center></td>
							<td><center>{{ number_format($variation->after,2) }}</center></td>
						</tr>
						@endforeach
					</tbody>			
				</table>
			</div>
		</div>
	</div>
</div>
<div class="fila">
	<div class="columna columna-1">
		<center>
		<button type="submit" class="btn-effie" onclick="document.getElementById('frm-profile').submit()"><i class="fa fa-save"></i>&nbsp;Guardar</button>
		<a href="{{ route('home') }}" class="btn-effie-inv"><i class="fa fa-home"></i>&nbsp;Ir al inicio</a>
		</center>
	</div>
</div>
<div class="fila">
	<div class="space"></div>
	<div class="columna columna-1">
		<p><i class="fa fa-info-circle fa-icon" aria-hidden="true"></i>&nbsp;<b>Importante</b>
		<ul>
			<li>(*) Campos obligatorios</li>
			<li>El tamaño máximo del nombre y apellidos es cincuenta (50) caracteres.</li>
			<li>El tamaño máximo de la dirección de domicilio es cien (100) caracteres.</li>
			<li>El tamaño máximo del nombre completo y parentesco del contacto de emergencia es cincuenta (50) caracteres.</li>
			<li>El tamaño máximo de la dirección del contacto de emergencia es cien (100) caracteres.</li>
		</ul></p>
	</div>
</div>
@endsection

@section('script')
<script src="{{ asset('js/users/dependents2.js') }}"></script>
<script src="{{ asset('js/users/variations2.js') }}"></script>
<script src="{{ asset('js/profile.js') }}"></script>
@endsection