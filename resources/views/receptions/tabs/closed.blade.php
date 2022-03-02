<div id="clos" class="tabcontent" style="display:none">
    <table class="tablealumno index">
        <thead>
            <th width="15%">Código</th>
            <th width="20%">Fecha y hora de entrega</th>
            <th width="20%">Origen</th>
            <th width="20%">Destino</th>
            <th width="5%">Revisar</th>
            @if (Auth::user()->is_admin)
            <th width="5%">Borrar</th>
            @endif
        </thead>
        <tbody>
            @foreach ($receptions as $reception)
            <tr>
                <td><center>{{ $reception->code }}</center></td>
                <td><center>{{ Carbon\Carbon::parse($reception->date)->format('d/m/Y H:i') }}</center></td>
                <td>{{ $reception->distribution->origin->name ?? '' }}</td>
                <td>{{ $reception->distribution->destiny->name ?? '' }}</td>
                <td><center>
                    <a class="btn btn-secondary btn-xs" href="{{ action('ReceptionController@show', $reception->id) }}">
                        <span class="glyphicon glyphicon-eye-open"></span></a>
                </center></td>
                @if (Auth::user()->is_admin)
                <td><center>
                    <form action="{{ action('ReceptionController@destroy', $reception->id) }}" method="post">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                        <button class="btn btn-danger btn-xs" type="submit" onclick="return confirm('¿Realmente deseas eliminar la recepción seleccionada?')"><span class="glyphicon glyphicon-trash"></span></button>
                    </form>
                </center></td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</div>