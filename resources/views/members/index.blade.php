@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Socios</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('members.create') }}" class="btn btn-primary mb-3">Agregar Nuevo Socio</a>

    <a href="{{ route('members.export') }}" class="btn btn-success mb-3">Exportar a CSV</a>



    {{-- Formulario de búsqueda --}}
    <form method="GET" action="{{ route('members.index') }}" class="row mb-4">
        <div class="col-md-8">
            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Buscar por nombre, apellido o RUT"
                value="{{ $search ?? '' }}"
            >
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary w-100">Buscar</button>
        </div>
    </form>

    {{-- Si no hay resultados --}}
    @if ($members->isEmpty())
        <p>No hay socios registrados aún.</p>
    @else
        {{-- Tabla de resultados --}}
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>RUT</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Fecha de Ingreso</th>
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
                        
                        <td>{{ $member->address }}</td>
                        <td>
                        {{ $member->join_date
                            ? \Carbon\Carbon::parse($member->join_date)->format('d-m-Y')
                            : '—' }}
                        </td>

                        <td>
                            <a href="{{ route('members.edit', $member->id) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form
                                action="{{ route('members.destroy', $member->id) }}"
                                method="POST"
                                style="display:inline-block;"
                            >
                                @csrf
                                @method('DELETE')
                                <button
                                    type="submit"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('¿Estás seguro de eliminar este socio?')"
                                >
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Enlaces de paginación --}}
        <div class="mt-4">
            {{ $members->withQueryString()->links() }}
        </div>
    @endif
</div>
@endsection
