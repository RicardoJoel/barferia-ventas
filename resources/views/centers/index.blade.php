@extends('layouts.app')
@section('content')
<div class="fila">
    <div class="columna columna-1">
        <div class="title2">
            <h6>Entidades > Locales ></h6>
        </div>
    </div>
</div>
<div class="fila">
    <div class="columna columna-1">
        <table class="tablealumno index">
            <thead>
                <th width="10%">Código</th>
                <th width="25%">Nombre</th>
                <th width="10%">Cod. Referencial</th>
                <th width="25%">Tipo</th>
                <th width="5%">Editar</th>
                <th width="5%">Borrar</th>
            </thead>
            <tbody>
                @foreach ($centers as $center)
                <tr>
                    <td><center>{{ $center->code }}</center></td>
                    <td>{{ $center->name }}</td>
                    <td><center>{{ $center->nemo }}</center></td>
                    <td><center>{{ $center->type == 'F' ? 'Producción' : 'Distribución' }}</center></td>
                    <td><center><a class="btn btn-secondary btn-xs" href="{{ action('CenterController@edit', $center->id) }}" ><span class="glyphicon glyphicon-pencil"></span></a></center></td>
                    <td>
                        <center>
                        <form action="{{ action('CenterController@destroy', $center->id) }}" method="post">
                            @csrf
                            <input name="_method" type="hidden" value="DELETE">
                            <button class="btn btn-danger btn-xs" type="submit" onclick="return confirm('¿Realmente deseas eliminar el local seleccionado?')"><span class="glyphicon glyphicon-trash"></span></button>
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
        <a href="{{ route('centers.create') }}" class="btn-effie"><i class="fa fa-plus"></i>&nbsp;Nuevo</a>
        <a href="{{ route('home') }}" class="btn-effie-inv"><i class="fa fa-home"></i>&nbsp;Ir al inicio</a>
    </div>
    </center>
</div>
@endsection