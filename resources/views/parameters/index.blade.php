@extends('layouts.app')
@section('content')
<div class="fila">
    <div class="columna columna-1">
        <div class="title2">
            <h6>Utilitarios > Ajustes ></h6>
        </div>
    </div>
</div>
<div class="fila">
    <div class="columna columna-1">
        <table class="tablealumno index">
            <thead>
                <th width="10%">Nombre</th>
                <th width="70%">Descripción</th>
                <th width="10%">Valor</th>
                <th width="10%">Editar</th>
            </thead>
            <tbody>
                @foreach ($parameters as $parameter)
                <tr>
                    <td><center>{{ $parameter->name }}<center></td>
                    <td>{{ $parameter->description }}</td>
                    <td><center>{{ $parameter->value }}<center></td>
                    <td><center><a class="btn btn-secondary btn-xs" href="{{ action('ParameterController@edit', $parameter->id) }}" ><span class="glyphicon glyphicon-pencil"></span></a></center></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="fila">
    <div class="space2"></div>
    <div class="columna columna-1">
        <center>
        <a href="{{ route('home') }}" class="btn-effie-inv"><i class="fa fa-home"></i>&nbsp;Ir al inicio</a>
        </center>
    </div>
</div>
@endsection