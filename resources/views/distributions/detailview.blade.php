<div class="modal fade" id="mdl-detail" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">x</button>
                <h3 class="modal-title">Detalle por producto</h3>
            </div>
            <div class="modal-body">
                <div class="fila">
                    <div class="columna columna-10">
                        <i class="fa fa-building fa-2x fa-icon"></i>
                    </div>
                    <div class="columna columna-5d">
                        <p>Local destino</p>
                    </div>
                    <div class="columna columna-2">
                        <input type="text" value="{{ $distribution->destiny->name }}" disabled>
                    </div>
                </div>
                <div class="fila">
                    <div class="columna columna-10">
                        <i class="fa fa-shopping-bag fa-2x fa-icon"></i>
                    </div>
                    <div class="columna columna-5d">
                        <p>Producto</p>
                    </div>
                    <div class="columna columna-2">
                        <input type="text" id="det_product" disabled>
                    </div>
                </div>
                <div class="fila">
                    <div class="columna columna-2">
                        <br>
                    </div>
                    <div class="columna columna-4">
                        <p style="text-align:center;margin-bottom:5px">Origen</p>
                    </div>
                    <div class="columna columna-4">
                        <p style="text-align:center;margin-bottom:5px">Destino</p>
                    </div>
                </div>
                <div class="fila">
                    <div class="columna columna-10">
                        <i class="fa fa-cube fa-2x fa-icon"></i>
                    </div>
                    <div class="columna columna-5d">
                        <p>Stock inicial</p>
                    </div>
                    <div class="columna columna-4">
                        <input type="text" id="det_openstock" disabled>
                    </div>
                    <div class="columna columna-4">
                        <input type="text" id="det_opendestiny" disabled>
                    </div>
                </div>
                <div class="fila">
                    <div class="columna columna-10">
                        <i class="fa fa-sign-out fa-2x fa-icon"></i>
                    </div>
                    <div class="columna columna-5d">
                        <p>Enviados / Recibidos</p>
                    </div>
                    <div class="columna columna-4">
                        <input type="text" id="det_quantity" disabled>
                    </div>
                    <div class="columna columna-4">
                        <input type="text" id="det_received" disabled>
                    </div>
                </div>
                <div class="fila">
                    <div class="columna columna-10">
                        <i class="fa fa-exchange fa-2x fa-icon"></i>
                    </div>
                    <div class="columna columna-5d">
                        <p>Devueltos</p>
                    </div>
                    <div class="columna columna-4">
                        <input type="text" id="det_returned" disabled>
                    </div>
                </div>
                <div class="fila">
                    <div class="columna columna-10">
                        <i class="fa fa-cubes fa-2x fa-icon"></i>
                    </div>
                    <div class="columna columna-5d">
                        <p>Stock final</p>
                    </div>
                    <div class="columna columna-4">
                        <input type="text" id="det_finalstock" disabled>
                    </div>
                    <div class="columna columna-4">
                        <input type="text" id="det_finaldestiny" disabled>
                    </div>
                </div>
                <div class="fila">
                    <div class="columna columna-1">
                        <p>Observación</p>
                        <textarea id="det_observation" rows="3" disabled></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <center><a class="btn-effie-inv" data-dismiss="modal">Cerrar</a></center>
                </div>
            </div>
        </div>
    </div>
</div>