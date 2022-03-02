<div class="form-section">
    <a onclick="showForm('loc')">
        <h6 id="loc_subt" class="title3">Nuevo lugar de entrega</h6>
        <p id="icn-loc" class="icn-sct"><i class="fa fa-minus fa-icon"></i></p>
    </a>
    <div id="div-loc">
        <div class="fila">
            <div class="columna columna-1">
                <div class="span-fail" id="loc_fail_div"><span id="loc_fail_msg"></span></div>
            </div>
        </div>
        <form method="POST" action="{{ action('LocationController@store') }}" role="form" id="loc_form">
            @csrf
            <input type="hidden" name="_method" id="loc_method">
            <input type="hidden" name="loc_id" id="loc_id" value="{{ old('loc_id') }}">
            <input type="hidden" name="loc_lat" id="loc_lat" value="{{ old('loc_lat') }}">
            <input type="hidden" name="loc_lng" id="loc_lng" value="{{ old('loc_lng') }}">
            <div class="fila">
                <div class="columna columna-1">
                    <p>Dirección*</p>
                    <input type="text" name="loc_address" id="loc_address" value="{{ old('loc_address') }}" maxlength="100" class="controls" placeholder="" required>
                </div>
                <div class="columna columna-1">
                    <p>Ubicación*</p>
                    @inject('ubigeos','App\Services\Ubigeos')
                    <select name="loc_ubigeo" id="loc_ubigeo" required>
                        @foreach ($ubigeos->get() as $index => $ubigeo)
                        <option value="{{ $index }}" {{ old('loc_ubigeo') == $index ? 'selected' : '' }}>{{ $ubigeo }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="columna columna-1">
                    <p>Referencia, N°, Mz., Lote y/o Interior</p>
                    <input type="text" name="loc_ref" id="loc_ref" value="{{ old('loc_ref') }}" maxlength="100">
                </div>
            </div>
            <div class="fila" style="margin-top:5px">
                <div class="columna columna-1">
                    <center>
                    <button id="loc_submit" type="submit" class="btn-effie cust"><i class="fa fa-plus"></i>&nbsp;Agregar</button>
                    <a onclick="clearFormLoc();" class="btn-effie-inv cust"><i class="fa fa-paint-brush"></i>&nbsp;Limpiar</a>
                    </center>
                </div>
            </div>
        </form>
        <div style="height:14px"></div>
    </div>
</div>