<div id="clos" class="tabcontent" style="display:none">
    <table class="tablealumno index">
        <thead>
            <th width="15%">Código</th>
            <th width="30%">Fecha y hora de cierre</th>
            <th width="35%">Tienda</th>
            <th width="5%">Revisar</th>
            @if (Auth::user()->is_admin)
            <th width="5%">Borrar</th>
            @endif
        </thead>
        <tbody>
            @foreach ($inventories as $inventory)
            @if ($inventory->status == 'CONFIRMADA')
            <tr>
                <td><center>{{ $inventory->code }}</center></td>
                <td><center>{{ Carbon\Carbon::parse($inventory->date)->format('d/m/Y H:i') }}</center></td>
                <td>{{ $inventory->center->name ?? '' }}</td>
                <td><center>
                    <a class="btn btn-secondary btn-xs" href="{{ action('InventoryController@show', $inventory->id) }}">
                        <span class="glyphicon glyphicon-eye-open"></span></a>
                </center></td>
                @if (Auth::user()->is_admin)
                <td><center>
                    <form action="{{ action('InventoryController@destroy', $inventory->id) }}" method="post">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                        <button class="btn btn-danger btn-xs" type="submit" onclick="return confirm('¿Realmente deseas eliminar el inventario seleccionado?')"><span class="glyphicon glyphicon-trash"></span></button>
                    </form>
                </center></td>
                @endif
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</div>