<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centros Cívicos</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script>
        function confirmarEliminacion(id) {
            if (confirm("Esta acción es irreversible. ¿Deseas eliminar este centro?")) {
                document.getElementById('delete-form-' + id).submit();
            }
        }
    </script>
</head>
<body>
    <h1>Listado de Centros Cívicos</h1>

    <div class="table-container">
        <button class="create-btn" onclick="window.location.href='{{ route('centros.create') }}'">Crear Centro</button>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Horario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($centros as $centro)
                    <tr>
                        <td>{{ $centro->id }}</td>
                        <td>{{ $centro->nombre }}</td>
                        <td>{{ $centro->direccion }}</td>
                        <td>{{ $centro->telefono }}</td>
                        <td>{{ $centro->horario }}</td>
                        <td class="action-buttons">
                            <a href="{{ route('centros.edit', $centro->id) }}">
                                <button class="edit-btn">Actualizar</button>
                            </a>
                            <form action="{{ route('centros.destroy', $centro->id) }}" method="POST" onsubmit="return confirm('Esta acción es irreversible. ¿Eliminar centro?')">
                                @csrf
                                @method('DELETE')
                                <button class="delete-btn" type="submit">Borrar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
