<div class="modal fade" id="mdl-sch-cust" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">x</button>
                <h3 class="modal-title">Búsqueda de clientes</h3>
            </div>
            <div class="modal-body">
                <div class="fila">
                    <div class="columna columna-1">
                        <div class="span-fail" id="fail-div-cust"><span id="fail-msg-cust"></span></div>
                        <div class="span-done" id="info-div-cust"><span id="info-msg-cust"></span></div>
                    </div>
                </div>
                <form method="GET" action="{{ route('customers.searchByFilter') }}" id="frm-sch-cust">
                    <div class="fila">
                        <div class="columna columna-6">
                            <p>Código</p>
                            <input type="text" name="cust_code" id="cust_code" maxlength="8" onkeypress="return checkAlNum(event)">
                        </div>
                        <div class="columna columna-3">
                            <p>Nombre</p>
                            <input type="text" name="cust_name" id="cust_name" maxlength="100" onkeypress="return checkName(event)">
                        </div>
                        <div class="columna columna-4">
                            <p>Documento</p>
                            <input type="text" name="cust_doc" id="cust_doc" maxlength="15" onkeypress="return checkAlNum(event)">
                        </div>
                        <div class="columna columna-4">
                            <p>Celular</p>
                            <input type="text" name="cust_mob" id="cust_mob" maxlength="11" onkeypress="return checkNumber(event)">
                        </div>
                    </div>
                    <div class="space"></div>
                    <div class="fila">
                        <center>
                        <button type="submit" class="btn-effie"><i class="fa fa-search"></i>&nbsp;{{ __('Buscar') }}</button>
                        <a onclick="clearFormCust()" class="btn-effie-inv"><i class="fa fa-paint-brush"></i>&nbsp;{{ __('Limpiar') }}</a>
                        </center>
                    </div>
                </form>
                <div class="space"></div>
                <div class="fila">
                    <h6 class="title3">Resultado</h6>
                </div>
                <div class="fila">
                    <table id="tbl-customers" class="tablealumno" style="width:100%">
                        <thead>
                            <th width="10%">Código</th>
                            <th width="20%">Nombre</th>  
                            <th width="20%">Documento</th>
                            <th width="20%">Celular</th>
                            <th width="20%">Correo electrónico</th>
                            <th width="5%">Editar</th>
                            <th></th>
                            <th></th>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <center>
                <button class="btn-effie" data-dismiss="modal" onclick="showModalCust()"><i class="fa fa-plus"></i>&nbsp;Nuevo</button>
                <button class="btn-effie-inv" data-dismiss="modal">Cerrar</button>
                </center>
            </div>
        </div>
    </div>
</div>