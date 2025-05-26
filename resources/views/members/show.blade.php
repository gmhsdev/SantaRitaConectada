@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Detalle de Socio</h1>

    {{-- Mensaje flash --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Datos del socio --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-header">
            <strong>{{ $member->first_name }} {{ $member->last_name }}</strong>
        </div>
        <div class="card-body row">
            <div class="col-md-6 mb-2">
                <p><strong>RUT:</strong> {{ $member->rut }}</p>
            </div>
            <div class="col-md-6 mb-2">
                <p><strong>Correo:</strong> {{ $member->email }}</p>
            </div>
            <div class="col-md-6 mb-2">
                <p><strong>Teléfono:</strong> {{ $member->phone ?? '—' }}</p>
            </div>
            <div class="col-md-6 mb-2">
                <p><strong>Dirección:</strong> {{ $member->address ?? '—' }}</p>
            </div>
            <div class="col-md-6 mb-2">
                <p><strong>Fecha de nacimiento:</strong>
                   {{ $member->birth_date
                        ? \Carbon\Carbon::parse($member->birth_date)->format('d-m-Y')
                        : '—' }}
                </p>
            </div>
            <div class="col-md-6 mb-2">
                <p><strong>Fecha de ingreso:</strong>
                   {{ $member->join_date
                        ? \Carbon\Carbon::parse($member->join_date)->format('d-m-Y')
                        : '—' }}
                </p>
            </div>
            <div class="col-md-6">
                <p><strong>Activo:</strong> {{ $member->is_active ? 'Sí' : 'No' }}</p>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('members.edit', $member->id) }}" class="btn btn-warning">Editar Socio</a>
            <a href="{{ route('members.index') }}" class="btn btn-secondary">Volver a la lista</a>
        </div>
    </div>

    {{-- Sección de Documentos --}}
    <div class="mb-4">
        <h3>Documentos</h3>

        {{-- Subida --}}
        <form action="{{ route('member-documents.store', $member->id) }}"
              method="POST"
              enctype="multipart/form-data"
              class="d-flex mb-3">
            @csrf
            <input type="file"
                   name="document"
                   class="form-control me-2 @error('document') is-invalid @enderror"
                   accept="application/pdf"
                   required>
            <button class="btn btn-primary">Subir PDF</button>
        </form>
        @error('document')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        {{-- Lista --}}
        @if($member->documents->isEmpty())
            <p>No hay documentos subidos.</p>
        @else
            <table class="table table-striped table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Nombre del archivo</th>
                        <th>Fecha de subida</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($member->documents as $doc)
                        <tr>
                            <td>{{ $doc->document_name }}</td>
                            <td>{{ $doc->created_at->format('d-m-Y H:i') }}</td>
                            <td class="text-end">
                                <a href="{{ route('member-documents.download', $doc->id) }}"
                                   class="btn btn-sm btn-outline-info me-1">
                                    Descargar
                                </a>
                                <form action="{{ route('member-documents.destroy', $doc->id) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('¿Eliminar este documento?')">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
