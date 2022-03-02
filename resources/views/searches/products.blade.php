<div class="modal fade" id="mdl-sch-prod" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">x</button>
                <h3 class="modal-title">Búsqueda de productos</h3>
            </div>
            <div class="modal-body">
                <div class="fila">
                    <div class="columna columna-1">
                        <div class="span-fail" id="fail-div-prod"><span id="fail-msg-prod"></span></div>
                    </div>
                </div>
                <form method="GET" action="{{ route('products.searchByFilter') }}" id="frm-sch-prod">
                    <div class="fila">
                        <div class="columna columna-6">
                            <p>Código</p>
                            <input type="text" name="prod_code" id="prod_code" maxlength="8" onkeypress="return checkAlNum(event)">
                        </div>
                        <div class="columna columna-3">
                            <p>Nombre</p>
                            <input type="text" name="prod_name" id="prod_name" maxlength="50" onkeypress="return checkName(event)">
                        </div>
                        <div class="columna columna-2">
                            <p>Descripción</p>
                            <input type="text" name="prod_desc" id="prod_desc" maxlength="50">
                        </div>
                    </div>
                    <div class="space"></div>
                    <div class="fila">
                        <center>
                        <button type="submit" class="btn-effie"><i class="fa fa-search"></i>&nbsp;{{ __('Buscar') }}</button>
                        <a onclick="clearFormProd()" class="btn-effie-inv"><i class="fa fa-paint-brush"></i>&nbsp;{{ __('Limpiar') }}</a>
                        </center>
                    </div>
                </form>
                <div class="space"></div>
                <div class="fila">
                    <h6 class="title3">Resultado de la búsqueda</h6>
                </div>
                <div class="fila">
                    <table id="tbl-products" class="tablealumno" style="width:100%">
                        <thead>
                            <th width="10%">Código</th> 
                            <th width="30%">Nombre</th>    
                            <th width="40%">Descripción</th>
                            <th width="10%">Stock</th>
                            <th width="10%">Precio</th>
                            <th></th>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <center><button class="btn-effie-inv" data-dismiss="modal">Cerrar</button></center>
            </div>
        </div>
    </div>
</div>