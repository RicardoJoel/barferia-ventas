@extends('layouts.app')
@section('content')
<div class="fila">
	<div class="columna columna-1">
		<div class="title2">
			<h6>Entidades > Productos > Editar ></h6>
		</div>
	</div>
</div>
<form method="POST" action="{{ route('products.update',$product->id) }}" role="form" id="frm-product">
	@csrf
	<input type="hidden" name="_method" id="_method" value="PATCH">
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
							<input type="text" value="{{ $product->code }}" disabled>
						</div>
						<div class="columna columna-3">
							<p>Nombre*</p>
							<input type="text" name="name" id="name" maxlength="50" value="{{ old('name',$product->name) }}" required>
						</div>
						<div class="columna columna-6">
							<p>Precio und* (PEN)</p>
							<input type="number" name="price" id="price" value="{{ old('price',$product->price) }}" min="0" step="any" required>
						</div>
					</div>
					<div class="fila">
						<div class="columna columna-1">
							<p>Descripción</p>
							<textarea name="description" id="description" maxlength="500" rows="4">{{ old('description',$product->description) }}</textarea>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
@include('products/submit')
@endsection