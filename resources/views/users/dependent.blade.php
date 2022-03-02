<div class="fila">
    <div class="space"></div>
    <div class="columna columna-1">
        <div class="form-section">
            <a onclick="showForm('dep')">
                <h6 id="dep_subt" class="title3">Dependientes</h6>
                <p id="icn-dep" class="icn-sct"><i class="fa fa-plus fa-icon"></i></p>
            </a>
            <div id="div-dep" style="display:none">
                <div class="fila">
                    <div class="columna columna-1">
                        <div class="span-fail" id="dependent_fail_div"><span id="dependent_fail_msg"></span></div>
                    </div>
                </div>
                <form method="POST" action="{{ action('DependentController@store') }}" role="form" id="dependent_form">
                    @csrf
                    <input type="hidden" name="_method" id="dependent_method">
                    <input type="hidden" name="dependent_id" id="dependent_id" value="{{ old('dependent_id') }}">
                    <div class="fila">
                        <div class="columna columna-3">
                            <p>Nombres*</p>
                            <input type="text" name="dependent_name" id="dependent_name" maxlength="50" value="{{ old('dependent_name') }}" onkeypress="return checkName(event)" required>
                        </div>
                        <div class="columna columna-3">
                            <p>Apellidos*</p>
                            <input type="text" name="dependent_lastname" id="dependent_lastname" maxlength="50" value="{{ old('dependent_lastname') }}" onkeypress="return checkName(event)" required>
                        </div>
                        <div class="columna columna-3">
                            <p>Vínculo familiar*</p>
                            @inject('dependentTypes','App\Services\DependentTypes')
                            <select name="dependent_type_id" id="dependent_type_id" required>
                                <option selected disabled hidden value="">Selecciona un vínculo familiar</option>
                                @foreach ($dependentTypes->get() as $index => $dependentType)
                                <option value="{{ $index }}" {{ old('dependent_type_id') == $index ? 'selected' : '' }}>
                                    {{ $dependentType }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="fila" style="margin-bottom:5px">
                        <div class="columna columna-3">
                            <p>Tipo de documento*</p>
                            @inject('documentTypes','App\Services\DocumentTypes')
                            <select name="dependent_document_type_id" id="dependent_document_type_id" required>
                                <option selected disabled hidden value="">Selecciona un tipo de documento</option>
                                @foreach ($documentTypes->get() as $index => $documentType)
                                @if ($documentType['code'] !== '06')
                                <option value="{{ $index }}" {{ old('dependent_document_type_id') == $index ? 'selected' : '' }}>
                                    {{ $documentType['name'] }}
                                </option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="columna columna-6">
                            <p>N° Documento*</p>
                            <input type="hidden" name="dependent_doc_pattern" id="dependent_doc_pattern" value="{{ old('dependent_doc_pattern') }}">
                            <input type="text" name="dependent_document" id="dependent_document" value="{{ old('dependent_document') }}" onkeyup="return mayusculas(this)" disabled required>
                        </div>
                        <div class="columna columna-6">
                            <p>Género*</p>
                            @inject('genders','App\Services\Genders')
                            <select name="dependent_gender_id" id="dependent_gender_id" required>
                                <option selected disabled hidden value="">Selecciona</option>
                                @foreach ($genders->get() as $index => $gender)
                                <option value="{{ $index }}" {{ old('dependent_gender_id') == $index ? 'selected' : '' }}>
                                    {{ $gender }}
                                </option>
                                @endforeach
                            </select>					
                        </div>
                        <div class="columna columna-5">
                            <p>F. Nacimiento</p>
                            <input type="date" name="dependent_birthdate" id="dependent_birthdate" value="{{ old('dependent_birthdate') }}" max="{{ Carbon\Carbon::today()->toDateString() }}">
                        </div>
                    </div>
                    <div class="fila">
                        <div class="columna columna-1">
                            <center>
                            <button id="dependent_submit" type="submit" class="btn-effie"><i class="fa fa-plus"></i>&nbsp;Agregar</button>
                            <a onclick="clearForm()" class="btn-effie-inv"><i class="fa fa-paint-brush"></i>&nbsp;Limpiar</a>
                            </center>
                        </div>
                    </div>
                </form>
                <div class="space"></div>
                <table id="tbl-dependents" class="tablealumno" style="margin-bottom:10px">
                    <thead>
                        <th width="20%">Nombre completo</th>
                        <th width="20%">Vínculo</th>
                        <th width="20%">Tipo de documento</th>
                        <th width="10%">N° Documento</th>
                        <th width="10%">Género</th>
                        <th width="10%">F. Nacimiento</th>
                        <th width="5%">Editar</th>
                        <th width="5%">Borrar</th>
                    </thead>
                    <tbody>
                        @foreach ($dependents as $index => $dependent)
                        <tr>
                            <td>{{ $dependent['name'].', '.$dependent['lastname'] }}</td>
                            <td>{{ $dependent['type'] }}</td>
                            <td>{{ $dependent['document_type'] }}</td>
                            <td><center>{{ $dependent['document'] }}</center></td>
                            <td><center>{{ $dependent['gender'] }}</center></td>
                            <td><center>{{ Carbon\Carbon::parse($dependent['birthdate'])->format('d/m/Y') }}</center></td>
                            <td><center><a name="{{ $index }}" onclick="editDependent(this)"><i class="fa fa-edit"></i></a></center></td>
                            <td><center><a name="{{ $index }}" onclick="removeDependent(this)"><i class="fa fa-trash"></i></a></center></td>
                        </tr>
                        @endforeach
                    </tbody>			
                </table>
            </div>
        </div>
    </div>
</div>