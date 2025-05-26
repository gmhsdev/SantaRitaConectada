@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalle de Socio</h1>

    {{-- Mensaje flash --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Datos del socio --}}
    <div class="card mb-4">
        <div class="card-body">
            <p><strong>Nombre:</strong> {{ $member->first_name }} {{ $member->last_name }}</p>
            <p><strong>RUT:</strong> {{ $member->rut }}</p>
            <p><strong>Correo:</strong> {{ $member->email }}</p>
            <p><strong>Teléfono:</strong> {{ $member->phone ?? '—' }}</p>
            <p><strong>Dirección:</strong> {{ $member->address ?? '—' }}</p>
            <p><strong>Fecha de nacimiento:</strong> {{ $member->birth_date ? \Carbon\Carbon::parse($member->birth_date)->format('d-m-Y') : '—' }}</p>
            <p><strong>Fecha de ingreso:</strong> {{ $member->join_date ? \Carbon\Carbon::parse($member->join_date)->format('d-m-Y') : '—' }}</p>
            <p><strong>Activo:</strong> {{ $member->is_active ? 'Sí' : 'No' }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('members.edit', $member->id) }}" class="btn btn-warning">Editar Socio</a>
            <a href="{{ route('members.index') }}" class="btn btn-secondary">Volver a la lista</a>
        </div>
    </div>

    {{-- Sección de Documentos --}}
    <h3>Documentos</h3>

    {{-- Subida --}}
    <form action="{{ route('member-documents.store', $member->id) }}" method="POST" enctype="multipart/form-data" class="mb-3">
        @csrf
        <div class="input-group">
            <input type="file" name="document" class="form-control" accept="application/pdf" required>
            <button class="btn btn-primary">Subir PDF</button>
        </div>
        @error('document')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </form>

    {{-- Lista --}}
    @if($member->documents->isEmpty())
        <p>No hay documentos subidos.</p>
    @else
        <ul class="list-group">
            @foreach($member->documents as $doc)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $doc->document_name }}
                    <div>
                        <a href="{{ route('member-documents.download', $doc->id) }}" class="btn btn-sm btn-outline-info">Descargar</a>
                        <form action="{{ route('member-documents.destroy', $doc->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Eliminar este documento?')">Eliminar</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
