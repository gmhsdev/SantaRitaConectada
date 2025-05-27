@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Editar Citación</h1>

    <form action="{{ route('invitations.update', $invitation) }}" method="POST">
        @method('PUT')
        @include('invitations.form', ['buttonText' => 'Actualizar Citación'])
    </form>

    <a href="{{ route('invitations.index') }}"
       class="text-blue-600 hover:underline mt-4 inline-block">← Volver a la lista</a>
</div>
@endsection
