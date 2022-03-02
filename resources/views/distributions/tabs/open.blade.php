<div id="open" class="tabcontent" style="display:block">
    <table class="tablealumno index">
        <thead>
            <th width="15%">Código</th>
            <th width="20%">Fecha y hora de envío</th>
            <th width="20%">Origen</th>
            <th width="20%">Destino</th>
            <th width="5%">Editar</th>
            <th width="5%">Borrar</th>
        </thead>
        <tbody>
            @foreach ($distributions as $distribution)
            @if ($distribution->status == 'SIN CONFIRMAR')
            <tr>
                <td><center>{{ $distribution->code }}</center></td>
                <td><center>{{ Carbon\Carbon::parse($distribution->date)->format('d/m/Y H:i') }}</center></td>
                <td>{{ $distribution->origin->name ?? '' }}</td>
                <td>{{ $distribution->destiny->name ?? '' }}</td>
                <td><center><a class="btn btn-secondary btn-xs" href="{{ action('DistributionController@edit', $distribution->id) }}">
                    <span class="glyphicon glyphicon-pencil"></span></a>
                </center></td>
                <td><center>
                    <form action="{{ action('DistributionController@destroy', $distribution->id) }}" method="post">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                        <button class="btn btn-danger btn-xs" type="submit" onclick="return confirm('¿Realmente deseas eliminar la distribución seleccionada?')"><span class="glyphicon glyphicon-trash"></span></button>
                    </form>
                </center></td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</div>