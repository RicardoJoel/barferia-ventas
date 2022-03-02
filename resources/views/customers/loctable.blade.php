<div class="fila cust">
	<div class="columna columna-1">
        <div class="form-section">
            <a onclick="showForm('lst')">
                <h6 id="lst_subt" class="title3">Lugares de entrega</h6>
                <p id="icn-lst" class="icn-sct"><i class="fa fa-minus fa-icon"></i></p>
            </a>
            <div id="div-lst">
                <table id="tbl-locations" class="tablealumno" style="margin-bottom:10px">
                    <thead>
                        <th width="35%">Dirección</th>
                        <th width="35%">Ubicación</th>
                        <th width="20%">Referencia</th>
                        <th width="5%">Editar</th>
                        <th width="5%">Borrar</th>
                    </thead>
                    <tbody>
                        @foreach ($locations as $index => $location)
                        <tr>
                            <td>{{ $location['address'] }}</td>
                            <td>{{ $location['ubigeo'] }}</td>
                            <td>{{ $location['ref'] }}</td>
                            <td><center><a name="{{ $index }}" onclick="editLoc(this)"><i class="fa fa-edit"></i></a></center></td>
                            <td><center><a name="{{ $index }}" onclick="removeLoc(this)"><i class="fa fa-trash"></i></a></center></td>
                        </tr>
                        @endforeach
                    </tbody>			
                </table>
            </div>
        </div>
    </div>
</div>