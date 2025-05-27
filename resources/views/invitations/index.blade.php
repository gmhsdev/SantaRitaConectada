{{-- resources/views/invitations/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Citaciones</h1>

    <a href="{{ route('invitations.create') }}"
       class="mb-4 inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
       Nueva Citación
    </a>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if($invitations->isEmpty())
        <p>No hay citaciones.</p>
    @else
        <table class="min-w-full bg-white border">
            <thead>
                <tr>
                    <th class="px-4 py-2 border">Título</th>
                    <th class="px-4 py-2 border">Fecha</th>
                    <th class="px-4 py-2 border">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invitations as $inv)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border">{{ $inv->title }}</td>
                    <td class="px-4 py-2 border">
                        {{ $inv->scheduled_at->format('d-m-Y H:i') }}
                    </td>
                    <td class="px-4 py-2 border space-x-2">
                        <a href="{{ route('invitations.edit', $inv) }}"
                           class="text-blue-600 hover:underline">Editar</a>
                        <form action="{{ route('invitations.destroy', $inv) }}"
                              method="POST" class="inline"
                              onsubmit="return confirm('Eliminar esta citación?')">
                            @csrf @method('DELETE')
                            <button type="submit"
                                    class="text-red-600 hover:underline">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $invitations->links() }}
        </div>
    @endif
</div>
@endsection
