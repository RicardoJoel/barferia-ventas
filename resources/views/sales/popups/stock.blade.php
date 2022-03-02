<div class="modal fade" id="mdl-stock" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">x</button>
                <h3 id="stock-title"></h3>
            </div>
            <div class="modal-body">
                <div class="fila">
                    <p>En el siguiente cuadro, podrás revisar el stock actual de productos en la tienda seleccionada.</p>
                </div>
                <div class="fila">
                    <div class="space"></div>
                    <table id="tbl-stock" class="tablealumno tbl-details" style="width:100%">
                        <thead>
                            <th width="40%">Producto</th>
                            <th width="40%">Código</th>
                            <th width="20%">Cantidad</th>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <center>
                <button class="btn-effie" onclick="refreshStock()"><i class="fa fa-refresh"></i>&nbsp;Actualizar</button>	
                <button class="btn-effie-inv" data-dismiss="modal">Cerrar</button>	
                </center>
            </div>
        </div>
    </div>
</div>