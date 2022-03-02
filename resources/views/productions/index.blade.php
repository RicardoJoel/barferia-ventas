@extends('layouts.app')
@section('content')
<div class="fila">
    <div class="columna columna-1">
        <div class="title2">
            <h6>Procesos > Producción ></h6>
        </div>
    </div>
</div>
<div class="fila">
    <div class="columna columna-1">
        <div class="tab">
            <button type="button" class="tablinks active" onclick="openTab(event,'open')">Sin confirmar</button>
            <button type="button" class="tablinks" onclick="openTab(event,'clos')">Confirmadas</button>
        </div>
        <!-- Tab content -->
        <div>
            @include('productions/tabs/open')
            @include('productions/tabs/closed')
        </div>
    </div>
</div>
<div class="fila">
    <div class="space2"></div>
    <center>
    <div class="columna columna-1">
        <a href="{{ route('productions.create') }}" class="btn-effie"><i class="fa fa-plus"></i>&nbsp;Nueva</a>
        <a href="{{ route('home') }}" class="btn-effie-inv"><i class="fa fa-home"></i>&nbsp;Ir al inicio</a>
    </div>
    </center>
</div>
@endsection