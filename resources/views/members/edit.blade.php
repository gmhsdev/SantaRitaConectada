@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
    @if(session('success'))
        <div class="mb-4 px-4 py-3 rounded bg-green-100 text-green-700 border border-green-300">
            {{ session('success') }}
        </div>
    @endif
    
    <h1 class="text-2xl font-semibold mb-6 text-gray-800">Editar Socio</h1>

    <form action="{{ route('members.update', $member->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="first_name" class="block mb-1 font-medium text-gray-700">Nombre:</label>
            <input
                type="text"
                name="first_name"
                id="first_name"
                value="{{ old('first_name', $member->first_name) }}"
                required
                class="w-full rounded border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
        </div>

        <div>
            <label for="last_name" class="block mb-1 font-medium text-gray-700">Apellido:</label>
            <input
                type="text"
                name="last_name"
                id="last_name"
                value="{{ old('last_name', $member->last_name) }}"
                required
                class="w-full rounded border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
        </div>

        <div>
            <label for="rut" class="block mb-1 font-medium text-gray-700">RUT:</label>
            <input
                type="text"
                name="rut"
                id="rut"
                value="{{ old('rut', $member->rut) }}"
                required
                class="w-full rounded border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
        </div>

        <div>
            <label for="email" class="block mb-1 font-medium text-gray-700">Correo electrónico:</label>
            <input
                type="email"
                name="email"
                id="email"
                value="{{ old('email', $member->email) }}"
                required
                class="w-full rounded border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
        </div>

        <div>
            <label for="phone" class="block mb-1 font-medium text-gray-700">Teléfono:</label>
            <input
                type="text"
                name="phone"
                id="phone"
                value="{{ old('phone', $member->phone) }}"
                class="w-full rounded border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
        </div>

        <div class="flex gap-4 mt-4">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded shadow">
                Actualizar
            </button>
            <a href="{{ route('members.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-6 rounded shadow">
                Cancelar
            </a>
        </div>
    </form>

    <hr class="my-8">

    <h3 class="text-xl font-semibold mb-4 text-gray-800">Subir Documento</h3>

    <form action="{{ route('member-documents.store', $member->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <div>
            <label for="document" class="block mb-1 font-medium text-gray-700">Selecciona un archivo:</label>
            <input
                type="file"
                name="document"
                id="document"
                required
                class="block w-full text-gray-700 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
        </div>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded shadow">
            Subir
        </button>
    </form>

    <hr class="my-8">

    <h3 class="text-xl font-semibold mb-4 text-gray-800">Documentos Subidos</h3>

    @if($member->documents->isEmpty())
        <p class="text-gray-600">No hay documentos subidos.</p>
    @else
        <ul class="space-y-2">
            @foreach($member->documents as $doc)
                <li class="flex justify-between items-center bg-gray-50 border border-gray-200 rounded px-4 py-2">
                    <span class="text-gray-700">{{ $doc->document_name }}</span>
                    <div class="flex space-x-2">
                        <a href="{{ route('member-documents.download', $doc->id) }}" 
                           class="text-blue-600 hover:text-blue-800 font-medium text-sm border border-blue-600 rounded px-3 py-1">
                            Descargar
                        </a>
                        <form action="{{ route('member-documents.destroy', $doc->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este documento?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="text-red-600 hover:text-red-800 font-medium text-sm border border-red-600 rounded px-3 py-1">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif

</div>
@endsection
