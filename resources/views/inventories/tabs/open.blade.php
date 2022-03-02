<div id="open" class="tabcontent" style="display:block">
    <table class="tablealumno index">
        <thead>
            <th width="15%">Código</th>
            <th width="30%">Fecha y hora de cierre</th>
            <th width="35%">Tienda</th>
            <th width="5%">Editar</th>
            <th width="5%">Borrar</th>
        </thead>
        <tbody>
            @foreach ($inventories as $inventory)
            @if ($inventory->status == 'SIN CONFIRMAR')
            <tr>
                <td><center>{{ $inventory->code }}</center></td>
                <td><center>{{ Carbon\Carbon::parse($inventory->date)->format('d/m/Y H:i') }}</center></td>
                <td>{{ $inventory->center->name ?? '' }}</td>
                <td><center><a class="btn btn-secondary btn-xs" href="{{ action('InventoryController@edit', $inventory->id) }}">
                    <span class="glyphicon glyphicon-pencil"></span></a>
                </center></td>
                <td><center>
                    <form action="{{ action('InventoryController@destroy', $inventory->id) }}" method="post">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                        <button class="btn btn-danger btn-xs" type="submit" onclick="return confirm('¿Realmente deseas eliminar el inventario seleccionado?')"><span class="glyphicon glyphicon-trash"></span></button>
                    </form>
                </center></td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</div>