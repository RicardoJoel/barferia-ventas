<div class="modal fade" id="mdl-new-cust" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">x</button>
                <h3 class="modal-title" id="modal-title">Nuevo cliente</h3>
            </div>
            <div class="modal-body" id="modal-body">
                <div class="fila">
                    <div class="columna columna-1">
                        <div class="span-fail" id="fail-div-form"><span id="fail-msg-form"></span></div>
                    </div>
                </div>
                <form method="POST" action="{{ route('customers.storeFromSale') }}" role="form" id="frm-customer">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="fila cust">
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
                                            <input type="text" id="code" disabled>
                                        </div>
                                        <div class="columna columna-3d">
                                            <p>Nombre*</p>
                                            <input type="text" name="name" id="name" maxlength="50" value="{{ old('name') }}" required>
                                        </div>
                                        <div class="columna columna-3d">
                                            <p>Apellido*</p>
                                            <input type="text" name="lastname" id="lastname" maxlength="50" value="{{ old('lastname') }}" required>
                                        </div>
                                        <div class="columna columna-5">
                                            <p>F. Nacimiento</p>
                                            <input type="date" name="birthdate" id="birthdate" value="{{ old('birthdate') }}" max="{{ Carbon\Carbon::today()->subYear(18)->toDateString() }}">
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
                            <div class="form-section cust">
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
                    @include('customers/loctable')
                    @include('customers/pets')
                    <div class="fila cust">
                        <div class="columna columna-1">
                            <p><i class="fa fa-info-circle fa-icon" aria-hidden="true"></i>&nbsp;<b>Importante</b>
                            <ul>
                                <li>(*) Campos obligatorios</li>
                                <li>El correo electrónico es único y tiene un tamaño máximo de cincuenta (50) caracteres.</li>
                                <li>El tamaño máximo del nombre y apellido del cliente es cincuenta (50) caracteres.</li>
                                <li>El tamaño máximo de la dirección y la referencia es cien (100) caracteres.</li>
                                <li>El tamaño máximo del nombre de la mascota es cincuenta (50) caracteres.</li>
                            </ul></p>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <center>
                <button type="submit" class="btn-effie cust" id="btn-submit"><i class="fa fa-save"></i>&nbsp;Registrar</button>
                <button class="btn-effie-inv cust" data-dismiss="modal" onclick="$('#mdl-sch-cust').modal('show');"><i class="fa fa-reply"></i>&nbsp;Atrás</button>
                <button class="btn-effie ubic" data-dismiss="modal" onclick="passLocation()"  style="display:none">Aceptar</button>
                <button class="btn-effie-inv" data-dismiss="modal">Cerrar</button>
                </center>
            </div>
        </div>
    </div>
</div>