<div class="fila cust">
    <div class="columna columna-1">
        <div class="form-section">
            <a onclick="showForm('dep')">
                <h6 id="dep_subt" class="title3">Mascotas</h6>
                <p id="icn-dep" class="icn-sct"><i class="fa fa-minus fa-icon"></i></p>
            </a>
            <div id="div-dep">
                <div class="fila">
                    <div class="columna columna-1">
                        <div class="span-fail" id="pet_fail_div"><span id="pet_fail_msg"></span></div>
                    </div>
                </div>
                <form method="POST" action="{{ action('PetController@store') }}" role="form" id="pet_form">
                    @csrf
                    <input type="hidden" name="_method" id="pet_method">
                    <input type="hidden" name="pet_id" id="pet_id" value="{{ old('pet_id') }}">
                    <div class="fila">
                        <div class="columna columna-4">
                            <p>Nombre*</p>
                            <input type="text" name="pet_name" id="pet_name" maxlength="50" value="{{ old('pet_name') }}" onkeypress="return checkName(event)" required>
                        </div>
                        <div class="columna columna-8">
                            <p>Especie*</p>
                            <select name="pet_species" id="pet_species" required>
                                <option value="Perro" {{ old('pet_species') == 'Perro' ? 'selected' : '' }}>Perro</option>
                                <option value="Gato" {{ old('pet_species') == 'Gato' ? 'selected' : '' }}>Gato</option>
                            </select>
                        </div>
                        <div class="columna columna-8">
                            <p>Género*</p>
                            <select name="pet_gender" id="pet_gender" required>
                                <option value="Macho" {{ old('pet_gender') == 'Macho' ? 'selected' : '' }}>Macho</option>
                                <option value="Hembra" {{ old('pet_gender') == 'Hembra' ? 'selected' : '' }}>Hembra</option>
                            </select>
                        </div>
                        <div class="columna columna-4">
							<p>Raza*</p>
							@inject('races','App\Services\Races')
							<select name="pet_race" id="pet_race" required>
								@foreach ($races->get('P') as $index => $race)
								<option value="{{ $index }}" {{ old('pet_race') == $index ? 'selected' : '' }}>{{ $race }}</option>
								@endforeach
							</select>
						</div>
                        <div class="columna columna-4">
                            <p>F. Nacimiento</p>
                            <input type="date" name="pet_birthdate" id="pet_birthdate" value="{{ old('pet_birthdate') }}" max="{{ Carbon\Carbon::today()->toDateString() }}">
                        </div>
                    </div>
                    <div class="fila">
                        <div class="columna columna-1">
                            <p>Observaciones (p.e. Alergias)</p>
                            <textarea name="pet_observation" id="pet_observation" maxlength="500" rows="4">{{ old('pet_observation') }}</textarea>
                        </div>
                    </div>
                    <div class="fila" style="margin-top:5px">
                        <div class="columna columna-1">
                            <center>
                            <button id="pet_submit" type="submit" class="btn-effie"><i class="fa fa-plus"></i>&nbsp;Agregar</button>
                            <a onclick="clearFormPet()" class="btn-effie-inv"><i class="fa fa-paint-brush"></i>&nbsp;Limpiar</a>
                            </center>
                        </div>
                    </div>
                </form>
                <div class="space"></div>
                <table id="tbl-pets" class="tablealumno" style="margin-bottom:10px">
                    <thead>
                        <th width="15%">Nombre</th>
                        <th width="20%">Especie / Género</th>
                        <th width="20%">Raza</th>
                        <th width="10%">F. Nacimiento</th>
                        <th width="25%">Observaciones</th>
                        <th width="5%">Editar</th>
                        <th width="5%">Borrar</th>
                    </thead>
                    <tbody>
                        @foreach ($pets as $index => $pet)
                        <tr>
                            <td>{{ $pet['name'] }}</td>
                            <td><center>{{ $pet['species'].' / '.$pet['gender'] }}</center></td>
                            <td>{{ $pet['race'] }}</td>
                            <td><center>{{ $pet['birthdate'] ? Carbon\Carbon::parse($pet['birthdate'])->format('d/m/Y') : '' }}</center></td>
                            <td>{{ $pet['observation'] }}</td>
                            <td><center><a name="{{ $index }}" onclick="editPet(this)"><i class="fa fa-edit"></i></a></center></td>
                            <td><center><a name="{{ $index }}" onclick="removePet(this)"><i class="fa fa-trash"></i></a></center></td>
                        </tr>
                        @endforeach
                    </tbody>			
                </table>
            </div>
        </div>
    </div>
</div>