<div id="clos" class="tabcontent" style="display:none">
    <table class="tablealumno index">
        <thead>
            <th width="15%">Código</th>
            <th width="30%">Fecha y hora de cierre</th>
            <th width="35%">Centro de producción</th>
            <th width="5%">Revisar</th>
            @if (Auth::user()->is_admin)
            <th width="5%">Borrar</th>
            @endif
        </thead>
        <tbody>
            @foreach ($productions as $production)
            @if ($production->status == 'CONFIRMADA')
            <tr>
                <td><center>{{ $production->code }}</center></td>
                <td><center>{{ Carbon\Carbon::parse($production->date)->format('d/m/Y H:i') }}</center></td>
                <td>{{ $production->center->name ?? '' }}</td>
                <td><center>
                    <a class="btn btn-secondary btn-xs" href="{{ action('ProductionController@show', $production->id) }}">
                        <span class="glyphicon glyphicon-eye-open"></span></a>
                </center></td>
                @if (Auth::user()->is_admin)
                <td><center>
                    <form action="{{ action('ProductionController@destroy', $production->id) }}" method="post">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                        <button class="btn btn-danger btn-xs" type="submit" onclick="return confirm('¿Realmente deseas eliminar la producción seleccionada?')"><span class="glyphicon glyphicon-trash"></span></button>
                    </form>
                </center></td>
                @endif
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</div>