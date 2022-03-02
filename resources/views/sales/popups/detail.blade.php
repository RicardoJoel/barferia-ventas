<div class="modal fade" id="mdl-detail" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">x</button>
                <h3 class="modal-title">Detalle de venta</h3>
            </div>
            <div class="modal-body">
                <div class="fila">
                    <p><b>Nombre y código: </b><label id="txt-detail-name"></label></p>
                    <!--p><b>Código: </b><label id="txt-detail-code"></label></p-->
                    <p id="div-items"><b>Incluye: </b> <label id="txt-detail-items"></label> unidad(es)</p>
                    <p><b>Precio: </b>S/ <label id="txt-detail-price"></label></p>
                    <p><b>Cantidad: </b> <label id="txt-detail-quantity"></label></p>
                    <p><b>Subtotal: </b>S/ <label id="txt-detail-subtotal"></label></p>
                </div>
                <div class="fila" id="div-choices">
                    <div class="space"></div>
                    <table id="tbl-detail-choices" class="tablealumno tbl-details" style="width:100%">
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
                <button id="btn-detail-acept" class="btn-effie" data-dismiss="modal"></i>&nbsp;Aceptar</button>	
                </center>
            </div>
        </div>
    </div>
</div>