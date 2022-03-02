<div class="modal fade" id="mdl-detail" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">x</button>
                <h3 class="modal-title">Detalle por producto</h3>
            </div>
            <div class="modal-body">
				<div class="fila">
                    <div class="columna columna-1">
                        <div class="span-fail" id="det_fail_div"><span id="det_fail_msg"></span></div>
                    </div>
                </div>
                <form method="POST" action="{{ url('proddetails.update') }}" role="form" id="det_form">
                    @csrf
                    <input type="hidden" name="det_idx" id="det_idx" value="{{ old('det_idx') }}">
                    <div class="fila">
						<div class="columna columna-10">
                            <i class="fa fa-industry fa-2x fa-icon"></i>
                        </div>
                        <div class="columna columna-5d">
                            <p>Centro de producción</p>
                        </div>
						<div class="columna columna-2">
							<input type="text" id="det_center" disabled>
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
                        <div class="columna columna-10">
                            <i class="fa fa-barcode fa-2x fa-icon"></i>
                        </div>
						<div class="columna columna-5d">
                            <p>Lote</p>
                        </div>
                        <div class="columna columna-2">
                            <input type="text" name="det_batch" id="det_batch" value="{{ old('det_batch') }}" maxlength="20">
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
                            <input type="number" id="det_openstock" disabled>
                        </div>
                        <div class="columna columna-4">
                            <p>uds.</p>
                        </div>
                    </div>
                    <div class="fila">
                        <div class="columna columna-10">
                            <i class="fa fa-sign-in fa-2x fa-icon"></i>
                        </div>
						<div class="columna columna-5d">
                            <p>Producción</p>
                        </div>
                        <div class="columna columna-4">
                            <input type="number" name="det_quantity" id="det_quantity" value="{{ old('det_quantity') }}" min="0" onkeypress="return checkNumber(event)" required>
                        </div>
                        <div class="columna columna-4">
                            <p>uds.</p>
                        </div>
                    </div>
					<div class="fila">
                        <div class="columna columna-10">
                            <i class="fa fa-trash fa-2x fa-icon"></i>
                        </div>
						<div class="columna columna-5d">
                            <p>Merma</p>
                        </div>
                        <div class="columna columna-4">
                            <input type="number" name="det_removed" id="det_removed" value="{{ old('det_removed') }}" min="0" onkeypress="return checkNumber(event)" required>
                        </div>
                        <div class="columna columna-4">
                            <p>uds.</p>
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
							<input type="number" id="det_finalstock" disabled>
                        </div>
                        <div class="columna columna-4">
                            <p>uds.</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <center>
                        <button type="submit" class="btn-effie"><i class="fa fa-save"></i>&nbsp;Guardar</button>
						<a class="btn-effie-inv" data-dismiss="modal">Cerrar</a>    
						</center>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>