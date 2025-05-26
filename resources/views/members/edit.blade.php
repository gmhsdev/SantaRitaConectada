@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <h1>Editar Socio</h1>

    <form action="{{ route('members.update', $member->id) }}" method="POST">
        @csrf
        @method('PUT') {{-- Spoofing para método PUT --}}

        <div class="mb-3">
            <label for="first_name" class="form-label">Nombre:</label>
            <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $member->first_name) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="last_name" class="form-label">Apellido:</label>
            <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $member->last_name) }}" class="form-control" required>
        </div>  

        <div class="mb-3">
            <label for="rut" class="form-label">RUT:</label>
            <input type="text" name="rut" id="rut" value="{{ old('rut', $member->rut) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico:</label>
            <input type="email" name="email" id="email" value="{{ old('email', $member->email) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Teléfono:</label>
            <input type="text" name="phone" id="phone" value="{{ old('phone', $member->phone) }}" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('members.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>

    <hr>
    <h3>Subir Documento</h3>

    <form action="{{ route('member-documents.store', $member->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="document" class="form-label">Selecciona un archivo:</label>
            <input type="file" name="document" id="document" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Subir</button>
    </form>

    <hr>
    <h3>Documentos Subidos</h3>

    @if($member->documents->isEmpty())
        <p>No hay documentos subidos.</p>
    @else
        <ul class="list-group">
            @foreach($member->documents as $doc)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $doc->document_name }}
                    <div>
                        <a href="{{ route('member-documents.download', $doc->id) }}" class="btn btn-sm btn-outline-info">Descargar</a>
                        <form action="{{ route('member-documents.destroy', $doc->id) }}" method="POST" style="display:inline-block;">
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
