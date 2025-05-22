@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Socios</h1>

    <a href="{{ route('members.create') }}" class="btn btn-primary mb-3">Agregar Nuevo Socio</a>

    @if ($members->isEmpty())
        <p>No hay socios registrados aún.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>RUT</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($members as $member)
                    <tr>
                        <td>{{ $member->first_name }} {{ $member->last_name }}</td>
                        <td>{{ $member->rut }}</td>
                        <td>{{ $member->email }}</td>
                        <td>{{ $member->phone }}</td>
                        <td>
                            <a href="{{ route('members.edit', $member->id) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('members.destroy', $member->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este socio?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
