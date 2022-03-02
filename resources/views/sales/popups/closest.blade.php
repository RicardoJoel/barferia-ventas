<div class="modal fade" id="mdl-closest" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">x</button>
                <h3 class="modal-title">Local de distribución más cercano</h3>
            </div>
            <div class="modal-body">
                <div class="fila">
                    <div class="space"></div>
                    <center>
                    <i class="fa fa-map-marker fa-5x fa-icon"></i>
                    <div class="space"></div>
                    <h3 class="title-404" id="center_name"><b></b></h3>
                    <div class="space"></div>
                    </center>
                    <p>Puedes escoger otro local dependiendo del stock de productos disponibles.</p>
                </div>
                <div class="fila" id="div-closest-rmv">
                    <p>Algunos productos previamente ingresados no tienen stock suficiente en el local seleccionado.</p>
                    <div class="space"></div>
                    <table id="tbl-closest-rmv" class="tablealumno tbl-details" style="width:100%">
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
                <button class="btn-effie" data-dismiss="modal" onclick="removeDetails()">Aceptar</button>	
                <button class="btn-effie-inv" data-dismiss="modal">Cancelar</button>	
                </center>
            </div>
        </div>
    </div>
</div>