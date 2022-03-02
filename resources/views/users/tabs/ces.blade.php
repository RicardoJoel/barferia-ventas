<div id="ces" class="tabcontent" style="display:none">
    <table class="tablealumno index">
        <thead>
            <th width="10%">Código</th>
            <th width="30%">Nombre completo</th>
            <th width="15%">N° Documento</th>
            <th width="20%">Correo electrónico</th>
            <th width="15%">Celular</th>
            <th width="5%">Editar</th>
            <th width="5%">Borrar</th>
        </thead>
        <tbody>
            @foreach ($users as $user)
            @if ($user->end_at)
            <tr>
                <td><center>{{ $user->code }}</center></td>
                <td>{{ $user->fullname }}</td>
                <td><center>{{ $user->document }}</center></td>
                <td>{{ $user->email }}</td>
                <td><center>{{ $user->codeMobile }}</center></td>
                <td><center><a class="btn btn-secondary btn-xs" href="{{ action('UserController@edit', $user->id) }}" ><span class="glyphicon glyphicon-pencil"></span></a></center></td>
                <td><center>
                    <form action="{{ action('UserController@destroy', $user->id) }}" method="post">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                        <button class="btn btn-danger btn-xs" type="submit" onclick="return confirm('¿Realmente deseas eliminar el usuario seleccionado?')"><span class="glyphicon glyphicon-trash"></span></button>
                    </form>
                </center></td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</div>