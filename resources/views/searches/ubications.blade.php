<div class="modal fade" id="mdl-sch-ubic" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">x</button>
                <h3 class="modal-title">Lugares de entrega</h3>
            </div>
            <div class="modal-body">
                <div class="span-fail" id="fail-div-ubic"><span id="fail-msg-ubic"></span></div>
                <form method="GET" action="{{ route('locations.searchByFilter') }}" id="frm-sch-ubic">
                    <input type="hidden" id="ubic_cust_id" name="ubic_cust_id">
                    <input type="hidden" id="ubic_cust_doc">
                    <input type="hidden" id="ubic_cust_code">
                    <input type="hidden" id="ubic_cust_email">
                    <input type="hidden" id="ubic_cust_phone">
                    <input type="hidden" id="ubic_cust_mobile">
                    <input type="hidden" id="ubic_cust_name">
                    <input type="hidden" id="ubic_cust_lastname">
                    <div class="fila">
                        <div class="columna columna-3">
                            <p>Cliente</p>
                            <input type="text" id="ubic_cust_fullname" readonly>
                        </div>
                        <div class="columna columna-3">
                            <p>Dirección</p>
                            <input type="text" name="ubic_address" id="ubic_address" maxlength="50">
                        </div>
                        <div class="columna columna-3">
                            <p>Ubicación</p>
                            @inject('ubigeos','App\Services\Ubigeos')
							<select name="ubic_ubigeo" id="ubic_ubigeo">
								@foreach ($ubigeos->get() as $index => $ubigeo)
								<option value="{{ $index }}" {{ old('ubic_ubigeo') == $index ? 'selected' : '' }}>{{ $ubigeo }}</option>
								@endforeach
							</select>
                        </div>
                    </div>
                    <div class="fila">
                        <div class="space"></div>
                        <center>
                        <button type="submit" class="btn-effie"><i class="fa fa-search"></i>&nbsp;Buscar</button>
                        <a onclick="clearFormUbic()" class="btn-effie-inv"><i class="fa fa-paint-brush"></i>&nbsp;Limpiar</a>
                        </center>
                    </div>
                </form>
                <div class="fila">
                    <div class="space"></div>
                    <h6 class="title3">Resultados</h6>
                </div>
                <div class="fila">
                    <table id="tbl-ubications" class="tablealumno" style="width:100%">
                        <thead>
                            <th width="50%">Dirección</th>
                            <th width="25%">Ubicación</th>
                            <th width="25%">Referencia</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <center>
                <button class="btn-effie" data-dismiss="modal" onclick="sendOnlyCust()"><i class="fa fa-exclamation-triangle"></i>&nbsp;Omitir</button>
                <button class="btn-effie-inv" data-dismiss="modal" onclick="$('#mdl-sch-cust').modal('show');"><i class="fa fa-reply"></i>&nbsp;Atrás</button>
                <button class="btn-effie-inv" data-dismiss="modal">Cerrar</button>
                </center>
            </div>
        </div>
    </div>
</div>