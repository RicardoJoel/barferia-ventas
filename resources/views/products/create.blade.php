@extends('layouts.app')
@section('content')
<div class="fila">
	<div class="columna columna-1">
		<div class="title2">
			<h6>Entidades > Productos > Nuevo ></h6>
		</div>
	</div>
</div>
<form method="POST" action="{{ route('products.store') }}" role="form" id="frm-product">
	@csrf
	<div class="fila">
        <div class="columna columna-1">
			<div class="form-section">
				<a onclick="showForm('gen')">
					<h6 id="gen_subt" class="title3">General</h6>
					<p id="icn-gen" class="icn-sct"><i class="fa fa-minus fa-icon"></i></p>
				</a>
				<div id="div-gen">
					<div class="fila">
						<div class="columna columna-6">
							<p>Código</p>
							<input type="text" disabled>
						</div>
						<div class="columna columna-3">
							<p>Nombre*</p>
							<input type="text" name="name" id="name" maxlength="50" value="{{ old('name') }}" required>
						</div>
						<div class="columna columna-6">
							<p>Precio und* (PEN)</p>
							<input type="number" name="price" id="price" value="{{ old('price') }}" min="0" step="any" required>
						</div>
					</div>
					<div class="fila">
						<div class="columna columna-1">
							<p>Descripción</p>
							<textarea name="description" id="description" maxlength="500" rows="4">{{ old('description') }}</textarea>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
@include('products/submit')
@endsection