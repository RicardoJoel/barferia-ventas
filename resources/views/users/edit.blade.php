@extends('layouts.app')
@section('content')
<div class="fila">
	<div class="columna columna-1">
		<div class="title2">
			<h6>Entidades > Usuarios > Editar ></h6>
		</div>
	</div>
</div>
<form method="POST" action="{{ route('users.update',$user->id) }}" role="form" id="frm-user">
	@csrf
	<input type="hidden" name="_method" id="_method" value="PATCH">
	<input type="hidden" id="other_ubigeo" value="{{ old('ubigeo',$user->other_ubigeo) }}">
	<input type="hidden" id="contact_other_ubigeo" value="{{ old('contact_ubigeo',$user->contact_other_ubigeo) }}">
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
							<p>Usuario</p>
							<input type="text" name="code" id="code" value="{{ old('code',$user->code) }}" disabled>
						</div>
						<div class="columna columna-3d">
							<p>Nombres*</p>
							<input type="text" name="name" id="name" maxlength="50" value="{{ old('name',$user->name) }}" onkeypress="return checkName(event)" required>
						</div>
						<div class="columna columna-3d">
							<p>Apellidos*</p>
							<input type="text" name="lastname" id="lastname" maxlength="50" value="{{ old('lastname',$user->lastname) }}" onkeypress="return checkName(event)" required>
						</div>
						<div class="columna columna-5">
							<p>F. Nacimiento*</p>
							<input type="date" name="birthdate" id="birthdate" value="{{ old('birthdate',$user->birthdate) }}" max="{{ Carbon\Carbon::today()->subYear(18)->toDateString() }}" required>
						</div>
					</div>
					<div class="fila">
						<div class="columna columna-3">
							<p>Tipo de documento*</p>
							@inject('documentTypes','App\Services\DocumentTypes')
							<select name="document_type_id" id="document_type_id" required>
								<option selected disabled hidden value="">Selecciona un tipo de documento</option>
								@foreach ($documentTypes->get() as $index => $documentType)
								<option value="{{ $index }}" {{ old('document_type_id',$user->document_type_id) == $index ? 'selected' : '' }}>
									{{ $documentType['name'] }}
								</option>
								@endforeach
							</select>
						</div>
						<div class="columna columna-6">
							<p>N° Documento*</p>
							<input type="hidden" name="doc_pattern" id="doc_pattern" value="{{ old('doc_pattern') }}">
							<input type="text" name="document" id="document" value="{{ old('document',$user->document) }}" onkeyup="return mayusculas(this)" disabled required>
						</div>
						<div class="columna columna-6">
							<p>Género*</p>
							@inject('genders','App\Services\Genders')
							<select name="gender_id" id="gender_id" required>
								<option selected disabled hidden value="">Selecciona</option>
								@foreach ($genders->get() as $index => $gender)
								<option value="{{ $index }}" {{ old('gender_id',$user->gender_id) == $index ? 'selected' : '' }}>
									{{ $gender }}
								</option>
								@endforeach
							</select>					
						</div>
						<div class="columna columna-3">
							<p>Correo electrónico institucional*</p>
							<input type="email" name="email" id="email" maxlength="50" value="{{ old('email',$user->email) }}" onkeypress="return checkEmail(event)" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2, 4}$" required>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="fila">
		<div class="space"></div>
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
							<input type="text" name="address" id="address" maxlength="100" value="{{ old('address',$user->address) }}" required>
						</div>
						<div class="columna columna-2">
							<p>Departamento / Provincia / Distrito de domicilio*</p>
							@inject('ubigeos','App\Services\Ubigeos')
							<select name="ubigeo" id="ubigeo" required>
								@foreach ($ubigeos->get() as $index => $ubigeo)
								<option value="{{ $index }}" {{ old('ubigeo',$user->ubigeo_id) == $index ? 'selected' : '' }}>{{ $ubigeo }}</option>
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
								<option value="{{ $index }}" {{ old('country_id',$user->country_id ?? 164) == $index ? 'selected' : '' }}>{{ $country }}</option>
								@endforeach
							</select>
						</div>
						<div class="columna columna-6">
							<p>Celular*</p>
							<input type="tel" name="mobile" id="mobile" maxlength="17" value="{{ old('mobile',$user->mobile) }}" onkeypress="return checkNumber(event)" pattern="[0-9]{3} [0-9]{3} [0-9]{3}" required>
						</div>
						<div class="columna columna-6">
							<p>Teléfono fijo</p>
							<input type="tel" name="phone" id="phone" maxlength="11" value="{{ old('phone',$user->phone) }}" onkeypress="return checkNumber(event)" pattern="[0-9]{2} [0-9]{3} [0-9]{4}">
						</div>
						<div class="columna columna-6">
							<p>Anexo</p>
							<input type="tel" name="annex" id="annex" maxlength="6" value="{{ old('annex',$user->annex) }}" onkeypress="return checkNumber(event)" pattern="[0-9]{4,6}">
						</div>
						<div class="columna columna-3">
							<p>Correo electrónico personal</p>
							<input type="email" name="alt_email" id="alt_email" maxlength="50" value="{{ old('alt_email',$user->alt_email) }}" onkeypress="return checkEmail(event)" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="fila">
		<div class="space"></div>
        <div class="columna columna-1">
			<div class="form-section">
				<a onclick="showForm('lab')">
					<h6 id="lab_subt" class="title3">Laboral</h6>
					<p id="icn-lab" class="icn-sct"><i class="fa fa-minus fa-icon"></i></p>
				</a>
				<div id="div-lab">
					<div class="fila">
						<div class="columna columna-5">
							<p>Vínculo laboral*</p>
							@inject('relationships','App\Services\Relationships')
							<select name="relationship_id" id="relationship_id" required>
								<option selected disabled hidden value="">Selecciona</option>
								@foreach ($relationships->get() as $index => $relationship)
								<option value="{{ $index }}" {{ old('relationship_id',$user->relationship_id) == $index ? 'selected' : '' }}>
									{{ $relationship }}
								</option>
								@endforeach
							</select>
						</div>
						<div class="columna columna-5d">
							<p>Cargo*</p>
							@inject('profiles','App\Services\Profiles')
							<select name="profile_id" id="profile_id" required>
								<option selected disabled hidden value="">Selecciona un cargo</option>
								@foreach ($profiles->get('C') as $index => $profile)
								<option value="{{ $index }}" {{ old('profile_id',$user->profile_id) == $index ? 'selected' : '' }}>
									{{ $profile }}
								</option>
								@endforeach
							</select>
						</div>
						<div class="columna columna-5d">
							<p>Tienda / Centro de producción</p>
							@inject('centers','App\Services\Centers')
							<select name="center_id" id="center_id" disabled>
								<option selected disabled hidden value="">Selecciona una tienda / centro de producción</option>
								@foreach ($centers->get() as $index => $center)
								<option value="{{ $index }}" {{ old('center_id',$user->center_id) == $index ? 'selected' : '' }}>
									{{ $center }}
								</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="fila">
						<div class="columna columna-5">
							<p>Sueldo bruto (PEN)</p>
							<input type="text" value="{{ number_format($user->cur_salary,2) }}" min="0" disabled>
						</div>
						<div class="columna columna-5">
							<p>Comisión (%)</p>
							<input type="number" name="commission" id="commission" value="{{ old('commission',number_format($user->commission,2)) }}" min="0" onkeypress="return checkNumber(event)">
						</div>
						<div class="columna columna-5">
							<p>Variación salarial</p>
							@inject('frequencies','App\Services\Frequencies')
							<select name="frequency_id" id="frequency_id" required>
								@foreach ($frequencies->get() as $index => $frequency)
								<option value="{{ $index }}" {{ old('frequency_id',$user->frequency_id) == $index ? 'selected' : '' }}>
									{{ $frequency }}
								</option>
								@endforeach
							</select>
						</div>
						<div class="columna columna-5">
							<p>Fecha de inicio</p>
							<input type="date" name="start_at" id="start_at" value="{{ old('start_at',$user->start_at) }}">
						</div>
						<div class="columna columna-5">
							<p>Fecha de cese</p>
							<input type="date" name="end_at" id="end_at" value="{{ old('end_at',$user->end_at) }}" max="{{ Carbon\Carbon::today()->toDateString() }}">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="fila">
		<div class="space"></div>
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
							@inject('banks','App\Services\Banks')
							<select name="bank_id" id="bank_id">
								<option selected disabled hidden value="">Selecciona una entidad bancaria</option>
								@foreach ($banks->get() as $index => $bank)
								<option value="{{ $index }}" {{ old('bank_id',$user->bank_id) == $index ? 'selected' : '' }}>
									{{ $bank }}
								</option>
								@endforeach
							</select>
						</div>
						<div class="columna columna-3">
							<p>N° Cuenta Sueldo</p>
							<input type="text" name="bank_account" id="bank_account" maxlength="20" value="{{ old('bank_account',$user->bank_account) }}" onkeypress="return checkNumber(event)" disabled>
						</div>
						<div class="columna columna-3">
							<p>Código de Cuenta Interbancario (CCI)</p>
							<input type="text" name="cci" id="cci" maxlength="23" value="{{ old('cci',$user->cci) }}" onkeypress="return checkNumber(event)" disabled>
						</div>
					</div>
					<div class="fila">
						<div class="columna columna-3">
							<p>Adm. Fondo de pensiones (AFP) / ONP</p>
							@inject('afps','App\Services\AFPs')
							<select name="afp_id" id="afp_id">
								<option selected value="">No cuenta con AFP / ONP</option>
								@foreach ($afps->get() as $index => $afp)
								<option value="{{ $index }}" {{ old('afp_id',$user->afp_id) == $index ? 'selected' : '' }}>
									{{ $afp }}
								</option>
								@endforeach
							</select>
						</div>
						<div class="columna columna-3">
							<p>Tipo de comisión</p>
							@inject('commissions','App\Services\Commissions')
							<select name="commission_id" id="commission_id" disabled>
								<option selected disabled hidden value="">Selecciona un tipo de comisión</option>
								@foreach ($commissions->get() as $index => $commission)
								<option value="{{ $index }}" {{ old('commission_id',$user->commission_id) == $index ? 'selected' : '' }}>
									{{ $commission }}
								</option>
								@endforeach
							</select>
						</div>
						<div class="columna columna-3">
							<p>Código CUSPP</p>
							<input type="text" name="cuspp" id="cuspp" maxlength="12" value="{{ old('cuspp',$user->cuspp) }}" onkeypress="return checkAlNum(event)" onkeyup="return mayusculas(this)" disabled>
						</div>
					</div>
					<div class="fila">
						<div class="columna columna-3">
							<p>Entidad bancaria CTS</p>
							@inject('banks','App\Services\Banks')
							<select name="cts_id" id="cts_id">
								<option selected value="">No cuenta con CTS</option>
								@foreach ($banks->get() as $index => $bank)
								<option value="{{ $index }}" {{ old('cts_id',$user->cts_id) == $index ? 'selected' : '' }}>
									{{ $bank }}
								</option>
								@endforeach
							</select>
						</div>
						<div class="columna columna-3">
							<p>N° Cuenta CTS</p>
							<input type="text" name="cts_account" id="cts_account" maxlength="20" value="{{ old('cts_account',$user->cts_account) }}" onkeypress="return checkNumber(event)" disabled>
						</div>
					</div>
					<div class="fila">
						<div class="columna columna-3">
							<p>Plan EPS</p>
							@inject('epss','App\Services\EPSs')
							<select name="eps_id" id="eps_id">
								<option selected value="">No cuenta con EPS</option>
								@foreach ($epss->get() as $index => $eps)
								<option value="{{ $index }}" {{ old('eps_id',$user->eps_id) == $index ? 'selected' : '' }}>
									{{ $eps }}
								</option>
								@endforeach
							</select>
						</div>
						<div class="columna columna-3">
							<p>Código Essalud</p>
							<input type="text" name="essalud" id="essalud" maxlength="15" value="{{ old('essalud',$user->essalud) }}" onkeypress="return checkAlNum(event)" onkeyup="return mayusculas(this)">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="fila">
		<div class="space"></div>
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
							<input type="text" name="contact_fullname" id="contact_fullname" maxlength="50" value="{{ old('contact_fullname',$user->contact_fullname) }}" onkeypress="return checkName(event)">
						</div>
						<div class="columna columna-3">
							<p>Parentesco</p>
							<input type="text" name="contact_relationship" id="contact_relationship" maxlength="50" value="{{ old('contact_relationship',$user->contact_relationship) }}" onkeypress="return checkName(event)">
						</div>
						<div class="columna columna-3">
							<p>Dirección</p>
							<input type="text" name="contact_address" id="contact_address" maxlength="100" value="{{ old('contact_address',$user->contact_address) }}">
						</div>
					</div>
					<div class="fila">
						<div class="columna columna-3">
							<p>Departamento / Provincia / Distrito</p>
							@inject('ubigeos','App\Services\Ubigeos')
							<select name="contact_ubigeo" id="contact_ubigeo">
								@foreach ($ubigeos->get() as $index => $ubigeo)
								<option value="{{ $index }}" {{ old('contact_ubigeo',$user->contact_ubigeo_id) == $index ? 'selected' : '' }}>{{ $ubigeo }}</option>
								@endforeach
							</select>
						</div>
						<div class="columna columna-6">
							<p>Código país</p>
							@inject('countries','App\Services\Countries')
							<select name="contact_country_id" id="contact_country_id">
								<option selected disabled hidden value="">Selecciona un país</option>
								@foreach ($countries->get() as $index => $country)
								<option value="{{ $index }}" {{ old('contact_country_id',$user->contact_country_id ?? 164) == $index ? 'selected' : '' }}>{{ $country }}</option>
								@endforeach
							</select>
						</div>
						<div class="columna columna-6">
							<p>Celular</p>
							<input type="tel" name="contact_mobile" id="contact_mobile" maxlength="11" value="{{ old('contact_mobile',$user->contact_mobile) }}" onkeypress="return checkNumber(event)" pattern="[0-9]{3} [0-9]{3} [0-9]{3}">
						</div>
						<div class="columna columna-6">
							<p>Teléfono fijo</p>
							<input type="tel" name="contact_phone" id="contact_phone" maxlength="11" value="{{ old('contact_phone',$user->contact_phone) }}" onkeypress="return checkNumber(event)" pattern="[0-9]{2} [0-9]{3} [0-9]{4}">
						</div>
						<div class="columna columna-6">
							<p>Anexo</p>
							<input type="tel" name="contact_annex" id="contact_annex" maxlength="6" value="{{ old('contact_annex',$user->contact_annex) }}" onkeypress="return checkNumber(event)" pattern="[0-9]{4,6}">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
@include('users/dependent')
@include('users/variation')
@include('users/submit')
@endsection