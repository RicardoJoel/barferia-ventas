<div id="pend" class="tabcontent" style="display:none">
    <table class="tablealumno index">
        <thead>
            <th width="15%">Código</th>
            <th width="20%">Fecha y hora de envío</th>
            <th width="20%">Origen</th>
            <th width="20%">Destino</th>
            <th width="5%">Revisar</th>
            @if (Auth::user()->is_admin)
            <th width="5%">Borrar</th>
            @endif
        </thead>
        <tbody>
            @foreach ($distributions as $distribution)
            @if ($distribution->status == 'CONFIRMADA')
            <tr>
                <td><center>{{ $distribution->code }}</center></td>
                <td><center>{{ Carbon\Carbon::parse($distribution->date)->format('d/m/Y H:i') }}</center></td>
                <td>{{ $distribution->origin->name ?? '' }}</td>
                <td>{{ $distribution->destiny->name ?? '' }}</td>
                <td><center><a class="btn btn-secondary btn-xs" href="{{ action('DistributionController@show', $distribution->id) }}">
                    <span class="glyphicon glyphicon-eye-open"></span></a>
                </center></td>
                @if (Auth::user()->is_admin)
                <td><center>
                    <form action="{{ action('DistributionController@destroy', $distribution->id) }}" method="post">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                        <button class="btn btn-danger btn-xs" type="submit" onclick="return confirm('¿Realmente deseas eliminar la distribución seleccionada?')"><span class="glyphicon glyphicon-trash"></span></button>
                    </form>
                </center></td>
                @endif
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</div>