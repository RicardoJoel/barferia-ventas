@extends('layouts.app')
@section('content')
<div class="fila">
    <div class="columna columna-1">
        <div class="title2">
            <h6>Entidades > Clientes ></h6>
        </div>
    </div>
</div>
<div class="fila">
    <div class="columna columna-1">
        <table class="tablealumno index">
            <thead>
                <th width="10%">Código</th>
                <th width="25%">Nombre completo</th>
                <th width="15%">N° Documento</th>   
                <th width="15%">Celular</th>
                <th width="25%">Correo electrónico</th>
                <th width="5%">Editar</th>
                <th width="5%">Borrar</th>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                <tr>
                    <td><center>{{ $customer->code }}</center></td>
                    <td>{{ $customer->fullname }}</td>
                    <td><center>{{ $customer->document }}</center></td>
                    <td><center>{{ $customer->codeMobile }}</center></td>
                    <td>{{ $customer->email }}</td>
                    <td><center><a class="btn btn-secondary btn-xs" href="{{ action('CustomerController@edit', $customer->id) }}" ><span class="glyphicon glyphicon-pencil"></span></a></center></td>
                    <td>
                        <center>
                        <form action="{{ action('CustomerController@destroy', $customer->id) }}" method="post">
                            @csrf
                            <input name="_method" type="hidden" value="DELETE">
                            <button class="btn btn-danger btn-xs" type="submit" onclick="return confirm('¿Realmente deseas eliminar el cliente seleccionado?')"><span class="glyphicon glyphicon-trash"></span></button>
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
        <a href="{{ route('customers.create') }}" class="btn-effie"><i class="fa fa-plus"></i>&nbsp;Nuevo</a>
        <a href="{{ route('home') }}" class="btn-effie-inv"><i class="fa fa-home"></i>&nbsp;Ir al inicio</a>
    </div>
    </center>
</div>
@endsection