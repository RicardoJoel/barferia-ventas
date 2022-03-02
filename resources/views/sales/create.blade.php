@extends('layouts.app')
@section('content')
<div class="fila">
	<div class="columna columna-1">
		<div class="title2">
			<h6>Procesos > Ventas > Nueva ></h6>
		</div>
	</div>
</div>
<form method="POST" action="{{ route('sales.store') }}" role="form" id="frm-sale">
	@csrf
	<input type="hidden" name="customer_id" id="customer_id" value="{{ old('customer_id') }}">
	<input type="hidden" name="location_id" id="location_id" value="{{ old('location_id') }}">
	<input type="hidden" name="payment_method_id" id="payment_method_id" value="{{ old('payment_method_id') }}">
	<input type="hidden" name="other_ubigeo" id="other_ubigeo" value="{{ old('ubigeo') }}">
	<input type="hidden" name="latitude" id="latitude" value="{{ old('latitude') }}">
	<input type="hidden" name="longitude" id="longitude" value="{{ old('longitude') }}">
	<input type="hidden" name="discount" id="discount" value="{{ old('discount',0) }}">
	<input type="hidden" name="paidout" id="paidout" value="{{ old('paidout',0) }}">
	<input type="hidden" name="delivery" id="delivery" value="{{ old('delivery',0) }}">
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
							<p>Código único :</p>
						</div>
						<div class="columna columna-5">
							<input type="text" readonly>
						</div>
						<div class="columna columna-5">
							<p>Fecha hora de venta* :</p>
						</div>
						<div class="columna columna-5">
							<input type="datetime-local" name="happened_at" id="happened_at" value="{{ old('happened_at',Carbon\Carbon::now()->format('Y-m-d\TH:i')) }}" max="{{ Carbon\Carbon::now()->format('Y-m-d\TH:i') }}" required>
						</div>
						<div class="columna columna-5">
							<select name="status" id="status" required>
                                <option value="PENDIENTE" {{ old('status') == 'PENDIENTE' ? 'selected' : '' }}>PENDIENTE</option>
                                <option value="PAGADA" {{ old('status') == 'PAGADA' ? 'selected' : '' }}>PAGADA</option>
                                <option value="RECHAZADA" {{ old('status') == 'RECHAZADA' ? 'selected' : '' }}>RECHAZADA</option>
                                <option value="REEMBOLSADA" {{ old('status') == 'REEMBOLSADA' ? 'selected' : '' }}>REEMBOLSADA</option>
                                <option value="REINTENTANDO COBRO" {{ old('status') == 'REINTENTANDO COBRO' ? 'selected' : '' }}>REINTENTANDO COBRO</option>
                                <option value="IMPAGA" {{ old('status') == 'IMPAGA' ? 'selected' : '' }}>IMPAGA</option>
							</select>
						</div>
					</div>
					<div class="fila">
                        <div class="columna columna-1">
                            <div class="span-fail" id="customer_fail_div"><p id="customer_fail_msg"></p></div>
                        </div>
                    </div>
					<div class="fila">
						<div class="columna columna-5">
							<p>Datos del cliente :</p>
						</div>
						<div class="columna columna-5">
							<div class="search_field">
								<input type="text" name="customer_doc" id="customer_doc" value="{{ old('customer_doc') }}" maxlength="15" placeholder="N° Documento*" required>
								<a onclick="clearDataCust()"><i class="fa fa-close fa-icon" title="Borrar entrada"></i></a>
							</div>
						</div>
						<div class="columna columna-5">
							<input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name') }}" placeholder=" -- Nombres* -- " required>
						</div>	
						<div class="columna columna-5">
							<input type="text" name="customer_lastname" id="customer_lastname" value="{{ old('customer_lastname') }}" placeholder=" -- Apellidos* -- " required>
						</div>
						<div class="columna columna-5">
							<button type="button" id="btn-sch-cust" class="btn-effie-inv" style="width:100%"><i class="fa fa-search"></i>&nbsp;Buscar cliente</button>
						</div>
					</div>
					<div class="fila">
						<div class="columna columna-5">
							<p>Datos de contacto :</p>
						</div>
						<div class="columna columna-5">
							<div class="search_field">
								<input type="text" name="customer_mobile" id="customer_mobile" value="{{ old('customer_mobile') }}" maxlength="11" placeholder="N° Celular*" onkeypress="return checkNumber(event)" required>
								<a onclick="clearDataCust()"><i class="fa fa-close fa-icon" title="Borrar entrada"></i></a>
							</div>
						</div>
						<div class="columna columna-5d">
							<input type="text" name="customer_email" id="customer_email" value="{{ old('customer_email') }}" placeholder=" -- Correo electrónico -- ">
						</div>
						<div class="columna columna-5">
							<input type="text" name="customer_phone" id="customer_phone" value="{{ old('customer_phone') }}" maxlength="11" placeholder=" -- Teléfono fijo -- " onkeypress="return checkNumber(event)">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="fila">
		<div class="columna columna-1">
			<div class="form-section">
				<a onclick="showForm('env')">
					<h6 id="env_subt" class="title3">Entrega</h6>
					<p id="icn-env" class="icn-sct"><i class="fa fa-minus fa-icon"></i></p>
				</a>
				<div id="div-env">
					<div class="fila">
                        <div class="columna columna-1">
                            <div class="span-fail" id="center-fail-div"><p id="center-fail-msg"></p></div>
                        </div>
                    </div>
					<div class="fila">
						<div class="columna columna-5">
							<p>Fecha solicitada</p>
							<input type="date" name="requested_at" id="requested_at" value="{{ old('requested_at',Carbon\Carbon::today()->format('Y-m-d')) }}">
						</div>
						<div class="columna columna-5">
							<p>Rango de horas</p>
							<div class="fila">
								<input type="time" name="ini_hour" id="ini_hour" value="{{ old('ini_hour') }}" style="width:50%;border-right:none;border-top-right-radius:0;border-bottom-right-radius:0">
								<input type="time" name="end_hour" id="end_hour" value="{{ old('end_hour') }}" style="width:50%;border-left:none;border-top-left-radius:0;border-bottom-left-radius:0">
							</div>
						</div>
						<div class="columna columna-5f">
							<p>Dirección destino</p>
							<div class="search_field">
								<input type="text" name="address" id="address" value="{{ old('address') }}" maxlength="100" readonly>
								<a class="fa-icon" onclick="showModalLoc()"><i class="fa fa-map-marker" title="Ubicar en el mapa"></i>&nbsp;Ubicar</a>
							</div>
						</div>
					</div>
					<div class="fila">
						<div class="columna columna-5d">
							<p>Ubicación destino</p>
							<input type="text" name="ubigeo" id="ubigeo" value="{{ old('ubigeo') }}" maxlength="100" readonly>
						</div>
						<div class="columna columna-5f">
							<p>Referencia, N°, Mz., Lote y/o Interior</p>
							<input type="text" name="reference" id="reference" value="{{ old('reference') }}" maxlength="100" readonly>
						</div>
					</div>
					<div class="fila">
						<div class="columna columna-5d">
							<p>Local de distribución*</p>
							<div class="search_field">
								@inject('centers','App\Services\Centers')
								<select name="center_id" id="center_id" required>
									<option selected disabled hidden value="">Selecciona un local</option>
									@foreach ($centers->getByType('T') as $index => $center)
									<option value="{{ $index }}" {{ old('center_id') == $index ? 'selected' : '' }}>{{ $center }}</option>
									@endforeach
								</select>								
								<a class="fa-icon" onclick="showModalStock()"><i class="fa fa-cubes" title="Revisar el stock actual"></i>&nbsp;Stock</a>
							</div>
						</div>
						<div class="columna columna-5d">
							<p>Encargado de tienda</p>
							<input type="text" name="center_manager" id="center_manager" value="{{ old('center_manager') }}" readonly>
						</div>
						<div class="columna columna-5">
							<p>Celular de contacto</p>
							<input type="text" name="center_mobile" id="center_mobile" value="{{ old('center_mobile') }}" readonly>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
@include('sales/details')
<div class="fila">
	<div class="columna columna-1">
		<div class="form-section">
			<a onclick="showForm('pay')">
				<h6 id="pay_subt" class="title3">Resumen</h6>
				<p id="icn-pay" class="icn-sct"><i class="fa fa-minus fa-icon"></i></p>
			</a>
			<div id="div-pay">
				<div class="fila">
					<div class="columna columna-8">
						<p>Total venta (PEN)</p>
						<input type="text" id="aux_total" value="0.00" readonly>
					</div>
					<div class="columna columna-8">
						<p>Descuento (PEN)</p>
						<input type="number" id="aux_discount" value="0.00" min="0" step="any">
					</div>
					<div class="columna columna-8">
						<p>Adelanto (PEN)</p>
						<input type="number" id="aux_paidout" value="0.00" min="0" step="any">
					</div>
					<div class="columna columna-8">
						<p>Total final (PEN)</p>
						<input type="text" id="aux_debt" value="0.00" readonly>
					</div>
					<div class="columna columna-8">
						<p>Costo envío (PEN)</p>
						<input type="number" id="aux_delivery" value="0.00" min="0" step="any">
					</div>
					<div class="columna columna-8">
						<p>Total + envío (PEN)</p>
						<input type="text" id="aux_debt_deliv" value="0.00" readonly>
					</div>
					<div class="columna columna-4">
						<p>Método de pago<br>&nbsp;</p>
						@inject('methods','App\Services\PaymentMethods')
						<select name="aux_method_id" id="aux_method_id">
							@foreach ($methods->get() as $index => $method)
							<option value="{{ $index }}" {{ old('aux_method_id') == $index ? 'selected' : '' }}>
								{{ $method }}
							</option>
							@endforeach
						</select>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@include('sales/submit')
@endsection