@extends('layouts.app')
@section('content')
<div class="fila">
    <div class="columna columna-1">
        <div class="title2">
            <h6>Procesos > Ventas ></h6>
        </div>
    </div>
</div>
<div class="fila">
    <div class="columna columna-1">
        <div class="tab">
            <button type="button" class="tablinks active" onclick="openTab(event,'pend')">Pendientes</button>
            <button type="button" class="tablinks" onclick="openTab(event,'paga')">Pagadas</button>
            <button type="button" class="tablinks" onclick="openTab(event,'reem')">Reembolsadas</button>
            <button type="button" class="tablinks" onclick="openTab(event,'rech')">Rechazadas</button>
            <button type="button" class="tablinks" onclick="openTab(event,'rein')">Reintentando cobro</button>
            <button type="button" class="tablinks" onclick="openTab(event,'impa')">Impagas</button>
        </div>
        <!-- Tab content -->
        <div>
            @include('sales/tabs/pend')
            @include('sales/tabs/paga')
            @include('sales/tabs/reem')
            @include('sales/tabs/rech')
            @include('sales/tabs/rein')
            @include('sales/tabs/impa')
        </div>
    </div>
</div>
<div class="fila">
    <div class="space2"></div>
    <div class="columna columna-1">
        <center>
        <a href="{{ route('sales.create') }}" class="btn-effie"><i class="fa fa-plus"></i>&nbsp;Nueva</a>
        <a href="{{ route('home') }}" class="btn-effie-inv"><i class="fa fa-home"></i>&nbsp;Ir al inicio</a>
        </center>
    </div>
</div>
@endsection