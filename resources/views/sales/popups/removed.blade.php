<div class="modal fade" id="mdl-removed" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">x</button>
                <h3 class="modal-title">Aviso de confirmación</h3>
            </div>
            <div class="modal-body">
                <div class="fila">
                    <p>Algunos productos previamente ingresados no tienen stock suficiente en el local seleccionado. ¿Deseas retirarlos?</p>
                </div>
                <div class="fila">
                    <div class="space"></div>
                    <table id="tbl-removed" class="tablealumno tbl-details" style="width:100%">
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
                <button class="btn-effie" data-dismiss="modal" onclick="removeDetails()">Sí</button>	
                <button class="btn-effie-inv" data-dismiss="modal">No</button>	
                </center>
            </div>
        </div>
    </div>
</div>