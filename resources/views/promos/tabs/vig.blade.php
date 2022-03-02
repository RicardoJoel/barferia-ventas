<div id="vig" class="tabcontent" style="display:none">
    <table class="tablealumno index">
        <thead>
            <th width="10%">Código</th>
            <th width="30%">Nombre</th>
            <th width="15%">Fecha inicio</th>
            <th width="15%">Fecha fin</th>
            <th width="15%">Precio (PEN)</th>
            <th width="5%">Editar</th>
            <th width="5%">Borrar</th>
        </thead>
        <tbody>
            @foreach ($promos as $promo)
            @if ($promo->status == 'VIGENTE')
            <tr>
                <td><center>{{ $promo->code }}</center></td>
                <td>{{ $promo->name }}</td>
                <td><center>{{ Carbon\Carbon::parse($promo->start_at)->format('d/m/Y') }}</center></td>
                <td><center>{{ Carbon\Carbon::parse($promo->end_at)->format('d/m/Y') }}</center></td>
                <td><center>{{ number_format($promo->price, 2) }}</center></td>
                <td><center><a class="btn btn-secondary btn-xs" href="{{ action('PromoController@edit', $promo->id) }}">
                    <span class="glyphicon glyphicon-pencil"></span></a>
                </center></td>
                <td><center>
                    <form action="{{ action('PromoController@destroy', $promo->id) }}" method="post">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                        <button class="btn btn-danger btn-xs" type="submit" onclick="return confirm('¿Realmente deseas eliminar la promoción seleccionada?')"><span class="glyphicon glyphicon-trash"></span></button>
                    </form>
                </center></td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</div>