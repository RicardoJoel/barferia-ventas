<div id="rech" class="tabcontent" style="display:none">
    <table class="tablealumno index">
        <thead>
            <th width="10%">Código</th>
            <th width="15%">Fecha y hora</th>
            <th width="20%">Local encargado</th>
            <th width="20%">Cliente</th>
            <th width="15%">Monto venta (PEN)</th>
            <th width="5%">Editar</th>
            <th width="5%">Borrar</th>
        </thead>
        <tbody>
            @foreach ($sales as $sale)
            @if ($sale->status == 'RECHAZADA')
            <tr>
                <td><center>{{ $sale->code }}</center></td>    
                <td><center>{{ Carbon\Carbon::parse($sale->happened_at)->format('d/m/Y H:i') }}</center></td>
                <td><center>{{ $sale->center->name ?? '' }}<center></td>
                <td>{{ $sale->customer->fullname ?? '' }}</td>
                <td style="text-align:right;padding-right:50px">{{ number_format($sale->totalfinal,2) }}</td>
                <td><center><a class="btn btn-secondary btn-xs" href="{{ action('SaleController@edit',$sale->id) }}" ><span class="glyphicon glyphicon-pencil"></span></a></center></td>
                <td>
                    <center>
                    <form action="{{ action('SaleController@destroy', $sale->id) }}" method="post">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                        <button class="btn btn-danger btn-xs" type="submit" onclick="return confirm('¿Realmente deseas eliminar la venta seleccionada?')"><span class="glyphicon glyphicon-trash"></span></button>
                    </form>
                    </center>
                </td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</div>