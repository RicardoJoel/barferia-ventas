@extends('layouts.app')
@section('content')
<div class="fila">
    <div class="columna columna-1">
        <div class="title2">
            <h6>Entidades > Productos ></h6>
        </div>
    </div>
</div>
<div class="fila">
    <div class="columna columna-1">
        <table class="tablealumno index">
            <thead>
                <th width="10%">Código</th>
                <th width="20%">Nombre</th>
                <th width="30%">Descripción</th>
                <th width="20%">Precio und (PEN)</th>
                <th width="5%">Editar</th>
                <th width="5%">Borrar</th>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td><center>{{ $product->code }}</center></td>
                    <td>{{ $product->name }}</td>
                    <td>{{ strlen($product->description) > 50 ? substr($product->description, 0, 50).'...' : $product->description }}</td>
                    <td><center>{{ number_format($product->price,2) }}</center></td>
                    <td><center><a class="btn btn-secondary btn-xs" href="{{ action('ProductController@edit', $product->id) }}" ><span class="glyphicon glyphicon-pencil"></span></a></center></td>
                    <td>
                        <center>
                        <form action="{{ action('ProductController@destroy', $product->id) }}" method="post">
                            @csrf
                            <input name="_method" type="hidden" value="DELETE">
                            <button class="btn btn-danger btn-xs" type="submit" onclick="return confirm('¿Realmente deseas eliminar el producto seleccionado?')"><span class="glyphicon glyphicon-trash"></span></button>
                        </form>
                        </center>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="fila">
    <div class="space2"></div>
    <center>
    <div class="columna columna-1">
        <a href="{{ route('products.create') }}" class="btn-effie"><i class="fa fa-plus"></i>&nbsp;Nuevo</a>
        <a href="{{ route('home') }}" class="btn-effie-inv"><i class="fa fa-home"></i>&nbsp;Ir al inicio</a>
    </div>
    </center>
</div>
@endsection