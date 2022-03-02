<div id="pend" class="tabcontent" style="display:block">
    <table class="tablealumno index">
        <thead>
            <th width="15%">Código</th>
            <th width="20%">Fecha y hora de envío</th>
            <th width="20%">Origen</th>
            <th width="20%">Destino</th>
            <th width="10%">Verificar</th>
        </thead>
        <tbody>
            @foreach ($distributions as $distribution)
            <tr>
                <td><center>{{ $distribution->code }}</center></td>
                <td><center>{{ Carbon\Carbon::parse($distribution->date)->format('d/m/Y H:i') }}</center></td>
                <td>{{ $distribution->origin->name ?? '' }}</td>
                <td>{{ $distribution->destiny->name ?? '' }}</td>
                <td><center><a class="btn btn-secondary btn-xs" href="{{ route('receptions/verify',$distribution->code) }}">
                    <span class="glyphicon glyphicon-check"></span></a>
                </center></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>