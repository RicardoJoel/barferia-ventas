@extends('layouts.app')
@section('content')
<div class="fila">
    <div class="columna columna-1">
        <div class="title2">
            <h6>Menú principal</h6>
        </div>
    </div>
</div>
<div class="fila">
    <div class="columna columna-1">
        <h6 class="title3">Entidades y procesos</h6>
    </div>
</div>
<div class="fila">
    <div class="columna columna-6">
        <div class="scene">
            <div class="card">
                <a href="{{ route('customers.index') }}">
                    <div class="card__face card__face--front">
                        <div class="content" title="Actualiza la lista de clientes">
                            <i class="fa fa-briefcase fa-4x"></i>                            
                            <p>Clientes</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="columna columna-6">
        <div class="scene">
            <div class="card">
                <a href="{{ route('receptions.index') }}">
                    <div class="card__face card__face--front">
                        <div class="content" title="Actualiza la recepción de productos">
                            <i class="fa fa-check-square-o fa-4x"></i>                            
                            <p>Recepción</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="columna columna-6">
        <div class="scene">
            <div class="card">
                <a href="{{ route('sales.index') }}">
                    <div class="card__face card__face--front">
                        <div class="content" title="Registra las ventas realizadas">
                            <i class="fa fa-shopping-cart fa-4x"></i>                            
                            <p>Ventas</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="columna columna-6">
        <div class="scene">
            <div class="card">
                <a href="{{ route('inventories.index') }}">
                    <div class="card__face card__face--front">
                        <div class="content" title="Actualiza el inventario de productos">
                            <i class="fa fa-list-alt fa-4x"></i>                            
                            <p>Inventario</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="fila">
    <div class="space"></div>
    <div class="columna columna-1">
        <h6 class="title3">Otros</h6>
    </div>
</div>
<div class="fila">
    <div class="columna columna-6">
        <div class="scene">    
            <div class="card">
                <a href="{{ route('profile') }}">
                    <div class="card__face card__face--front">
                        <div class="content" title="Actualiza tus datos personales">
                            <i class="fa fa-address-card fa-4x"></i>                            
                            <p>Mis datos</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="columna columna-6">
        <div class="scene">
            <div class="card">
                <a href="{{ route('password') }}">
                    <div class="card__face card__face--front">
                        <div class="content" title="Actualiza regularmente tu contraseña">
                            <i class="fa fa-lock fa-4x"></i>                            
                            <p>Seguridad</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection