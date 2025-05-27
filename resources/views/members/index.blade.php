@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-semibold mb-6 text-gray-800">Lista de Socios</h1>

    @if (session('success'))
        <div class="mb-4 rounded bg-green-100 border border-green-400 text-green-700 px-4 py-3" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 gap-3">
        <a href="{{ route('members.create') }}" 
           class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow">
           Agregar Nuevo Socio
        </a>

        <a href="{{ route('members.export') }}" 
           class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded shadow">
           Exportar a CSV
        </a>
    </div>

    {{-- Formulario de búsqueda --}}
    <form method="GET" action="{{ route('members.index') }}" class="mb-6 flex flex-col sm:flex-row gap-3">
        <input
            type="text"
            name="search"
            class="flex-grow rounded border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Buscar por nombre, apellido o RUT"
            value="{{ $search ?? '' }}"
        >
        <button type="submit" 
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded shadow">
            Buscar
        </button>
    </form>

    @if ($members->isEmpty())
        <p class="text-gray-600">No hay socios registrados aún.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-left py-3 px-4 font-medium text-gray-700 border-b">Nombre</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-700 border-b">RUT</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-700 border-b">Correo</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-700 border-b">Teléfono</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-700 border-b">Dirección</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-700 border-b">Fecha de Ingreso</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-700 border-b">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($members as $member)
                        <tr class="hover:bg-gray-100">
                            <td class="py-3 px-4 border-b">{{ $member->first_name }} {{ $member->last_name }}</td>
                            <td class="py-3 px-4 border-b">{{ $member->rut }}</td>
                            <td class="py-3 px-4 border-b">{{ $member->email }}</td>
                            <td class="py-3 px-4 border-b">{{ $member->phone }}</td>
                            <td class="py-3 px-4 border-b">{{ $member->address }}</td>
                            <td class="py-3 px-4 border-b">
                                {{ $member->join_date
                                    ? \Carbon\Carbon::parse($member->join_date)->format('d-m-Y')
                                    : '—' }}
                            </td>
                            <td class="py-3 px-4 border-b space-x-2">
                                <a href="{{ route('members.show', $member->id) }}" 
                                   class="inline-block bg-blue-500 hover:bg-blue-600 text-white text-xs font-semibold py-1 px-3 rounded">
                                    Ver
                                </a>
                                <a href="{{ route('members.edit', $member->id) }}" 
                                   class="inline-block bg-yellow-400 hover:bg-yellow-500 text-white text-xs font-semibold py-1 px-3 rounded">
                                    Editar
                                </a>
                                <form
                                    action="{{ route('members.destroy', $member->id) }}"
                                    method="POST"
                                    class="inline-block"
                                    onsubmit="return confirm('¿Estás seguro de eliminar este socio?');"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="bg-red-600 hover:bg-red-700 text-white text-xs font-semibold py-1 px-3 rounded"
                                    >
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Enlaces de paginación --}}
        <div class="mt-6">
            {{ $members->withQueryString()->links() }}
        </div>
    @endif
</div>
@endsection
