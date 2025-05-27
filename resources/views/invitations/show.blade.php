{{-- resources/views/invitations/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Detalle de Citación</h1>

    <div class="mb-6 p-4 bg-white rounded shadow">
        <p><strong>Título:</strong> {{ $invitation->title }}</p>
        <p><strong>Descripción:</strong> {{ $invitation->body ?? 'Sin descripción' }}</p>
        <p><strong>Fecha y hora:</strong> {{ $invitation->scheduled_at->format('d-m-Y H:i') }}</p>
    </div>

    <a href="{{ route('invitations.edit', $invitation) }}"
       class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded mr-2">
        Editar
    </a>

    <a href="{{ route('invitations.index') }}"
       class="inline-block bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">
        Volver al listado
    </a>
</div>
@endsection
