<div class="modal fade" id="mdl-promo" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">x</button>
                <h3 class="modal-title">Detalle de promoción</h3>
            </div>
            <div class="modal-body">
                <div class="fila">
                    <p><b>Nombre y código: </b><label id="txt-promo-name"></label></p>
                    <!--p><b>Código: </b><label id="txt-promo-code"></label></p-->
                    <p><b>Incluye: </b> <label id="txt-promo-items"></label> unidad(es)</p>
                    <p><b>Precio: </b>S/ <label id="txt-promo-price"></label></p>
                </div>
                <div class="fila">
                    <div class="space"></div>
                    <table id="tbl-promo-choices" class="tablealumno tbl-details" style="width:100%">
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
                <button id="btn-promo-acept" class="btn-effie" data-dismiss="modal"></i>&nbsp;Aceptar</button>	
                </center>
            </div>
        </div>
    </div>
</div>