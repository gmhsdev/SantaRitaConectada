@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">

    <h1 class="text-2xl font-semibold mb-6 text-gray-800">Detalle de Socio</h1>

    {{-- Mensaje flash --}}
    @if(session('success'))
        <div class="mb-4 px-4 py-3 rounded bg-green-100 text-green-700 border border-green-300">
            {{ session('success') }}
        </div>
    @endif

    {{-- Datos del socio --}}
    <div class="mb-6 border border-gray-200 rounded shadow-sm">
        <div class="bg-gray-100 px-5 py-3 rounded-t">
            <strong class="text-lg text-gray-900">{{ $member->first_name }} {{ $member->last_name }}</strong>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 p-5 text-gray-700">
            <p><strong>RUT:</strong> {{ $member->rut }}</p>
            <p><strong>Correo:</strong> {{ $member->email }}</p>
            <p><strong>Teléfono:</strong> {{ $member->phone ?? '—' }}</p>
            <p><strong>Dirección:</strong> {{ $member->address ?? '—' }}</p>
            <p>
                <strong>Fecha de nacimiento:</strong>
                {{ $member->birth_date
                    ? \Carbon\Carbon::parse($member->birth_date)->format('d-m-Y')
                    : '—' }}
            </p>
            <p>
                <strong>Fecha de ingreso:</strong>
                {{ $member->join_date
                    ? \Carbon\Carbon::parse($member->join_date)->format('d-m-Y')
                    : '—' }}
            </p>
            <p><strong>Activo:</strong> {{ $member->is_active ? 'Sí' : 'No' }}</p>
        </div>
        <div class="flex justify-between bg-gray-50 px-5 py-3 rounded-b">
            <a href="{{ route('members.edit', $member->id) }}"
               class="bg-yellow-400 hover:bg-yellow-500 text-white font-semibold py-2 px-4 rounded shadow">
                Editar Socio
            </a>
            <a href="{{ route('members.index') }}"
               class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded shadow">
                Volver a la lista
            </a>
        </div>
    </div>

    {{-- Sección de Documentos --}}
    <div>
        <h3 class="text-xl font-semibold mb-4 text-gray-800">Documentos</h3>

        {{-- Subida --}}
        <form action="{{ route('member-documents.store', $member->id) }}"
              method="POST"
              enctype="multipart/form-data"
              class="flex flex-col sm:flex-row sm:items-center mb-4 gap-3">
            @csrf
            <input type="file"
                   name="document"
                   accept="application/pdf"
                   required
                   class="block w-full sm:w-auto text-gray-700 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded shadow">
                Subir PDF
            </button>
        </form>
        @error('document')
            <div class="mb-4 px-4 py-3 rounded bg-red-100 text-red-700 border border-red-300">
                {{ $message }}
            </div>
        @enderror

        {{-- Lista --}}
        @if($member->documents->isEmpty())
            <p class="text-gray-600">No hay documentos subidos.</p>
        @else
            <div class="overflow-x-auto rounded border border-gray-200">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre del archivo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha de subida</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($member->documents as $doc)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $doc->document_name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $doc->created_at->format('d-m-Y H:i') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                    <a href="{{ route('member-documents.download', $doc->id) }}"
                                       class="inline-block px-3 py-1 border border-blue-600 text-blue-600 rounded hover:bg-blue-600 hover:text-white transition">
                                        Descargar
                                    </a>
                                    <form action="{{ route('member-documents.destroy', $doc->id) }}"
                                          method="POST"
                                          class="inline-block"
                                          onsubmit="return confirm('¿Eliminar este documento?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="px-3 py-1 border border-red-600 text-red-600 rounded hover:bg-red-600 hover:text-white transition">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
