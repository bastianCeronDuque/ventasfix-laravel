<!DOCTYPE html>
<html>
<head>
    <title>Lista de Usuarios</title>
</head>
<body>
    <h1>Usuarios Registrados</h1>
    @if($users->isEmpty())
        <p>No hay usuarios registrados.</p>
    @else
        <ul>
            @foreach ($users as $user)
                <li>
                    {{ $user->nombre }} {{ $user->apellido }} - {{ $user->email }}
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Eliminar</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @endif
</body>
</html>