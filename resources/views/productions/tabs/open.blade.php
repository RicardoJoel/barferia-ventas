<div id="open" class="tabcontent" style="display:block">
    <table class="tablealumno index">
        <thead>
            <th width="15%">Código</th>
            <th width="30%">Fecha y hora de cierre</th>
            <th width="35%">Centro de producción</th>
            <th width="5%">Editar</th>
            <th width="5%">Borrar</th>
        </thead>
        <tbody>
            @foreach ($productions as $production)
            @if ($production->status == 'SIN CONFIRMAR')
            <tr>
                <td><center>{{ $production->code }}</center></td>
                <td><center>{{ Carbon\Carbon::parse($production->date)->format('d/m/Y H:i') }}</center></td>
                <td>{{ $production->center->name ?? '' }}</td>
                <td><center><a class="btn btn-secondary btn-xs" href="{{ action('ProductionController@edit', $production->id) }}">
                    <span class="glyphicon glyphicon-pencil"></span></a>
                </center></td>
                <td><center>
                    <form action="{{ action('ProductionController@destroy', $production->id) }}" method="post">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                        <button class="btn btn-danger btn-xs" type="submit" onclick="return confirm('¿Realmente deseas eliminar la producción seleccionada?')"><span class="glyphicon glyphicon-trash"></span></button>
                    </form>
                </center></td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</div>